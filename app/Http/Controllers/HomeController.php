<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\ScoreLog;
use App\Reward;
use App\Score;
use App\User;
use App\PostbackLog;

class HomeController extends Controller
{
    public function identify_device(Request $req)
    {
        return view('identify_device');
    }

    public function index(Request $req)
    {
        $ip = $req->ip();
        $device = $req->query('device');

        $device_param = '';
        switch ($device) {
            case 'android':
                $device_param = '&device=android';
                break;

            case 'iphone':
                $device_param = '&device=iphone';
                break;

            case 'ipad':
                $device_param = '&device=ipad';
                break;

            default:
            $device_param = '&device=desktop';
                break;
        }

        $user = Auth::user();
        $user->ip = $ip;
        $user->save();

        $api_url = "https://mobverify.com/api/v1/?affiliateid=197514&ctype=1&country=US&aff_sub4=".$device;
        $user_param = '&aff_sub5=' . $user->id;

        $response = Http::get($api_url.$device_param.$user_param);
        $offers = $response->json()['offers'];

        $offers = collect($offers);
        $offers = $offers->sortBy('payout');

        $show_tutorial = false;
        if (!$user->tutorial_viewed) {
            $user->tutorial_viewed = true;
            $user->save();
            $show_tutorial = true;
        }

        if (Auth::user()->getScoreAmount() > 0 && !$user->invitation_to_follow_viewed) {
            $user->invitation_to_follow_viewed = true;
            $user->save();

            return redirect("invitation-to-follow");
        }

        return view('welcome', compact('offers', 'show_tutorial'));
    }

    public function invitation_to_follow()
    {
        return view('invitation_to_follow');
    }

    public function rewards()
    {
        $rewards = Reward::all();

        return view('rewards', compact('rewards'));
    }

    public function reward_claim($id)
    {
        $reward = Reward::find($id);
        return view('reward_claim', compact('reward'));
    }

    public function postback(Request $request)
    {
        # validate token
        $token = $request->query('token');
        if ($token != 'hg53a4tdra3h4swr821f837241325kjbasdkhsdfhjvyugsdow') {
            return response()->json(["message" => "invalid token"]);
        }

        # get data
        $source_ip = $request->ip();
        $ip = $request->query('ip');
        $payout = $request->query('payout');
        $offer_id = $request->query('offer_id');
        $offer_name = $request->query('offer_name');
        $offer_datetime = $request->query('datetime');
        $points = $payout * 100;
        $offer_user_device = $request->query('aff_sub4');
        $offer_user_id = $request->query('aff_sub5');

        #log request
        $postback_log = new PostbackLog();
        $postback_log->log = "
            <h3>Request received:</h3>
            <p><b>source_ip:</b> $source_ip </p>
            <p><b>ip:</b> $ip </p>
            <p><b>payout:</b> $payout </p>
            <p><b>offer_id:</b> $offer_id </p>
            <p><b>offer_name:</b> $offer_name </p>
            <p><b>offer_datetime:</b> $offer_datetime </p>
            <p><b>points:</b> $points </p>
            <p><b>offer_user_device:</b> $offer_user_device </p>
            <p><b>offer_user_id:</b> $offer_user_id </p>
            <p><b>user_identified:</b> No</p>
        ";
        $postback_log->save();

        # add points to user
        $user = User::findOrFail($offer_user_id);
        $user->setScoreAmount($user->getScoreAmount() + $points);

        # log identified success
        $postback_log->log = "
            <h3>Request received:</h3>
            <p><b>source_ip:</b> $source_ip </p>
            <p><b>ip:</b> $ip </p>
            <p><b>payout:</b> $payout </p>
            <p><b>offer_id:</b> $offer_id </p>
            <p><b>offer_name:</b> $offer_name </p>
            <p><b>offer_datetime:</b> $offer_datetime </p>
            <p><b>points:</b> $points </p>
            <p><b>offer_user_device:</b> $offer_user_device </p>
            <p><b>offer_user_id:</b> $offer_user_id </p>
            <p><b>user_identified:</b> Yes</p>
        ";
        $postback_log->save();

        # log operation
        $log = new ScoreLog();
        $log->source_ip = $source_ip;
        $log->operation_type = 'addition';
        $log->operation_source = 'postback';
        $log->operation_value = $points;
        $log->target_email = $user->email;
        $log->target_score_after_operation = Score::where('user_id', $user->id)->firstOrFail()->amount;
        $log->offer_id = $offer_id;
        $log->offer_name = $offer_name;
        $log->offer_conversion_date = $offer_datetime;
        $log->offer_payout = $payout;
        $log->offer_user_ip = $ip;
        $log->offer_user_device = $offer_user_device;
        $log->save();

        return response()->json(["message" => "success"]);
    }

    public function score_operations()
    {
        if (!Auth::user() || !Auth::user()->hasRole('admin')) {
            abort(401);
        }

        $users = User::all();
        return view('score_operations', ['users' => $users]);
    }

    public function process_score_operations(Request $req)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(401);
        }

        $user_id = $req->user;
        $operation_type = $req->operation_type;
        $quantity = $req->quantity;

        $user = User::findOrFail($user_id);

        switch ($operation_type) {
            case 'addition':
                $user->addCredits($quantity);
                break;

            case 'subtraction':
                if ($quantity > $user->getScoreAmount()) {
                    abort(403, 'Error on try to remove more user points than the user currently has');
                }
                $user->removeCredits($quantity);
                break;

            default:
                abort(500);
                break;
        }

        # log operation
        $log = new ScoreLog();
        $log->source_ip = $req->ip();
        $log->operation_type = $operation_type;
        $log->operation_source = 'admin panel';
        $log->operation_value = $quantity;
        $log->target_email = $user->email;
        $log->target_score_after_operation = $user->getScoreAmount();
        $log->save();

        return redirect("admin/scores");
    }
}
