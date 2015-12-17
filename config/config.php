<?php

return [
	'backend' => [
		'access' => [
			'minimum' => 'moderator',
		],
		'design' => [
			'header' => [
				'logo' => cd_ecommerce_asset('img/backendlogo.png'),
			],
			'footer' => [
				'text' => '&copy Copyright ' . date('Y') . ' ClaremontDesign. All rights reserved.',
			],
		],
	],
	'widgets' => [
	],
	'database' => [
		'e' => [
			'product' => [
				'table' => [
					'name' => 'e_product',
					'primary' => 'product_id'
				],
				'model' => [
					'class' => Claremontdesign\Ecommerce\Model\Product::class,
					'fillable' => ['title', 'description', 'status', 'nickname', 'slug', 'redirect_url', 'price', 'qty', 'meta_title', 'meta_keywords', 'meta_description']
				],
				'repository' => [
					'class' => Claremontdesign\Ecommerce\Model\Repository\Product::class
				]
			],
			'productCategory' => [
				'table' => [
					'name' => 'e_category',
					'primary' => 'category_id',
				],
				'model' => [
					'class' => Claremontdesign\Ecommerce\Model\Category::class,
					'fillable' => ['title', 'description', 'status', 'nickname', 'slug', 'redirect_url']
				],
				'repository' => [
					'class' => Claremontdesign\Ecommerce\Model\Repository\Category::class
				]
			],
			'productCategoryPivot' => [
				'table' => [
					'name' => 'e_category_products',
					'primary' => 'pivot_id',
				],
				'model' => [
					'class' => Claremontdesign\Ecommerce\Model\CategoryProducts::class,
					'fillable' => ['product_id', 'category_id', 'position'],
				],
				'repository' => [
					'class' => Claremontdesign\Ecommerce\Model\Repository\CategoryProducts::class
				]
			]
		]
	],
	'routes' => [
	],
];
