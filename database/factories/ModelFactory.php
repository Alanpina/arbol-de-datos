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
$factory->define(App\Node::class, function (Faker\Generator $faker){
    $maxId = DB::table('nodes')->max('id');
    return [
        'name' 		=> $faker->name,
        'parent' 	=> rand(1, $maxId),
        'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
