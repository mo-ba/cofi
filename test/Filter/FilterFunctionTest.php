<?php

namespace CofiTest\Filter;


use Cofi\Filter\FilterFunction;

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

	public function testIsBoolean()
	{
		$f = FilterFunction::isBoolean();
		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));

		$this->assertFalse($f('aaab'));
		$this->assertTrue($f(true));
		$this->assertTrue($f(false));
		$this->assertFalse($f([1]));
		$this->assertFalse($f("0"));

		$this->assertFalse($f([]));
		$this->assertFalse($f(""));
		$this->assertFalse($f(0));
		$this->assertFalse($f(null));


	}

	public function testIsBool()
	{
		$f = FilterFunction::isBoolean();
		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));

		$this->assertFalse($f('aaab'));
		$this->assertTrue($f(true));
		$this->assertTrue($f(false));
		$this->assertFalse($f([1]));
		$this->assertFalse($f("0"));

		$this->assertFalse($f([]));
		$this->assertFalse($f(""));
		$this->assertFalse($f(0));
		$this->assertFalse($f(null));

	}
	public function testIsGreater()
	{
		$f = FilterFunction::isGreaterThen(4);
		$this->assertTrue($f(5));
		$this->assertFalse($f(4));
		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));
		$this->assertFalse($f('aaab'));
		$this->assertFalse($f(true));
		$this->assertFalse($f(false));
		$this->assertFalse($f("0"));
		$this->assertFalse($f(""));
		$this->assertFalse($f(0));
		$this->assertFalse($f(null));

	}
	public function testIsGreaterThenOrEquals()
	{
		$f = FilterFunction::isGreaterThenOrEquals(4);

		$this->assertTrue($f(5));
		$this->assertTrue($f(4));
		$this->assertTrue($f("5"));

		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));
		$this->assertFalse($f('aaab')); //0
		$this->assertFalse($f(true));	//1
		$this->assertFalse($f(false));	//0
		$this->assertFalse($f("0"));
		$this->assertFalse($f(""));
		$this->assertFalse($f(0));
		$this->assertFalse($f(null));

	}
	public function testIsGreaterThenOrEqualsMinusOne()
	{
		$f = FilterFunction::isGreaterThenOrEquals(-1);

		$this->assertTrue($f(5));
		$this->assertTrue($f(4));
		$this->assertTrue($f(2));
		$this->assertTrue($f("2"));
		$this->assertTrue($f(2.8));
		$this->assertTrue($f(0x2));
		$this->assertTrue($f('aaab')); 	//0
		$this->assertTrue($f(true)); 	//1
		$this->assertTrue($f(false)); 	//0

		$this->assertFalse($f(-2));

	}
	public function testIsGreaterThenOrEqualsOne()
	{
		$f = FilterFunction::isGreaterThenOrEquals(1);

		$this->assertTrue($f(1));
		$this->assertTrue($f(5));
		$this->assertTrue($f(4));
		$this->assertTrue($f(2));
		$this->assertTrue($f("2"));
		$this->assertTrue($f(2.8));
		$this->assertTrue($f(0x2));
		$this->assertFalse($f('aaab')); 	//0
		$this->assertTrue($f(true)); 	//1
		$this->assertFalse($f(false)); 	//0

		$this->assertFalse($f(-2));

	}
	public function testIsGreaterThenOne()
	{
		$f = FilterFunction::isGreaterThen(1);

		$this->assertFalse($f(1));
		$this->assertTrue($f(5));
		$this->assertTrue($f(4));
		$this->assertTrue($f(2));
		$this->assertTrue($f("2"));
		$this->assertTrue($f(2.8));
		$this->assertTrue($f(0x2));
		$this->assertFalse($f('aaab')); 	//0
		$this->assertFalse($f(true)); 	//1
		$this->assertFalse($f(false)); 	//0

		$this->assertFalse($f(-2));

	}
}