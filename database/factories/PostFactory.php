<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'category' => $faker->word,
        'tags' => json_encode([$faker->word, $faker->word]),
        'status' => $faker->randomElement(['active', 'inactive']),
        'featured_image' => $faker->imageUrl(),
        'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
    ];
});
