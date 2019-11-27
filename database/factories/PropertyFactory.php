<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'AddressLine_1'=>$faker->address,
        'AddressLine_1'=>$faker->address,
        'AddressLine_2'=>$faker->city,
        'City'=>$faker->city,
        'PostCode'=>$faker->postcode,

    ];
});
