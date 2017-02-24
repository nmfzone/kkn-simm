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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\User::class, 'banned', function ($faker) {
    return [
        'status' => false,
    ];
});

$factory->define(App\Resident::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'nik' => $faker->numberBetween(3310042305010000, 3310042305080000),
        'gender' => $faker->randomElement(['L', 'P']),
        'date_of_birth' => $faker->dateTime,
        'hometown_id' => App\District::all()->random()->id,
        'marital_status_id' => App\MaritalStatus::all()->random()->id,
        'education_id' => App\Education::all()->random()->id,
        'job_id' => App\Job::all()->random()->id,
    ];
});

$factory->define(App\FamilyCard::class, function (Faker\Generator $faker) {
    $rw = App\Setting::getRW()->random();

    return [
        'number' => $faker->numberBetween(3310043007100000, 3310043007800000),
        'village_id' => App\Village::all()->random()->id,
        'kadus' => App\Setting::getKadus($rw)->first(),
        'rt' => App\Setting::getRT()->random(),
        'rw' => $rw,
    ];
});

$factory->define(App\Province::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
    ];
});

$factory->define(App\District::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
        'province_id' => App\Province::all()->random()->id,
    ];
});

$factory->define(App\SubDistrict::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
        'postal_code' => $faker->postcode,
        'district_id' => App\District::all()->random()->id,
    ];
});

$factory->define(App\Village::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
        'sub_district_id' => App\SubDistrict::all()->random()->id,
    ];
});

$factory->define(App\MaritalStatus::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(1),
    ];
});

$factory->define(App\Education::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
    ];
});

$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
    ];
});

$factory->define(App\Disability::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
    ];
});
