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
		'ecommerceProductsForm' => [
			'enable' => true,
			'type' => 'form',
			'access' => 'minimum',
			'request' => [
				'index' => 'record',
				'multiple' => true
			],
			'attributes' => [
				'recordName' => [
					'singular' => 'Product',
					'plural' => 'Products'
				],
			],
			'form' => [
				'messages' => [
					'empty' => 'No data found.',
					'notfound' => 'Cannot find the record/s you are looking for. Kindly try again.'
				],
				'ui' => [
					'html' => [
						'form' => []
					],
				],
				'fieldsets' => [
				],
				'tabs' => [
					'general' => [
						'enable' => true,
						'position' => 100,
						'attributes' => [
							'label' => 'General',
						],
						'elements' => ['title', 'description', 'shortDescription', 'sku', 'slug', 'status']
					],
					'price' => [
						'enable' => true,
						'position' => 70,
						'attributes' => [
							'label' => 'Prices',
						],
						'elements' => ['price']
					],
					'meta' => [
						'enable' => true,
						'position' => 60,
						'attributes' => [
							'label' => 'Meta Information',
						],
						'elements' => ['metaTitle', 'metaDescription', 'metaKeywords']
					],
					'categories' => [
						'enable' => true,
						'position' => 50,
						'attributes' => [
							'label' => 'Categories',
						],
						'events' => [
							'onclick' => [
								'ajax' => true
							],
						],
						'elements' => ['category']
					],
				],
				'actions' => [
					'submit' => [
						'type' => 'submit',
						'enable' => true,
						'ui' => [
							'html' => [
								'input' => []
							],
						],
						'attributes' => [
							'label' => 'Submit',
						],
					],
					'confirm' => [
						'enable' => false,
						'type' => 'confirm',
						'ui' => [
							'html' => [
								'input' => []
							],
						],
						'attributes' => [
							'label' => 'Confirm',
						],
					],
					'cancel' => [
						'enable' => true,
						'type' => 'cancel',
						'ui' => [
							'tag' => 'a',
							'url' => [
								'route' => [
									'name' => 'Module',
									'module' => 'ecommerce-products',
								]
							],
							'html' => [
								'input' => []
							],
						],
						'attributes' => [
							'label' => 'Cancel',
						],
					],
				],
				'elements' => [
					'title' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'title',
							],
						],
						'type' => 'text',
						'position' => 3,
						'attributes' => [
							'label' => 'Title',
							'placeholder' => 'Title'
						],
						'validation' => [
							'required' => [
								'enable' => true,
								'message' => 'Title is required.'
							],
						],
					],
					'sku' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'sku',
							],
						],
						'type' => 'text',
						'position' => 3,
						'attributes' => [
							'label' => 'SKU',
							'placeholder' => 'SKU'
						],
						'validation' => [
							'required' => [
								'enable' => true,
								'message' => 'SKU is required.'
							],
						],
					],
					'price' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'price',
							],
						],
						'type' => 'price',
						'position' => 3,
						'attributes' => [
							'label' => 'Price',
							'placeholder' => 'Price'
						],
						'validation' => [
							'required' => [
								'enable' => false,
								'message' => 'Price is required.'
							],
						],
					],
					'description' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'description',
							],
						],
						'type' => 'textarea',
						'position' => 2,
						'attributes' => [
							'label' => 'Description',
							'placeholder' => 'Description'
						]
					],
					'shortDescription' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'short_description',
							],
						],
						'type' => 'textarea',
						'position' => 2,
						'attributes' => [
							'label' => 'Short Description',
							'placeholder' => 'Short Description'
						]
					],
					'slug' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'slug',
							],
						],
						'type' => 'text',
						'position' => 2,
						'attributes' => [
							'label' => 'Slug',
							'placeholder' => 'Slug',
							'data' => [
								'data-slug' => 1,
								'data-reference' => 'title'
							],
						]
					],
					'metaTitle' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'meta_title',
							],
						],
						'type' => 'text',
						'position' => 2,
						'attributes' => [
							'label' => 'Meta Title',
							'placeholder' => 'Meta Title'
						]
					],
					'metaKeywords' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'meta_keywords',
							],
						],
						'type' => 'textarea',
						'position' => 2,
						'attributes' => [
							'label' => 'Meta Keywords',
							'placeholder' => 'Meta Keywords'
						]
					],
					'metaDescription' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'meta_description',
							],
						],
						'type' => 'textarea',
						'position' => 2,
						'attributes' => [
							'label' => 'Meta Description',
							'placeholder' => 'Meta Description'
						]
					],
					'status' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'status',
							],
						],
						'type' => 'select',
						'select' => [
							'options' => [
								'options' => 'enabledisable'
							]
						],
						'position' => 1,
						'attributes' => [
							'label' => 'Status',
						],
					],
					'category' => [
						'enable' => true,
						'type' => 'checkabletree',
						'position' => 1,
						'attributes' => [
							'label' => 'Category',
						],
						'defer' => [
							'enable' => true
						],
						'view' => [
							'widget' => 'ecommerceProductsCategorySelectableTree'
						],
					],
				],
			],
			'model' => [
				'value' => [
					'index' => cd_config('database.e.product.table.primary')
				],
				'class' => cd_config('database.e.product.model.class'),
				'repository' => [
					'class' => cd_config('database.e.product.repository.class'),
					'index' => cd_config('database.e.product.table.name') . '.' . cd_config('database.e.product.table.primary'),
				],
				'crud' => [
					'duplicate' => [
						'enable' => false],
					'create' => [
						'enable' => true,
						'type' => 'create',
						'crud' => [
							'type' => 'crud',
							'enable' => true,
						],
						'success' => [
							'redirect' => [
								'enable' => true,
								'route' => [
									'name' => 'Module',
									'module' => 'ecommerce-categories'
								]
							],
							'back' => [],
							'message' => 'Created successfull!'
						],
					],
					'update' => [
						'enable' => true,
						'type' => 'update',
						'success' => [
							'route' => [],
							'message' => 'Update successfull!'
						],
						'crud' => [
							'type' => 'crud',
							'enable' => true,
							'ui' => [
								'tag' => 'a',
								'url' => [
									'route' => [
										'name' => 'Module',
										'module' => 'ecommerce-categories',
										'action' => 'update'
									]
								],
								'html' => [
									'input' => []
								],
							],
							'attributes' => [
								'label' => 'Update',
							],
						],
					],
					'view' => [
						'enable' => true,
						'type' => 'view',
						'crud' => [
							'type' => 'crud',
							'enable' => true,
						],
						'actions' => ['update', 'delete']
					],
					'delete' => [
						'enable' => true,
						'type' => 'delete',
						'crud' => [
							'type' => 'crud',
							'enable' => true,
							'ui' => [
								'tag' => 'a',
								'url' => [
									'route' => [
										'name' => 'Module',
										'module' => 'ecommerce-categories',
										'action' => 'delete'
									]
								],
								'html' => [
									'input' => []
								],
							],
							'attributes' => [
								'label' => 'Delete',
							],
						],
						'view' => [
							/**
							 * Template to use to load this form
							 * when CrudAction == delete
							 * @see WidgetType\Form::getForm()
							 */
							'form' => [
								'enable' => false,
								'path' => 'form.index',
								/**
								 * render template before form tag
								 */
								'pre' => [],
								/**
								 * render template after form tag
								 */
								'post' => [],
							],
						],
						/**
						 * After success action configuration
						 */
						'success' => [
							'redirect' => [
								'enable' => true,
								'route' => [
									'name' => 'Module',
									'module' => 'ecommerce-categories',
								]
							],
							'message' => 'Delete successfull!'
						],
					],
				],
			],
		],
	],
];
