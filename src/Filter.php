<?php namespace Cofi;

use Cofi\Comparator\Interfaces\ComparatorInterface;
use Cofi\Filter\FilterFunction;
use Cofi\Filter\AndFilter;
use Cofi\Filter\OrFilter;
use Cofi\Filter\SimpleFilter;

final class Filter
{

	/**
	 * Filter constructor.
	 * @codeCoverageIgnore
	 */
	private function __construct()
	{
	}

	/*
	 * ----------------------------------------------------------
	 * -----------------------BUILTIN----------------------------
	 * ----------------------------------------------------------
	 */

	/**
	 * @return SimpleFilter
	 */
	public static function isArray()
	{
		return new SimpleFilter(FilterFunction::isArray());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isEmpty()
	{
		return new SimpleFilter(FilterFunction::isEmpty());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isString()
	{
		return new SimpleFilter(FilterFunction::isString());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isInt()
	{
		return new SimpleFilter(FilterFunction::isInt());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isBool()
	{
		return new SimpleFilter(FilterFunction::isBool());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isBoolean()
	{
		return new SimpleFilter(FilterFunction::isBoolean());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isInteger()
	{
		return new SimpleFilter(FilterFunction::isInteger());
	}

	/**
	 * @return SimpleFilter
	 */
	public static function isNumeric()
	{
		return new SimpleFilter(FilterFunction::isNumeric());
	}

	/*
	 * ----------------------------------------------------------
	 * ------------------------LOGIC-----------------------------
	 * ----------------------------------------------------------
	 */

	/**
	 * @return AndFilter
	 */
	public static function _and()
	{
		return new AndFilter(func_get_args());
	}

	/**
	 * @return OrFilter
	 */
	public static function _or()
	{
		return new OrFilter(func_get_args());
	}

	/*
	 * ----------------------------------------------------------
	 * ---------------------COMPARATORS--------------------------
	 * ----------------------------------------------------------
	 */

	/**
	 * @param $expect
	 * @return SimpleFilter
	 */
	public static function isSame($expect)
	{
		return new SimpleFilter(FilterFunction::isSame($expect));
	}
	/**
	 * @param $expect
	 * @param null|ComparatorInterface|callable|\Closure $comparator
	 * @return SimpleFilter
	 */
	public static function isEqual($expect, $comparator = null)
	{
		return new SimpleFilter(FilterFunction::isEqual($expect, $comparator));
	}
	/**
	 * @param $expect
	 * @param null|ComparatorInterface|callable|\Closure $comparator
	 * @return SimpleFilter
	 */
	public static function isNotEqual($expect, $comparator = null)
	{
		return new SimpleFilter(FilterFunction::isNotEqual($expect, $comparator));
	}

	/**
	 * @param $expect
	 * @param null $comparator
	 * @return SimpleFilter
	 */
	public static function isGreaterThen($expect, $comparator = null)
	{
		return new SimpleFilter(FilterFunction::isGreaterThen($expect, $comparator));
	}
	/**
	 * @param $expect
	 * @param null $comparator
	 * @return SimpleFilter
	 */
	public static function isLessThen($expect, $comparator = null)
	{
		return new SimpleFilter(FilterFunction::isLessThen($expect, $comparator));
	}

	/**
	 * @param $expect
	 * @param null $comparator
	 * @return SimpleFilter
	 */
	public static function isGreaterThenOrEquals($expect, $comparator = null)
	{
		return new SimpleFilter(FilterFunction::isGreaterThenOrEquals($expect, $comparator));
	}
	/**
	 * @param $expect
	 * @param null $comparator
	 * @return SimpleFilter
	 */
	public static function isLessThenOrEquals($expect, $comparator = null)
	{
		return new SimpleFilter(FilterFunction::isLessThenOrEquals($expect, $comparator));
	}

}