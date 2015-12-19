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
		'ecommerceCategoryProductsData' => [
			'access' => 'minimum',
			'enable' => true,
			'type' => 'datatable',
			'messages' => [
				'empty' => [
					'empty' => 'No data found.',
					'notfound' => 'Cannot find the record/s you are looking for. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Product',
						'plural' => 'Products'
					],
				],
			],
			'action' => [
				'enable' => true,
				'route' => [
					'name' => 'Module',
					'module' => 'ecommerce-products',
				],
				'actions' => [
					'update' => [
						'enable' => true,
						'attributes' => [
							'label' => 'Edit',
						],
					],
				],
			],
			'columns' => [
				'id' => [
					'enable' => true,
					'position' => 0,
					'index' => cd_config('database.e.product.table.primary'),
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.e.product.table.name') . '.' . cd_config('database.e.product.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.e.product.table.name') . '.' . cd_config('database.e.product.table.primary')
					],
					'type' => 'integer',
					'attributes' => [
						'label' => 'ID',
					],
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Product Id'
							],
						],
						'events' => [],
					],
				],
				'title' => [
					'position' => 1,
					'index' => 'title',
					'type' => 'string',
					'attributes' => [
						'label' => 'Title',
					],
					'enable' => true,
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Search Title'
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
					'filter' => [
						'enable' => true,
					],
				],
				'price' => [
					'position' => 2,
					'index' => 'price',
					'type' => 'price',
					'attributes' => [
						'label' => 'Price',
					],
					'enable' => true,
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => ''
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
					'filter' => [
						'enable' => true,
					],
				],
				'status' => [
					'position' => 3,
					'index' => 'status',
					'type' => 'enabledisable',
					'attributes' => [
						'label' => 'Status',
					],
					'enable' => true,
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.e.product.table.name') . '.status'
					],
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Search Status'
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
				],
			],
			'model' => [
				'nested' => [
					'enable' => true,
					'request' => [
						'index' => 'record'
					],
					'model' => [
						'class' => cd_config('database.e.productCategory.model.class'),
						'repository' => [
							'class' => cd_config('database.e.productCategory.repository.class')
						],
					]
				],
				'value' => [
					'index' => cd_config('database.e.product.table.primary')
				],
				'class' => cd_config('database.e.product.model.class'),
				'repository' => [
					'method' => 'getProducts',
					'sort' => [cd_config('database.e.product.table.name') . '.' . cd_config('database.e.product.table.primary') => 'desc'],
					'rowsPerPage' => 10,
					'class' => cd_config('database.e.product.repository.class')
				],
			],
		]
	],
];
