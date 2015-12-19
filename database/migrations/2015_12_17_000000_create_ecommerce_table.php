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

			// These columns are needed for Baum's Nested Set implementation to work.
			// Column names may be changed, but they *must* all exist and be modified
			// in the model.
			// Take a look at the model scaffold comments for details.
			// We add indexes on parent_id, lft, rgt columns by default.
			$table->integer('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});

		/**
		 * Product-Category Pivot
		 */
		Schema::create(cd_config('database.e.productCategoryPivot.table.name'), function(Blueprint $table)
		{
			$table->integer(cd_config('database.e.product.table.primary'))->nullable();
			$table->integer(cd_config('database.e.productCategory.table.primary'))->nullable();
			$table->integer('position')->nullable()->default(0);
			$table->primary([cd_config('database.e.product.table.primary'), cd_config('database.e.productCategory.table.primary')]);
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
