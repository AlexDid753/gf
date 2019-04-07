<?php

use Faker\Generator as Faker;
use App\Day;

$factory->define(Day::class, function (Faker $faker, $number) {
    return [
        'number' => $number,
    ];
});

//for ($i = 1; $i <= 30; $i++) {
//    factory(App\Day::class)->make(['number' => $i]);
//}

