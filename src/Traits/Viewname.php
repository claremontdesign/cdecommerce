<?php

namespace Claremontdesign\Ecommerce\Traits;

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
trait Viewname
{

	/**
	 * REturn the View Name
	 * @param string $viewName The View Name
	 * @return string
	 */
	protected function viewName($viewName)
	{
		return cd_ecommerce_view_name($viewName);
	}

}
