<?php namespace CofiTest\Filter;


use Cofi\Comparator;
use Cofi\Filter;
use PHPUnit_Framework_TestCase;

class ComparatorFilterTest extends PHPUnit_Framework_TestCase
{


	public function testIsGreaterThen()
	{
		$filter = Filter::isGreaterThen(5);
		$this->assertTrue($filter(6));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(4));
	}

	public function testIsGreaterThen2()
	{
		$filter = Filter::isGreaterThen(5, Comparator::number());
		$this->assertTrue($filter(6));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(4));
	}

	public function testIsGreaterThen3()
	{
		$filter = Filter::isGreaterThen('5', Comparator::string());
		$this->assertTrue($filter('6'));
		$this->assertFalse($filter('5'));
		$this->assertFalse($filter('4'));
	}

	public function testIsGreaterThen4()
	{
		$filter = Filter::isGreaterThen('50', Comparator::string());
		$this->assertTrue($filter('6'));
		$this->assertFalse($filter('50'));
		$this->assertFalse($filter('4'));
	}

	public function testIsGreaterThenOrEquals()
	{
		$filter = Filter::isGreaterThenOrEquals(5);
		$this->assertTrue($filter(6));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(4));
	}

	public function testIsGreaterThenOrEquals2()
	{
		$filter = Filter::isGreaterThenOrEquals(5, Comparator::number());
		$this->assertTrue($filter(6));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(4));
	}

	public function testIsGreaterThenOrEquals3()
	{
		$filter = Filter::isGreaterThenOrEquals('5', Comparator::string());
		$this->assertTrue($filter('6'));
		$this->assertTrue($filter('5'));
		$this->assertFalse($filter('4'));
	}

	public function testIsGreaterThenOrEquals4()
	{
		$filter = Filter::isGreaterThenOrEquals('50', Comparator::string());
		$this->assertTrue($filter('6'));
		$this->assertTrue($filter('50'));
		$this->assertFalse($filter('4'));
	}

	public function testIsLessThenOrEquals()
	{
		$filter = Filter::isLessThenOrEquals('50', Comparator::number());
		$this->assertTrue($filter('6'));
		$this->assertTrue($filter('50'));
		$this->assertFalse($filter('54'));
	}

	public function testIsLessThenOrEquals2()
	{
		$filter = Filter::isLessThenOrEquals(50, Comparator::number());
		$this->assertTrue($filter(6));
		$this->assertTrue($filter(50));
		$this->assertFalse($filter(54));
	}

	public function testIsLessThen()
	{
		$filter = Filter::isLessThen('50', Comparator::number());
		$this->assertTrue($filter('6'));
		$this->assertFalse($filter('50'));
		$this->assertFalse($filter('54'));
	}

	public function testIsLessThen2()
	{
		$filter = Filter::isLessThen(50, Comparator::number());
		$this->assertTrue($filter(6));
		$this->assertFalse($filter(50));
		$this->assertFalse($filter(54));
	}
}