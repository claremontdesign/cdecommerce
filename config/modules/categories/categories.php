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
		'ecommerce-categories' => [
			'enable' => true,
			'name' => 'Products',
			'metas' => [
				'pagetitle' => 'Ecommerce Categories',
				'pagesubtitle' => 'Manage e-Commerce Categories.'
			],
			'breadcrumb' => [
				'nav::ecommerce',
				'nav::ecommerce.children.productsCategory'
			],
			'module' => [
				'controller' => [
					'class' => \Claremontdesign\Cdbase\Widgets\WidgetTypes\Treeview\NestedController::class,
				],
			],
			'access' => 'minimum',
			'actions' => [
				'index' => [
					'enable' => true,
					'view' => [
						'template' => false
					],
					'widgets' => ['ecommerceCategoriesTreeview']
				],
				'position' => [
					'enable' => true,
					'request' => [
						'methods' => ['ajaxpost']
					],
					'nested' => [
						'attributes' => [
							'recordName' => [
								'singular' => 'Category',
								'plural' => 'Categories'
							],
						],
						'models' => [
							'category' => [
								'primaryKey' => cd_config('database.e.productCategory.table.primary'),
								'class' => cd_config('database.e.productCategory.model.class'),
								'repository' => [
									'class' => cd_config('database.e.productCategory.repository.class')
								],
							],
						],
					],
					'parent' => [
						'parent' => [
							'enable' => true,
							'request' => [
								'index' => ['record']
							],
							'model' => [
								'value' => [
									'index' => [cd_config('database.e.productCategory.table.primary')]
								],
								'repository' => [
									'record' => [
										'index' => cd_config('database.e.productCategory.table.name') . '.' . cd_config('database.e.productCategory.table.primary'),
										'class' => cd_config('database.e.productCategory.model.class'),
										'repository' => [
											'class' => cd_config('database.e.productCategory.repository.class'),
											'index' => cd_config('database.e.productCategory.table.name') . '.' . cd_config('database.e.productCategory.table.primary'),
										]
									],
								],
							],
							'error' => [
								'notfound' => 'Category not found.'
							],
						]
					],
				],
				'update' => [
					'enable' => true,
					'request' => [
						 'methods' => ['ajaxpost']
					],
					'widgets' => ['ecommerceCategoryForm']
				],
				'delete' => [
					'enable' => true,
					'widgets' => ['ecommerceCategoriesForm']
				],
				'create' => [
					'enable' => true,
					'metas' => [
						'pagetitle' => 'Create A Category',
						'pagesubtitle' => 'Create a new category.'
					],
					'widgets' => ['ecommerceCategoriesForm']
				],
				'products' => [
					'enable' => true,
					'request' => [
						'methods' => ['ajaxpost','ajaxget']
					],
					'breadcrumb' => [
						'nav::ecommerce.children.productsCategory.children.products'
					],
					'parent' => [
						'parent' => [
							'enable' => true,
							'request' => [
								'index' => ['record']
							],
							'route' => [
								[
									'record' => [
										'name' => 'Module',
										'module' => 'ecommerce-categories'
									],
								]
							],
							'model' => [
								'value' => [
									'index' => ['category_id']
								],
								'repository' => [
									'record' => [
										'primaryKey' => cd_config('database.e.productCategory.table.primary'),
										'class' => cd_config('database.e.productCategory.model.class'),
										'repository' => [
											'class' => cd_config('database.e.productCategory.repository.class')
										],
									],
								],
							],
							'error' => [
								'notfound' => 'Category not found.'
							],
						],
					],
					'widgets' => ['ecommerceCategoryProductsData']
				],
			],
		]
	],
];
return array_merge_recursive(
		$config, require __DIR__ . '/tree.php', require __DIR__ . '/products.php', require __DIR__ . '/form.php'
);
