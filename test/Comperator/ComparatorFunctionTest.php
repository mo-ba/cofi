<?php namespace CofiTest\Comparator;

use Cofi\Comparator\ComparatorFunction;
use PHPUnit_Framework_TestCase;

/**
 * Class ComparatorFunctionTest
 * @package CofiTest\Comparator
 */
class ComparatorFunctionTest extends PHPUnit_Framework_TestCase
{

	public function testNumeric()
	{
		$f = ComparatorFunction::number();

		$this->assertEquals(-1, $f(1, 2));
		$this->assertEquals(-1, $f(1, 32));
		$this->assertEquals(1, $f(10, 2));
		$this->assertEquals(0, $f(2, 2));
		$this->assertEquals(0, $f(-2, -2));
		$this->assertEquals(1, $f(1.53, 1.52));
		$this->assertEquals(-1, $f(1.53, 1.54));
		$this->assertEquals(0, $f(1.53, 1.53));
	}

	public function testString()
	{
		$f = ComparatorFunction::string();

		$this->assertEquals(-1, $f("aaabdds", "aaac"));
		$this->assertEquals(1, $f("aaab65z56", "aaaaasdas"));
		$this->assertEquals(0, $f("aaab", "aaab"));
	}

	//todo number delta tests -> delta should be 0 if used to order

}