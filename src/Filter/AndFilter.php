<?php namespace Cofi\Filter;

use Cofi\Filter\Abstracts\AbstractFilter;

/**
 * Class AndFilter
 * @package Cofi\Filter
 */
class AndFilter extends AbstractFilter
{

	private $filters = [];

	/**
	 * AndFilter constructor.
	 * @param array $filters
	 */
	public function __construct(array $filters)
	{
		$this->filters = $filters;
	}


	public function apply($value)
	{
		foreach ($this->filters as $filter) {
			if (!$filter($value)) {
				return false;
			}
		}
		return true;
	}
}