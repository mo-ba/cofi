<?php namespace Cofi\Filter;

use Cofi\Filter\Abstracts\Filter as AbstractFilter;

/**
 * Class InvertedFilter
 * @package Cofi\Filter
 */
class InvertedFilter extends AbstractFilter
{


	private $inner;

	/**
	 * InvertedComparor constructor.
	 * @param AbstractFilter $inner
	 */
	public function __construct($inner)
	{
		$this->inner = $inner;
	}

	public function not()
	{
		return $this->inner;
	}


	public function apply($value)
	{
		return !$this->inner->apply($value);
	}


}