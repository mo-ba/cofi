<?php
namespace CofiTest\Comparator;
use Cofi\Comparator;
use Cofi\Comparator\Abstracts\ComparatorFunction;
use PHPUnit_Framework_TestCase;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.07.16
 * Time: 19:01
 */
class SimpleComparatorTest extends PHPUnit_Framework_TestCase
{

    public function testInit()
    {
        $f =  Comparator::init(ComparatorFunction::number());

        $this->assertEquals(-1,$f(1,2));
        $this->assertEquals(-1,$f(1,32));
        $this->assertEquals(1,$f(10,2));
        $this->assertEquals(0,$f(2,2));
        $this->assertEquals(0,$f(-2,-2));
        $this->assertEquals(1,$f(1.53,1.52));
        $this->assertEquals(-1,$f(1.53,1.54));
        $this->assertEquals(0,$f(1.53,1.53));
    }
    public function testNumber()
    {
        $f =  Comparator::number();

        $this->assertEquals(-1,$f(1,2));
        $this->assertEquals(-1,$f(1,32));
        $this->assertEquals(1,$f(10,2));
        $this->assertEquals(0,$f(2,2));
        $this->assertEquals(0,$f(-2,-2));
        $this->assertEquals(1,$f(1.53,1.52));
        $this->assertEquals(-1,$f(1.53,1.54));
        $this->assertEquals(0,$f(1.53,1.53));
    }
    public function testNumberInverted()
    {
        $f =  Comparator::number()->invert();

        $this->assertEquals(1,$f(1,2));
        $this->assertEquals(1,$f(1,32));
        $this->assertEquals(-1,$f(10,2));
        $this->assertEquals(0,$f(2,2));
        $this->assertEquals(0,$f(-2,-2));
        $this->assertEquals(-1,$f(1.53,1.52));
        $this->assertEquals(1,$f(1.53,1.54));
        $this->assertEquals(0,$f(1.53,1.53));
    }
    public function testInitString()
    {
        $f =  Comparator::init(ComparatorFunction::string());

        $this->assertEquals(-1,$f("aaabdds","aaac"));
        $this->assertEquals(1,$f("aaab65z56","aaaaasdas"));
        $this->assertEquals(0,$f("aaab","aaab"));
    }
    public function testString()
    {
        $f =  Comparator::string();
        $this->assertEquals(-1,$f("aaabdds","aaac"));
        $this->assertEquals(1,$f("aaab65z56","aaaaasdas"));
        $this->assertEquals(0,$f("aaab","aaab"));
    }
    public function testStringInverted()
    {
        $f =  Comparator::string()->invert();


        $this->assertEquals(1,$f("aaabdds","aaac"));
        $this->assertEquals(-1,$f("aaab65z56","aaaaasdas"));
        $this->assertEquals(0,$f("aaab","aaab"));
    }

}