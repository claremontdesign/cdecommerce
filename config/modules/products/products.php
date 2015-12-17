<?php

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
$config = [
	'modules' => [
		'ecommerce-products' => [
			'enable' => true,
			'name' => 'Products',
			'metas' => [
				'pagetitle' => 'Ecommerce Products',
				'pagesubtitle' => 'Manage e-Commerce Products.'
			],
			'breadcrumb' => [
				'nav::ecommerce',
				'nav::ecommerce.children.products'
			],
			'access' => 'minimum',
			'actions' => [
				'index' => [
					'enable' => true,
					'view' => [
						'template' => false
					],
					'widgets' => ['ecommerceProductsData']
				],
				'update' => [
					'enable' => true,
					'widgets' => ['ecommerceProductsForm']
				],
				'delete' => [
					'enable' => true,
					'widgets' => ['ecommerceProductsForm']
				],
				'view' => [
					'enable' => true,
					'widgets' => ['ecommerceProductsForm']
				],
				'duplicate' => [
					'enable' => true,
					'widgets' => ['ecommerceProductsForm']
				],
				'create' => [
					'enable' => true,
					'metas' => [
						'pagetitle' => 'Create A Product',
						'pagesubtitle' => 'Create a new product.'
					],
					'widgets' => ['ecommerceProductsForm']
				],
			],
		]
	],
];
return array_merge_recursive(
		$config, require __DIR__ . '/datatable.php', require __DIR__ . '/form.php'
);
