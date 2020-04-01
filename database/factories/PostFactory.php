<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph(1),
        'excerpt' => $faker->text,
        'description' => $faker->paragraph(10),
        'status' => 1
    ];
});
