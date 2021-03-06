<?php

namespace Claremontdesign\Ecommerce\Model;

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
use Claremontdesign\Cdbase\Repository\Contracts\FilterableInterface;
use Claremontdesign\Cdbase\Repository\Contracts\JoinableInterface;
use Claremontdesign\Cdbase\Repository\Contracts\SortableInterface;
use Claremontdesign\Cdbase\Repository\Contracts\CategorybleInterface;
use Claremontdesign\Cdbase\Repository\Traits\Filterable;
use Claremontdesign\Cdbase\Repository\Traits\Joinable;
use Claremontdesign\Cdbase\Repository\Traits\Sortable;
use Claremontdesign\Cdbase\Repository\Contracts\PositionableInterface;
use Claremontdesign\Cdbase\Model\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Claremontdesign\Cdbase\Widgets\ModelInterface as WidgetModelInterface;
use Claremontdesign\Cdbase\Widgets\WidgetTypes\WidgetTypeInterface;

class Product extends Model implements WidgetModelInterface, FilterableInterface, JoinableInterface, PositionableInterface, SortableInterface, CategorybleInterface
{

	use Filterable,
	 SoftDeletes,
	 Joinable,
	 Sortable;

	const STATUS_ENABLE = 1;
	const STATUS_DISABLE = 0;

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->table = cd_config('database.e.product.table.name');
		$this->primaryKey = cd_config('database.e.product.table.primary');
		$this->fillable = cd_config('database.e.product.model.fillable');
		parent::__construct($attributes);
	}

	// <editor-fold defaultstate="collapsed" desc="RELATIONSHIPS">
	/**
	 * Categories
	 * @return Collection
	 */
	public function categories()
	{
		return $this->belongsToMany(Category::class, cd_config('database.e.productCategoryPivot.table.name'), cd_config('database.e.product.table.primary'), cd_config('database.e.productCategory.table.primary'));
	}

	/**
	 * Product Categories
	 * @return Collection
	 */
	public function scopeCategories($query = null)
	{
		return $this->categories();
	}

	/**
	 * Product Categories
	 *
	 * @return Collection
	 */
	public function getCategories()
	{
		return $this->categories()->get();
	}

	/**
	 * By Category
	 * @param type $query
	 * @param \Claremontdesign\Ecommerce\Model\Category $category
	 * @return type
	 */
	public function scopeCategorized($query, Category $category = null)
	{
		if(is_null($category))
		{
			return $query->with(cd_config('database.e.productCategory.table.name'));
		}

		$categoryIds = $category->getDescendantsAndSelf()->lists(cd_config('database.e.productCategory.table.primary'));
		return $query->with('categories')
						->join(
						cd_config('database.e.productCategoryPivot.table.name'), cd_config('database.e.productCategoryPivot.table.name') . '.' . cd_config('database.e.product.table.primary'), '=', cd_config('database.e.product.table.name') . '.' . cd_config('database.e.product.table.primary'))
						->whereIn(cd_config('database.e.productCategoryPivot.table.name') . '.' . cd_config('database.e.productCategory.table.primary'), $categoryIds);
	}

	// </editor-fold>

	/**
	 * REturn the Item Position
	 * @return integer
	 */
	public function position()
	{
		if(isset($this->position))
		{
			return $this->position;
		}
		return null;
	}

	public function pivotItemId()
	{
		return $this->id();
	}

	public function pivotCategoryId()
	{
		if(isset($this->pivot_category_id))
		{
			return $this->pivot_category_id;
		}
		return null;
	}

	public function updatePivotPosition($categoryId, $position)
	{
		$this->categories()->updateExistingPivot([$categoryId], ['position' => $position]);
		return $this->save();
	}

	/**
	 * Return the name of the 'status' column
	 * @return string
	 */
	public function getStatusColumn()
	{
		return 'status';
	}

	/**
	 * Item Id
	 * @return integer
	 */
	public function id()
	{
		return (int) $this->{$this->primaryKey};
	}

	/**
	 * Title
	 * @return string
	 */
	public function title()
	{
		return $this->title;
	}

	/**
	 * Description
	 * @return string
	 */
	public function description()
	{
		return $this->description;
	}

	// <editor-fold defaultstate="collapsed" desc="WIDGET">
	/**
	 * Check widget access
	 * @return boolean
	 */
	public function checkWidgetAccess(WidgetTypeInterface $widget, $crud, $access = null)
	{
		return true;
	}

	/**
	 *
	 * @param \Claremontdesign\Cdbase\Widgets\WidgetTypes\WidgetTypeInterface $widget
	 * @param type $crud
	 * @param type $data
	 */
	public function widgetPreProcess(WidgetTypeInterface $widget, $crud, $modelId, $data)
	{

	}

	/**
	 *
	 * @param \Claremontdesign\Cdbase\Widgets\WidgetTypes\WidgetTypeInterface $widget
	 * @param type $crud
	 * @param type $data
	 */
	public function widgetPostProcess(WidgetTypeInterface $widget, $crud, $modelId, $data, $result)
	{
		if($crud == 'update')
		{
			if(!empty($data['category']))
			{
				$this->categories()->sync($data['category']);
			}
			else
			{
				$this->categories()->detach();
			}
		}
	}

	/**
	 * Fix array values to column values
	 * 	Map the given values to column values
	 * @param  array $assocArray [description]
	 * @return array
	 */
	public function fixValueToColumnValue($assocArray, $mode = null)
	{
		return parent::fixValueToColumnValue($assocArray, $mode);
	}

	// </editor-fold>
}
