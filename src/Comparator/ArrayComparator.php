<?php namespace Cofi\Comparator;

use Cofi\Comparator\Abstracts\AbstractContainerComparator;

/**
 * Class ArrayComparator
 * @package Cofi\Comparator
 */
class ArrayComparator extends AbstractContainerComparator
{
	protected function _isset(&$container, $field)
	{
		return isset($container[$field]);
	}

	protected function _get(&$container, $field)
	{
		return $container[$field];
	}
}