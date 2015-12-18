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
	'template' => [
		'backend' => [
			'nav' => [
				'main' => [
					'ecommerce' => [
						'breadcrumbs' => true,
						'label' => 'Ecommerce',
						'title' => 'Ecommerce',
						'icon' => 'fa fa-shopping-cart',
						'access' => 'minimum',
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'ecommerce'
							],
						],
						'children' => [
							'products' => [
								'breadcrumbs' => true,
								'label' => 'Products',
								'title' => 'Products',
								'icon' => 'fa fa-shopping-cart',
								'access' => 'minimum',
								'enable' => true,
								'url' => [
									'route' => [
										'name' => 'Module',
										'module' => 'ecommerce-products'
									],
								],
								'children' => []
							],
							'productsCategory' => [
								'breadcrumbs' => true,
								'label' => 'Categories',
								'title' => 'Categories',
								'icon' => 'fa fa-tags',
								'access' => 'minimum',
								'enable' => true,
								'url' => [
									'route' => [
										'name' => 'Module',
										'module' => 'ecommerce-category'
									],
								],
								'children' => []
							],
						]
					],
				]
			],
		],
	],
	'modules' => [
		'ecommerce' => [
			'enable' => true,
			'name' => 'Ecommerce',
			'metas' => [
				'pagetitle' => 'Ecommerce',
				'pagesubtitle' => 'Manage e-Commerce.'
			],
			'breadcrumb' => [
				'nav::ecommerce'
			],
			'access' => 'minimum',
			'actions' => [
				'index' => [
					'enable' => true,
					'view' => [
						'template' => false
					],
					'widgets' => ['ecommerceDashboard']
				]
			],
		]
	],
	'widgets' => [
		'ecommerceDashboard' => [
			'enable' => true,
			'type' => 'view',
			'view' => [
				'enable' => true,
				'template' => function(){
					return cd_ecommerce_view_name('dashboard.index');
				},
			],
		]
	],
];
return array_merge_recursive(
		$config, require __DIR__ . '/../widgets/ecommerceProductsCategorySelectableTree.php'
		);
