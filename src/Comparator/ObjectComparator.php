<?php namespace Cofi\Comparator;

use Cofi\Comparator\Abstracts\AbstractContainerComparator;

/**
 * Class ObjectComparator
 * @package Cofi\Comparator
 */
class ObjectComparator extends AbstractContainerComparator
{
	protected function _isset(&$container, $field)
	{
		return isset($container->$field);
	}

	protected function _get(&$container, $field)
	{
		return $container->$field;
	}
}