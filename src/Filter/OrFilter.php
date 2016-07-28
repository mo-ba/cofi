<?php namespace Cofi\Filter;

use Cofi\Filter\Abstracts\AbstractFilter;

/**
 * Class OrFilter
 * @package Cofi\Filter
 */
class OrFilter extends AbstractFilter
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
			if ($filter($value)) {
				return true;
			}
		}
		return false;
	}
}