<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Exit11\UiBlade\Models\Menu as Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('ko_kr');
    //$parent = $faker->boolean(50) ? factory(Model::class)->create() : null;
    return [
        //'parent_id' => $parent ? $parent->id : null,
        'order' => function () {
            $max = Model::all()->max('order');
            return $max + 1;
        },
        'name' => $faker->word,
        'description' => $faker->text,
        'icon' => null,
        'url' => $faker->url,
        'target' => $faker->boolean,
        'background_image' => null,
        'is_visible' => $faker->boolean,
        'depth' => 1,
    ];
});
