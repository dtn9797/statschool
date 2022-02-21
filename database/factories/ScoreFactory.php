<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Score;
use Faker\Generator as Faker;

$factory->define(Score::class, function (Faker $faker) {
    return [
        'amount' => random_int(1000, 9999),
    ];
});