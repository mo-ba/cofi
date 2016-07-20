<?php
namespace Cofi\Comparator;

use Cofi\Comparator\Abstracts\AbstractContainerComparator;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 17:54
 */
class ObjectComparator extends AbstractContainerComparator{
    protected function _isset(&$container, $field)
    {
        return isset($container->$field);
    }

    protected function _get(&$container, $field)
    {
        return $container->$field;
    }
}