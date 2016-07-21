<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 22:52
 */

namespace CofiTest\Filter;


use Cofi\Filter;
use Cofi\Filter\Abstracts\FilterFunction;

class ArrayFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {

        $data = [2, '43', 0, false, null, [], '', ['0']];

        $expected = [2, 0];

        $this->assertEquals($expected, array_values(array_filter($data, Filter::isInt())));
    }

    public function testFilterNot()
    {
        $data = [2, '43', 0, false, null, [], '', ['0']];
        $expected = ['43', false, null, [], '', ['0']];
        $this->assertEquals($expected, array_values(array_filter($data, Filter::isInt()->not())));

    }

    public function testFilter2()
    {
        $filter =
            Filter::_or(
                FilterFunction::isInt(),
                Filter::_and(
                    Filter::isArray(),
                    Filter::isEmpty()->not()
                )
            );

        $data = [2, '43', 0, false, null, [], '', ['0']];

        $expected = [2, 0, ['0']];

        $this->assertEquals($expected, array_values(array_filter($data, $filter)));
    }
}
