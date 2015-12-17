<?php

use Illuminate\Database\Seeder;

class EcommerceTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(cd_config('database.e.productCategory.model.class'), 5)->create()->each(function($category) {
			$category->save();
			factory(cd_config('database.e.product.model.class'), rand(2, 10))->create()->each(function($product) use ($category) {
				$product->save();
				$product->categories()->attach($category);
			});
		});
	}
}
