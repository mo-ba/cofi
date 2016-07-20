<?php

namespace Cofi\Comparator\Interfaces;
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 17:53
 */
interface ComparatorInterface
{

    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a,$b);
}