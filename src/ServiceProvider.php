<?php

namespace Claremontdesign\Ecommerce;

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Dec 17, 2015 1:43:45 PM
 * @file routes.php
 * @project Claremontdesign
 * @package Ecommerce
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

	public function register()
	{
		// Register this service
		$this->app->singleton('ecommerce', function($app){
			return new Ecommerce;
		});
		app('cdbase')->addPackage(\Claremontdesign\Ecommerce\Ecommerce::class);
		app('cdbase')->addModule('ecommerce', __DIR__ . '/../config/modules/ecommerce.php');
		app('cdbase')->addModule('ecommerce-products', __DIR__ . '/../config/modules/products/products.php');
		app('cdbase')->addModule('ecommerce-categories', __DIR__ . '/../config/modules/categories/categories.php');
		app('cdbase')->addCommand('migrate', 'db:seed --class=EcommerceTableSeeder');
	}

	public function boot()
	{
		// Define the path for the view files
		$this->loadViewsFrom(__DIR__ . '/../resources/views', cd_ecommerce_tag());

		$this->publishes([
			__DIR__ . '/../resources/assets' => public_path('assets/ecommerce'),
				], 'public');

		$this->publishes([
			__DIR__ . '/../resources/views' => base_path('resources/views/claremontdesign/ecommerce'),
				], 'views');

		$this->publishes([
			__DIR__ . '/../database/migrations' => base_path('database/migrations'),
			__DIR__ . '/../database/factories' => base_path('database/factories'),
			__DIR__ . '/../database/seeds' => base_path('database/seeds')
				], 'migrations');

		// Loading the routes file
		require __DIR__ . '/Http/routes.php';
	}

}
