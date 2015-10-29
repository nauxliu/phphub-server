<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(PHPHub\User::class, function (Faker\Generator $faker) {
    return [
        'github_id'        => rand(1000, 9999999),
        'image_url'        => 'https://avatars.githubusercontent.com/u/'.rand(1000, 9999999),
        'github_url'       => $faker->url,
        'city'             => $faker->city,
        'name'             => $faker->userName,
        'twitter_account'  => $faker->userName,
        'company'          => $faker->userName,
        'personal_website' => $faker->url,
        'signature'        => $faker->sentence,
        'introduction'     => $faker->sentence,
        'email'            => $faker->email,
        'login_token'      => str_random(rand(20, 32)),
    ];
});

$factory->define(PHPHub\Topic::class,  function (Faker\Generator $faker) {

    $created_at = Carbon\Carbon::now()
        ->subDays(rand(1, 10))
        ->subHours(rand(1, 23))
        ->subMinutes(rand(1, 60));

    return [
        'title'      => $faker->sentence,
        'body'       => $faker->text,
        'view_count' => rand(10, 1000),
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});

$factory->define(PHPHub\Reply::class,  function (Faker\Generator $faker) {

    $created_at = Carbon\Carbon::now()
        ->subDays(rand(1, 10))
        ->subHours(rand(1, 23))
        ->subMinutes(rand(1, 60));

    return [
        'body'       => $faker->sentence,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});
