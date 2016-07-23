<?php namespace Cofi\Filter\Abstracts;

use Cofi\Comparator\Interfaces\ComparatorInterface;

/**
 * Class FilterFunction
 * @package Cofi\Filter\Abstracts
 */
final class FilterFunction
{
	/**
	 * ComparatorFunction constructor.
	 */
	final private function __construct()
	{
	}

	public static function isArray()
	{
		return function ($value) {
			return is_array($value);
		};
	}

	public static function isEmpty()
	{
		return function ($value) {
			if (is_string($value)) {
				return strlen($value) == 0;
			}
			return empty($value);
		};
	}

	public static function isNumeric()
	{
		return function ($value) {
			return is_numeric($value);
		};
	}

	public static function isInteger()
	{
		return self::isInt();
	}

	public static function isInt()
	{
		return function ($value) {
			return is_int($value);
		};
	}

	public static function isString()
	{
		return function ($value) {
			return is_string($value);
		};
	}

	public static function isBoolean()
	{
		return self::isBool();
	}

	public static function isBool()
	{
		return function ($value) {
			return is_bool($value);
		};
	}

	public static function isSame($expect)
	{
		return function ($value) use ($expect) {
			return $value == $expect;
		};
	}

	public static function isEqual($expect, $comparator = null)
	{
		return function ($value) use ($expect, $comparator) {
			if ($comparator instanceof ComparatorInterface) {
				return $comparator->compare($value, $expect) == 0;
			}
			return $value == $expect;
		};
	}

	public static function isGreaterThen($expect, $comparator = null)
	{
		return function ($value) use ($expect, $comparator) {
			if ($comparator instanceof ComparatorInterface) {
				return $comparator->compare($value, $expect) > 0;
			}
			return $value > $expect;
		};
	}

	public static function isGreaterThenOrEquals($expect, $comparator = null)
	{
		return function ($value) use ($expect, $comparator) {
			if ($comparator instanceof ComparatorInterface) {
				return $comparator->compare($value, $expect) >= 0;
			}
			return $value >= $expect;
		};
	}


}