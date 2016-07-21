<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 21:37
 */

namespace Cofi;


use Cofi\Comparator\Interfaces\ComparatorInterface;
use Cofi\Filter\Abstracts\FilterFunction;
use Cofi\Filter\OrFilter;
use Cofi\Filter\SimpleFilter;
use Cofi\Filter\AndFilter;

final class Filter
{

    /**
     * Filter constructor.
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
     * @param null|ComparatorInterface|callable|\Closure $comparator
     * @return SimpleFilter
     */
    public static function isEqual($expect, $comparator = null)
    {
        return new SimpleFilter(FilterFunction::isEqual($expect, $comparator));
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
    public static function isGreaterThenOrEquals($expect, $comparator = null)
    {
        return new SimpleFilter(FilterFunction::isGreaterThenOrEquals($expect, $comparator));
    }
}