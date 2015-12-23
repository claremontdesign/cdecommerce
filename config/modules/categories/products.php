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
			'sortable' => [
				'enable' => false,
			],
			'messages' => [
				'empty' => [
					'empty' => 'No data found.',
					'notfound' => 'Cannot find the record/s you are looking for. Kindly try again.'
				],
			],
			'attributes' => [
				'recordName' => [
					'singular' => 'Product',
					'plural' => 'Products'
				],
			],
			'ajax' => [
				'enable' => true,
				'route' => [
					'name' => 'Module',
					'module' => 'ecommerce-categories',
					'action' => 'products',
					'record' => function(){
						return app('cdbackend')->routeParam('record');
					}
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
				'position' => [
					'enable' => true,
					'position' => 0,
					'index' => 'position',
					'value' => [
						'editable' => [
							'enable' => true,
							'element' => [
								'type' => 'integer',
								'inputonly' => true,
								'attributes' => [
									'size' => 'xsmall',
									'data' => [
										'data-positioning' => 1
									],
								],
							],
							'init' => true
						],
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.e.productCategoryPivot.table.name') . '.position'
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.e.productCategoryPivot.table.name') . '.position'
					],
					'type' => 'minmax',
					'attributes' => [
						'label' => 'Position',
					],
				],
				'id' => [
					'enable' => true,
					'position' => 1,
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
					'position' => 2,
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
						'index' => cd_config('database.e.product.table.name') . '.title'
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.e.product.table.name') . '.title'
					],
				],
				'price' => [
					'position' => 3,
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
						'index' => cd_config('database.e.product.table.name') . '.price'
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.e.product.table.name') . '.price'
					],
				],
				'status' => [
					'position' => 4,
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
						'index' => cd_config('database.e.product.table.name') . '.status'
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
						'primary' => cd_config('database.e.productCategory.table.primary'),
						'repository' => [
							'class' => cd_config('database.e.productCategory.repository.class')
						]
					]
				],
				'value' => [
					'index' => cd_config('database.e.product.table.primary')
				],
				'class' => cd_config('database.e.product.model.class'),
				'repository' => [
					'sortrequest' => 'position-asc',
					'sort' => [cd_config('database.e.productCategoryPivot.table.name') . '.position' => 'ASC'],
					'rowsPerPage' => 2,
					'class' => cd_config('database.e.product.repository.class')
				],
			],
		]
	],
];
