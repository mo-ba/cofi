<?php

namespace Cofi\Filter\Abstracts;
use Cofi\Filter\Interfaces\FilterInterface;
use Cofi\Filter\InvertedFilter;

abstract class AbstractFilter implements FilterInterface
{

    public function invert()
    {
        return new InvertedFilter($this);
    }

    function __invoke()
    {
        return call_user_func_array([$this, 'apply'], func_get_args());
    }


}