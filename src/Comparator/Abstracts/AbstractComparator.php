<?php namespace Cofi\Comparator\Abstracts;

use Cofi\Comparator\Interfaces\ComparatorInterface;
use Cofi\Comparator\InvertedComparator;

/**
 * Class AbstractComparator
 * @package Cofi\Comparator\Abstracts
 */
abstract class AbstractComparator implements ComparatorInterface
{
	/**
	 * @return InvertedComparator
	 */
	public function invert()
	{
		return new InvertedComparator($this);
	}

	/**
	 * @return int
	 */
	function __invoke()
	{
		return call_user_func_array([$this, 'compare'], func_get_args());
	}


}