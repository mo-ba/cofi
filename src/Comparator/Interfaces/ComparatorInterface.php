<?php namespace Cofi\Comparator\Interfaces;
/**
 * Interface ComparatorInterface
 * @package Cofi\Comparator\Interfaces
 */
interface ComparatorInterface
{

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b);
}