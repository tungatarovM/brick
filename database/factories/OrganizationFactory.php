<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Account\Entities\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'website' => $faker->url,
        'address' => $faker->address,
        'description' => $faker->text('190'),
    ];
});
