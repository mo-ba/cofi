<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 21:56
 */

namespace Cofi\Filter;


use Cofi\Filter\Abstracts\AbstractFilter;

class InvertedFilter extends AbstractFilter
{


    private $inner;

    /**
     * InvertedComparor constructor.
     * @param AbstractFilter $inner
     */
    public function __construct($inner)
    {
        $this->inner = $inner;
    }

    public function not()
    {
        return $this->inner;
    }


    public function apply($value)
    {
        return !$this->inner->apply($value);
    }


}