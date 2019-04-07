<?php

use Faker\Generator as Faker;
use App\Rate;
use App\Day;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->numberBetween(100,20000),
    ];
});

$days = Day::all();

Rate::all()->each(function ($rate) use ($days) {
    $rate->days()->sync(
        array_rand($days->pluck('id')->toArray(),5)
    );
});
