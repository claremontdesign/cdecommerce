<?php

namespace Claremontdesign\Ecommerce\Model\Repository;

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
use Claremontdesign\Cdbase\Model\Repository\Repository;
use Claremontdesign\Cdbase\Modules\RepositoryModuleInterface;
use Claremontdesign\Ecommerce\Model\Product as Model;
use Claremontdesign\Ecommerce\Model\Category as ModelCategory;

class Product extends Repository implements RepositoryModuleInterface
{

	/**
	 * Find Model by Id
	 * @param string $id
	 * @return Model
	 */
	public function byId($id)
	{
		$filters = [
			$this->_table() . '.' . $this->_primaryKey() => $id
		];
		return $this->_cast($this->repo->setDebug(false)->getAll($this->_columns(), $filters, $this->_sort(), $this->_joins(), false, [])->first());
	}

	/**
	 * Find records by RecordId Id
	 * @see Traits\Repository::fetchRecord
	 * @param string $id
	 * @return Model
	 */
	public function byRecordId($id)
	{
		return $this->byId($id);
	}

	/**
	 * REturn all Rows
	 * @param array $columns
	 * @param array $filters
	 * @param array $sort
	 * @param array $joins
	 * @param array $paginate
	 * @param array $options
	 * @return Collection|null
	 */
	public function getAll($columns = ['*'], $filters = [], $sort = [], $joins = [], $paginate = [], $options = [], $debug = false)
	{
		return $this->_casts($this->repo->setDebug($debug)->getAll($columns, $filters, $sort, $joins, $paginate, $options));
	}

	/**
	 *
	 * @param \Claremontdesign\Ecommerce\Model\Category $category
	 * @param type $columns
	 * @param type $filters
	 * @param type $sort
	 * @param type $joins
	 * @param type $paginate
	 * @param type $options
	 * @param type $debug
	 * @return Collection of Model
	 */
	public function byNestedSet(ModelCategory $node, $columns = ['*'], $filters = [], $sort = [], $joins = [], $paginate = [], $options = [], $debug = false)
	{
		if(!empty($filters[$this->_categoryPrimaryKey()]))
		{
			unset($filters[$this->_categoryPrimaryKey()]);
		}
		$nodeIds = $node->getDescendantsAndSelf()->lists(cd_config('database.e.productCategory.table.primary'));
		$columns = [
				$this->_table() . '.*',
				$this->_pivotTable() . '.position',
			];
		if($this->repo->getModel() instanceof \Claremontdesign\Cdbase\Repository\Contracts\PositionableInterface)
		{
			// $sort = [$this->_pivotTable() . '.position' => 'ASC'];
		}
		$joins = [];
		$joins[] = [
			'model' => $this->_pivotTable() . ' as ' . $this->_pivotTable(),
			'foreign_key' => $this->_pivotTable() . '.' . $this->_primaryKey(),
			'local_key' => $this->_table() . '.' . $this->_primaryKey(),
		];
		$joins[] = [
			'model' => $this->_categoryTable() . ' as ' . $this->_categoryTable(),
			'foreign_key' => $this->_categoryTable() . '.' . $this->_categoryPrimaryKey(),
			'local_key' => $this->_pivotTable() . '.' . $this->_categoryPrimaryKey(),
		];


		$filters[] = [
			$this->_pivotTable() . '.' . $this->_categoryPrimaryKey() => [
				'in' => [
					'field' => $this->_pivotTable() . '.' . $this->_categoryPrimaryKey(),
					'values' => $nodeIds
				]
			]
		];

		return $this->getAll($columns, $filters, $sort, $joins, $paginate, $options, $debug);
	}

	/**
	 * Cast each Model
	 * @return Model
	 */
	protected function _cast($row)
	{
		return $row;
	}

	/**
	 * Cast Multiple Rows
	 * @param array $rows
	 * @return Collection
	 */
	protected function _casts($rows)
	{
		if(!$rows->isEmpty())
		{
			$i = 0;
			foreach ($rows as $row)
			{
				$rows->put($i, $this->_cast($row));
				$i++;
			}
		}
		return $rows;
	}

	/**
	 * Columns
	 * @return array
	 */
	protected function _columns()
	{
		$columns = [
			$this->_table() . '.*'
		];
		return $columns;
	}

	/**
	 * Joins
	 * @return array
	 */
	protected function _joins()
	{
		$joins = [];
		return $joins;
	}

	/**
	 * Sort
	 * @return array
	 */
	protected function _sort()
	{
		$sort = [];
		return $sort;
	}

	/**
	 * Return the user Table
	 * @return string
	 */
	protected function _table()
	{
		return $this->repo->getModel()->getTable();
	}

	/**
	 * Return the Primary Key
	 * @return string
	 */
	protected function _primaryKey()
	{
		return $this->repo->getModel()->getKeyName();
	}

	/**
	 * Return the Status Column
	 * @return string
	 */
	protected function _statusColumn()
	{
		return $this->repo->getModel()->getStatusColumn();
	}

	/**
	 * Return the Item Table
	 * @return string
	 */
	protected function _categoryTable()
	{
		return cd_config('database.e.productCategory.table.name');
	}

	/**
	 * Return the Primary Key
	 * @return string
	 */
	protected function _categoryPrimaryKey()
	{
		return cd_config('database.e.productCategory.table.primary');
	}

	/**
	 * Return the Item Table
	 * @return string
	 */
	protected function _pivotTable()
	{
		return cd_config('database.e.productCategoryPivot.table.name');
	}

}
