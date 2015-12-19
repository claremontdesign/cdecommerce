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
return [
	'widgets' => [
		'ecommerceCategoriesData' => [
			'access' => 'minimum',
			'enable' => true,
			'type' => 'treeview',
			'tree' => [
				'selectable' => false,
				'multiple' => false,
				'positionable' => true,
				'collapsed' => true,
			],
			'messages' => [
				'empty' => [
					'empty' => 'No Categories  found.',
					'notfound' => 'Cannot find the category/s you are looking for. Kindly try again.'
				],
			],
			'request' => [
				'ajax' => true,
				'item' => 'record',
				'list' => 'paramOne',
				'form' => [
					'index' => 'category'
				],
			],
			'models' => [
				'item' => [
					'primaryKey' => cd_config('database.e.product.table.primary'),
					'class' => cd_config('database.e.product.model.class'),
					'repository' => [
						'class' => cd_config('database.e.product.repository.class')
					],
				],
				'category' => [
					'primaryKey' => cd_config('database.e.productCategory.table.primary'),
					'class' => cd_config('database.e.productCategory.model.class'),
					'repository' => [
						'class' => cd_config('database.e.productCategory.repository.class')
					],
				],
				'pivot' => [
					'class' => cd_config('database.e.productCategoryPivot.model.class'),
					'repository' => [
						'class' => cd_config('database.e.productCategoryPivot.repository.class')
					],
				],
			],
		]
	],
];
