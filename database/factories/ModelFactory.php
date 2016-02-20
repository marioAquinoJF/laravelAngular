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

$factory->define(larang\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(123456),
        'remember_token' => str_random(10),
    ];
});
$factory->define(larang\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->paragraph,
    ];
});

$factory->define(larang\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1,10),
        'client_id' => $faker->numberBetween(1, 11),
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'progress' => rand(1,3),
        'status' => rand(1, 3),
        'due_date' => $faker->date('now')
    ];
});

$factory->define(larang\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'title' => $faker->sentence(),
        'note' => $faker->paragraph
    ];
});

$factory->define(larang\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,30),
        'user_id' => rand(1,10),
    ];
});

$factory->define(larang\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'name' => $faker->word,
        'start_date' => $faker->date('now'),
        'due_date' => $faker->date(),
        'status' => rand(1, 5)
    ];
});

$factory->define(larang\Entities\OAuthClient::class, function () {
    return [
        'id' => 'app02',
        'secret' => 'secret',
        'name' => 'projects',
    ];
});

$factory->define(larang\Entities\ProjectFile::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(15),
        'lable' => 'teste',
        'extension' => 'jpg',
        'project_id' => rand(1, 30),
    ];
}); 