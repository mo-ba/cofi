<?php

namespace Cofi;

use Cofi\Comparator\ComparatorFunction;
use Cofi\Comparator\SimpleComparator;

/**
 * Class Comparator
 * @package Cofi
 */
final class Comparator
{
	/**
	 * Comparator constructor.
	 * @codeCoverageIgnore
	 */
	final private function __construct()
	{
	}

	/**
	 * @param \Closure $cls
	 * @return SimpleComparator
	 */
	public static function init(\Closure $cls)
	{
		return new SimpleComparator($cls);

	}

	/**
	 * @param int $delta
	 * @return SimpleComparator
	 */
	public static function number($delta = 0)
	{
		return new SimpleComparator(ComparatorFunction::number($delta));

	}

	/**
	 * @return SimpleComparator
	 */
	public static function string()
	{

		return new SimpleComparator(ComparatorFunction::string());
	}
}