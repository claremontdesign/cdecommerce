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

$factory->define(cd_config('database.e.product.model.class'), function (Faker\Generator $faker) {
	$title = implode(' ',$faker->words(rand(3, 8)));
	return [
		'product_type' => 'default',
		'title' => $title,
		'sku' => $faker->word(),
		'price' => $faker->randomFloat(),
		'qty' => rand(0, 100),
		'description' => $faker->text(rand(100, 200)),
		'status' => rand(0, 1),
		'slug' => \Illuminate\Support\Str::slug($title),
		'created_at' => $faker->date('Y-m-d'),
		'updated_at' => $faker->date('Y-m-d')
	];
});

$factory->define(cd_config('database.e.productCategory.model.class'), function (Faker\Generator $faker) {
	$title = implode(' ',$faker->words(rand(2, 4)));
	return [
		'title' => $title,
		'description' => $faker->text(rand(100, 200)),
		'status' => rand(0, 1),
		'slug' => \Illuminate\Support\Str::slug($title),
		'created_at' => $faker->date('Y-m-d'),
		'updated_at' => $faker->date('Y-m-d')
	];
});