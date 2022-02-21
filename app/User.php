<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function score()
    {
        return $this->hasOne('App\Score');
    }

    public function getScoreAmount()
    {
        if ($this->score) {
            return $this->score->amount;
        }
        return 0;
    }

    public function setScoreAmount($new_amount)
    {
        if ($this->score) {
            $this->score->amount = $new_amount;
            $this->score->save();
        } else {
            $score = new Score();
            $score->amount = $new_amount;
            $score->user_id = $this->id;
            $score->save();
        }
    }

    public function addCredits($quantity)
    {
        $this->setScoreAmount($this->getScoreAmount() + $quantity);
    }

    public function removeCredits($quantity)
    {
        if ($quantity > $this->getScoreAmount()) {
            abort(500, 'Error on try to remove more user points than the user currently has');
        }
        $this->setScoreAmount($this->getScoreAmount() - $quantity);
    }
}