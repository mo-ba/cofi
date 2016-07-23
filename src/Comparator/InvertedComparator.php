<?php namespace Cofi\Comparator;

use Cofi\Comparator\Abstracts\AbstractComparator;

/**
 * Class InvertedComparator
 * @package Cofi\Comparator
 */
class InvertedComparator extends AbstractComparator
{
	private $inner;

	/**
	 * InvertedComparor constructor.
	 * @param AbstractComparator $inner
	 */
	public function __construct($inner)
	{
		$this->inner = $inner;
	}

	public function invert()
	{
		return $this->inner;
	}


	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return -$this->inner->compare($a, $b);
	}
}