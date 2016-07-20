<?php

namespace Cofi;



use Cofi\Comparator\Abstracts\ComparatorFunction;
use Cofi\Comparator\SimpleComparator;

final class Comparator
{


    /**
     * Comparator constructor.
     */
    final private function __construct()
    {
    }

    public static function init(\Closure $cls)
    {
        return new SimpleComparator($cls);

    }

    public static function number($delta = 0)
    {
        return new SimpleComparator(ComparatorFunction::number($delta));

    }

    public static function string()
    {

        return new SimpleComparator(ComparatorFunction::string());
    }
}