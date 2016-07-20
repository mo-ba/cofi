<?php
namespace Cofi\Comparator\Abstracts;
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 17:55
 */
final class ComparatorFunction
{


    /**
     * ComparatorFunction constructor.
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

}