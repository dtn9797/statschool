<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store_local(Request $request)
    {
        if (Contact::where('instagram', $request->instagram)->count() == 0) {
            // preg_match('/(form-)(.*)(.html)/',$request->url(), $matches, PREG_OFFSET_CAPTURE);
            $contact = new Contact();
            $contact->is_musician = $request->is_musician;
            $contact->have_debit_card = $request->have_debit_card;
            $contact->instagram = $request->instagram;
            $contact->email = $request->email;
            $contact->phone =  $request->phone;
            $contact->source = $request->source;
            $contact->save();

            $email_data['is_musician'] = $request->is_musician;
            $email_data['have_debit_card'] = $request->have_debit_card;
            $email_data['instagram'] = $request->instagram;
            $email_data['email'] = $request->email;
            $email_data['phone'] = $request->phone;
            $email_data['source'] =  $request->source;

            Mail::to('statschoolprogram@gmail.com')->send(new NewContact($email_data));
        }

        $redirect_if_the_user_has_a_card = 'https://www.statschool.co/contact-ig.html';
        $redirect_if_the_user_does_not_have_a_card = 'https://statschool.herokuapp.com/register';

        if ($request->have_debit_card == "No I Don't Have One") {
            return redirect($redirect_if_the_user_does_not_have_a_card);
        }
        return redirect($redirect_if_the_user_has_a_card);
    }

    // /api/contact
    public function store(Request $request)
    {
        if (!$request->instagram) {
            return response()->json(["message" => "error, instagram is required"]);
        }

        if (Contact::where('instagram', '=', $request->instagram)->exists()) {
            return response()->json(["message" => "error, instagram already exists"]);
        }

        $instagram = str_replace(' ', '', $request->instagram);

        $contact = new Contact();
        $contact->is_musician = $request->is_musician;
        $contact->have_debit_card = $request->have_debit_card;
        $contact->instagram = strtolower($instagram);
        $contact->email = strtolower($request->email);
        $contact->phone =  $request->phone;
        $contact->source =  $request->source;
        $contact->save();

        $email_data['is_musician'] = $request->is_musician;
        $email_data['have_debit_card'] = $request->have_debit_card;
        $email_data['instagram'] = $request->instagram;
        $email_data['email'] = $request->email;
        $email_data['phone'] = $request->phone;
        $email_data['source'] =  $request->source;

        Mail::to('statschoolprogram@gmail.com')->send(new NewContact($email_data));

        return response()->json(["message" => "success", "contactID" => $contact->id]);
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            return response()->json(["message" => "error, id is required"]);
        }

        Contact::where('id', $id)->update(['phone' =>  $request->phone]);

        return response()->json(["message" => "success"]);
    }
}
