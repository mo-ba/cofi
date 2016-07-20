<?php

namespace CofiTest\Filter;


use Cofi\Filter;

class FilterCompoundTest extends \PHPUnit_Framework_TestCase
{


    public function testAnd()
    {
        $filter = Filter::_and(Filter::isArray(), Filter::isEmpty());


        $this->assertFalse($filter(['324']));
        $this->assertTrue($filter([]));
        $this->assertFalse($filter(null));
        $this->assertFalse($filter(0));
        $this->assertFalse($filter(''));
        $this->assertFalse($filter(false));

    }

    public function testNand()
    {
        $filter = Filter::_and(Filter::isArray(), Filter::isEmpty())->invert();


        $this->assertNotFalse($filter(['324']));
        $this->assertNotTrue($filter([]));
        $this->assertNotFalse($filter(null));
        $this->assertNotFalse($filter(0));
        $this->assertNotFalse($filter(''));
        $this->assertNotFalse($filter(false));

    }

    public function testOr()
    {
        $filter = Filter::_or(
            Filter::isArray(),
            Filter::isEmpty(),
            function ($e) {
                return $e === 'aaab';
            }
        );


        $this->assertTrue($filter(['324']));
        $this->assertTrue($filter([]));
        $this->assertTrue($filter(null));
        $this->assertTrue($filter(0));
        $this->assertTrue($filter(''));
        $this->assertTrue($filter(false));
        $this->assertFalse($filter('aaaa'));
        $this->assertTrue($filter('aaab'));

    }

    public function testNor()
    {
        $filter = Filter::_or(
            Filter::isArray(),
            Filter::isEmpty(),
            function ($e) {
                return $e === 'aaab';
            }
        )->invert();


        $this->assertNotTrue($filter(['324']));
        $this->assertNotTrue($filter([]));
        $this->assertNotTrue($filter(null));
        $this->assertNotTrue($filter(0));
        $this->assertNotTrue($filter(''));
        $this->assertNotTrue($filter(false));
        $this->assertNotFalse($filter('aaaa'));
        $this->assertNotTrue($filter('aaab'));

    }

}