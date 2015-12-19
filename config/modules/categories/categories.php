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
				'nav::ecommerce.children.categories'
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
				'update' => [
					'enable' => true,
					'widgets' => ['ecommerceCategoriesForm']
				],
				'position' => [
					'enable' => true,
					'request' => [
						'methods' => ['ajaxpost']
					],
					'nested' => [
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
				'delete' => [
					'enable' => true,
					'widgets' => ['ecommerceCategoriesForm']
				],
				'view' => [
					'enable' => true,
					'widgets' => ['ecommerceCategoriesForm']
				],
				'duplicate' => [
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
			],
		]
	],
];
return array_merge_recursive(
		$config, require __DIR__ . '/tree.php', require __DIR__ . '/datatable.php', require __DIR__ . '/form.php'
);
