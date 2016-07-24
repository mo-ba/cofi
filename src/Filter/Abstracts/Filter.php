<?php namespace Cofi\Filter\Abstracts;

use Cofi\Filter\Interfaces\FilterInterface;
use Cofi\Filter\InvertedFilter;

/**
 * Class AbstractFilter
 * @package Cofi\Filter\Abstracts
 */
abstract class Filter implements FilterInterface
{

	public function not()
	{
		return new InvertedFilter($this);
	}

	function __invoke()
	{
		return call_user_func_array([$this, 'apply'], func_get_args());
	}


}