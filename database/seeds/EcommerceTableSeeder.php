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
		$categoryId = cd_config('database.e.productCategory.table.primary');
		$className = cd_config('database.e.productCategory.model.class');
		$categories = [
			[$categoryId => 1, 'title' => 'Root Category', 'status' => rand(0, 1), 'children' => [
					[$categoryId => 2, 'title' => 'Tablets & E-Readers', 'status' => rand(0, 1)],
					[$categoryId => 3, 'title' => 'Computers', 'status' => rand(0, 1), 'children' => [
							[$categoryId => 4, 'title' => 'Laptops', 'status' => rand(0, 1), 'children' => [
									[$categoryId => 5, 'title' => 'PC Laptops', 'status' => rand(0, 1)],
									[$categoryId => 6, 'title' => 'Macbooks (Air/Pro)', 'status' => rand(0, 1)]
								]],
							[$categoryId => 7, 'title' => 'Desktops', 'status' => rand(0, 1)],
							[$categoryId => 8, 'title' => 'Monitors', 'status' => rand(0, 1)]
						]],
					[$categoryId => 9, 'title' => 'Cell Phones', 'status' => rand(0, 1)]
				]],
		];
		$className::buildTree($categories);
		factory(cd_config('database.e.product.model.class'), rand(2, 10))->create()->each(function($product) use ($className, $categoryId) {
			$category = $className::where($categoryId, '=', rand(1, 9))->first();
			$product->save();
			$product->categories()->attach($category);
		});
	}

}
