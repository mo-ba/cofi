<?php namespace Cofi\Comparator;

use Cofi\Comparator\Abstracts\AbstractComparator;

/**
 * Class SimpleComparator
 * @package Cofi\Comparator
 */
class SimpleComparator extends AbstractComparator
{
	/**
	 * @var \Closure
	 */
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
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		$m = $this->method;
		return $m($a, $b);
	}
}