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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $roles = ['teacher', 'final_class', 'first_class'];
    //var_dump(array_rand($roles));
    return [
        'username' => $faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => $roles[array_rand($roles)], 
        'remember_token' => str_random(10),
    ];
});



$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $status = ['published', 'unpublished'];
    $title = $faker->text(10);
    $abstract = $faker->paragraph(1);
    $content = $faker->paragraph(rand(2,5));

    return [
        'user_id' => rand(1,10),
        'title' => $title,
        'abstract' => $abstract, 
        'content' => $content,
        'date' => $faker->dateTime,
        'status' => $status[array_rand($status)],
    ];
});



$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $status = ['published', 'unpublished'];
    $title = $faker->text(10);
    $content = $faker->paragraph(rand(2,5));

    return [
        'title' => $title,
        'content' => $content,
        'date' => $faker->dateTime,
        'status' => $status[array_rand($status)],
    ];
});


$factory->define(App\Question::class, function (Faker\Generator $faker) {
    $status = ['published', 'unpublished'];
    $class_level = ['terminale', 'premiere'];
    $title = $faker->text(10);
    $content = $faker->paragraph(rand(2,5));

    return [
        'title' => $title,
        'content' => $content,
        'class_level' => $class_level[array_rand($class_level)],
        'status' => $status[array_rand($status)],
    ];
});


$factory->define(App\Choice::class, function (Faker\Generator $faker) {
    $status = ['yes', 'no'];
    $content = $faker->paragraph(rand(2,5));

    return [
        'question_id' => rand(1, 10),
        'content' => $content,
        'status' => $status[array_rand($status)],
    ];
});


$factory->define(App\Score::class, function (Faker\Generator $faker) {
    $status = ['yes', 'no'];
    
    return [
        'user_id' => rand(1, 10),
        'question_id' => rand(1, 10),
        'note' => rand(0,20),
        'status' => $status[array_rand($status)],
    ];
});



