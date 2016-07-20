<?php

namespace Cofi\Comparator;
use Cofi\Comparator\Abstracts\AbstractComparator;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 18:04
 */
class SimpleComparator extends AbstractComparator
{
    private $method;

    /**
     * SimpleComparator constructor.
     * @param $method
     */
    public function __construct(\Closure $method)
    {
        $this->method = $method;
    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a, $b)
    {
        $m = $this->method;
        return $m($a, $b);
    }
}