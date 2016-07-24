<?php namespace Cofi\Comparator;
/**
 * Class ComparatorFunction
 * @package Cofi\Comparator\Abstracts
 */
final class ComparatorFunction
{


	/**
	 * ComparatorFunction constructor.
	 * @codeCoverageIgnore
	 */
	final private function __construct()
	{
	}

	public static function number($delta = 0)
	{
		return function ($a, $b) use ($delta) {
			$dif = $a - $b;
			if (abs($dif) > $delta) {
				if ($dif < 0) {
					return -1;
				}
				return 1;
			} else {
				return 0;
			}
		};
	}

	public static function string()
	{
		return function ($a, $b) {
			$dif = strcmp($a, $b);
			return $dif == 0 ? 0 : ($dif < 0 ? -1 : 1);
		};
	}
	public static function stringLength()
	{
		return function ($a, $b) {
			return strlen($a) - strlen($b);
		};
	}

}