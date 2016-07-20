<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 21:38
 */

namespace Cofi\Filter\Abstracts;


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
            if(is_string($value)){
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

    public static function isEqual($expect)
    {
        return function ($value) use ($expect) {
            return $value == $expect;
        };
    }

}