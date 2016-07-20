<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 21:37
 */

namespace Cofi;


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


    public static function isArray()
    {
        return new SimpleFilter(FilterFunction::isArray());
    }

    public static function isEmpty()
    {
        return new SimpleFilter(FilterFunction::isEmpty());
    }

    public static function isString()
    {
        return new SimpleFilter(FilterFunction::isString());
    }

    public static function isInt()
    {
        return new SimpleFilter(FilterFunction::isInt());
    }

    public static function isBool()
    {
        return new SimpleFilter(FilterFunction::isBool());
    }

    public static function isBoolean()
    {
        return new SimpleFilter(FilterFunction::isBoolean());
    }

    public static function isEqual($expect)
    {
        return new SimpleFilter(FilterFunction::isEqual($expect));
    }

    public static function isInteger()
    {
        return new SimpleFilter(FilterFunction::isInteger());
    }

    public static function isNumeric()
    {
        return new SimpleFilter(FilterFunction::isNumeric());
    }

    public static function _and()
    {
        return new AndFilter(func_get_args());
    }

    public static function _or()
    {
        return new OrFilter(func_get_args());
    }
}