<?php namespace Cofi\Filter\Interfaces;
/**
 * Interface FilterInterface
 * @package Cofi\Filter\Interfaces
 */
interface FilterInterface
{
	/**
	 * @param $value
	 * @return bool
	 */
	public function apply($value);
}