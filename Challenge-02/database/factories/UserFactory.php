<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Faker\Provider as Provider;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new Provider\pt_BR\PhoneNumber($faker));
    return [
        'msisdn' => '+55' . $faker->cellphone(false, true),
        'name' => $faker->name,
        'access_level' => 'free',
        'password' => '123456789',
    ];
});
