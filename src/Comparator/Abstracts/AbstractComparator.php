<?php

namespace Cofi\Comparator\Abstracts;
use Cofi\Comparator\Interfaces\ComparatorInterface;
use Cofi\Comparator\InvertedComparator;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 18:00
 */
abstract class AbstractComparator implements ComparatorInterface
{

    public function invert()
    {
        return new InvertedComparator($this);
    }

    function __invoke()
    {
        return call_user_func_array([$this, 'compare'], func_get_args());
    }


}