<?php namespace Cofi\Filter;

use Cofi\Filter\Abstracts\AbstractFilter;

/**
 * Class SimpleFilter
 * @package Cofi\Filters
 */
class SimpleFilter extends AbstractFilter
{

	private $method;

	/**
	 * SimpleComparator constructor.
	 * @param $method
	 */
	public function __construct(\Closure $method)
	{
		$this->method = $method;
	}

	/**
	 * @param $value
	 * @return boolean
	 */
	public function apply($value)
	{
		$m = $this->method;
		return $m($value);
	}
}