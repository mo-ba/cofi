<?php

namespace CofiTest\Filter;


use Cofi\Filter\Abstracts\FilterFunction;

class FilterFunctionTest extends \PHPUnit_Framework_TestCase
{

    public function testIsNum()
    {
        $f = FilterFunction::isNumeric();
        $this->assertTrue($f(2));
        $this->assertTrue($f("2"));
        $this->assertTrue($f(2.8));
        $this->assertTrue($f(0x2));

        $this->assertFalse($f('aaab'));
        $this->assertFalse($f(true));
        $this->assertFalse($f(null));
        $this->assertFalse($f([1]));


    }
    public function testIsInt()
    {
        $f = FilterFunction::isInt();
        $this->assertTrue($f(2));
        $this->assertFalse($f("2"));
        $this->assertFalse($f(2.8));
        $this->assertTrue($f(0x2));

        $this->assertFalse($f('aaab'));
        $this->assertFalse($f(true));
        $this->assertFalse($f(null));
        $this->assertFalse($f([1]));


    }
    public function testIsArray()
    {
        $f = FilterFunction::isArray();
        $this->assertFalse($f(2));
        $this->assertFalse($f("2"));
        $this->assertFalse($f(2.8));
        $this->assertFalse($f(0x2));

        $this->assertFalse($f('aaab'));
        $this->assertFalse($f(true));
        $this->assertFalse($f(null));
        $this->assertTrue($f([1]));


    }
    public function testIsEmpty()
    {
        $f = FilterFunction::isEmpty();
        $this->assertFalse($f(2));
        $this->assertFalse($f("2"));
        $this->assertFalse($f(2.8));
        $this->assertFalse($f(0x2));

        $this->assertFalse($f('aaab'));
        $this->assertFalse($f(true));
        $this->assertFalse($f([1]));
        $this->assertFalse($f("0"));

        $this->assertTrue($f([]));
        $this->assertTrue($f(""));
        $this->assertTrue($f(0));
        $this->assertTrue($f(null));


    }
    public function testIsString()
    {
        $f = FilterFunction::isString();
        $this->assertFalse($f(2));
        $this->assertTrue($f("2"));
        $this->assertFalse($f(2.8));
        $this->assertFalse($f(0x2));

        $this->assertTrue($f('aaab'));
        $this->assertFalse($f(true));
        $this->assertFalse($f([1]));
        $this->assertTrue($f("0"));

        $this->assertFalse($f([]));
        $this->assertTrue($f(""));
        $this->assertFalse($f(0));
        $this->assertFalse($f(null));


    }
}