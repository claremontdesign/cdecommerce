<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcommerceTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		/**
		 * Products
		 */
		Schema::create(cd_config('database.e.product.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.e.product.table.primary'));
			$table->string('product_type')->nullable()->default('default');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->string('sku')->nullable();
			$table->string('nickname')->nullable();
			$table->decimal('price', 16, 2)->nullable()->default(0.00);
			$table->integer('qty')->nullable()->default(0);
			$table->string('redirect_url')->nullable();
			$table->text('description')->nullable();
			$table->text('short_description')->nullable();
			$table->text('meta_title')->nullable();
			$table->text('meta_keywords')->nullable();
			$table->text('meta_description')->nullable();
			$table->boolean('status')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		/**
		 * Category
		 */
		Schema::create(cd_config('database.e.productCategory.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.e.productCategory.table.primary'));
			$table->string('title')->nullable();
			$table->string('nickname')->nullable();
			$table->string('slug')->nullable();
			$table->string('redirect_url')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		/**
		 * Product-Category Pivot
		 */
		Schema::create(cd_config('database.e.productCategoryPivot.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.e.productCategoryPivot.table.primary'));
			$table->string('product_id')->nullable();
			$table->string('category_id')->nullable();
			$table->integer('position')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(cd_config('database.e.product.table.name'));
		Schema::dropIfExists(cd_config('database.e.productCategory.table.name'));
		Schema::dropIfExists(cd_config('database.e.productCategoryPivot.table.name'));
	}

}
