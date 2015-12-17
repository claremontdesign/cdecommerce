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
if(!function_exists('cd_ecommerce'))
{

	function cd_ecommerce()
	{
		return app('ecommerce');
	}

}
if(!function_exists('cd_ecommerce_tag'))
{

	/**
	 * Return this packge tag
	 * @return string
	 */
	function cd_ecommerce_tag()
	{
		return 'ecommerce';
	}

}
if(!function_exists('cd_ecommerce_template'))
{

	/**
	 * Return this packge template
	 * @return string
	 */
	function cd_ecommerce_template()
	{
		return cd_ecommerce_tag() . '::templates.' . cd_template() . '.template';
	}

}
if(!function_exists('cd_ecommerce_view_name'))
{

	/**
	 * Return this package view name
	 * view(cd_ecommerce_view_name('view-name')) = nhr::view-name
	 * @param string $view The View Name
	 * @return string
	 */
	function cd_ecommerce_view_name($view)
	{
		return cd_ecommerce_tag() . '::templates.' . cd_template() . '.' . $view;
	}

}
if(!function_exists('cd_ecommerce_asset'))
{

	/**
	 * Return the public path to an asset.
	 * 	path to return is relative to package template folder.
	 * 	If you want to return an asset relative to the public folder,
	 * 	use larvel's asset() instead
	 * @param string $asset The asset
	 * @return string
	 */
	function cd_ecommerce_asset($asset = null)
	{
		return asset('assets') . '/' . fixDoubleSlash(cd_ecommerce_tag() . '/templates/' . cd_template() . '/' . $asset);
	}

}

