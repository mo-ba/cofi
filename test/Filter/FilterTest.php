<?php

namespace CofiTest\Filter;


use Cofi\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase
{

	public function testIsNum()
	{
		$f = Filter::isNumeric();
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
		$f = Filter::isInt();
		$this->assertTrue($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertTrue($f(0x2));

		$this->assertFalse($f('aaab'));
		$this->assertFalse($f(true));
		$this->assertFalse($f(null));
		$this->assertFalse($f([1]));


	}
	public function testIsInteger()
	{
		$f = Filter::isInteger();
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
		$f = Filter::isArray();
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
		$f = Filter::isEmpty();
		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));

		$this->assertFalse($f('aaab'));
		$this->assertFalse($f(true));
		$this->assertFalse($f([1]));
		$this->assertFalse($f([0]));
		$this->assertFalse($f("0"));

		$this->assertTrue($f([]));
		$this->assertTrue($f(""));
		$this->assertTrue($f(0));
		$this->assertTrue($f(null));


	}

	public function testIsString()
	{
		$f = Filter::isString();
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

	public function testIsStringNotNot()
	{
		$f = Filter::isString()->not()->not();
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

	public function testIsStringNot()
	{
		$f = Filter::isString()->not();
		$this->assertNotFalse($f(2));
		$this->assertNotTrue($f("2"));
		$this->assertNotFalse($f(2.8));
		$this->assertNotFalse($f(0x2));

		$this->assertNotTrue($f('aaab'));
		$this->assertNotFalse($f(true));
		$this->assertNotFalse($f([1]));
		$this->assertNotTrue($f("0"));

		$this->assertNotFalse($f([]));
		$this->assertNotTrue($f(""));
		$this->assertNotFalse($f(0));
		$this->assertNotFalse($f(null));


	}


	public function testIsSame()
	{
		$f = Filter::isSame("aaa");
		$this->assertTrue($f("aaa"));
		$this->assertFalse($f(2));
	}

	public function testIsSame2()
	{
		$f = Filter::isSame(['a' => 'b']);
		$this->assertTrue($f(['a' => 'b']));
		$this->assertFalse($f(['a' => 'c']));
	}

	public function testIsSame3()
	{
		$f = Filter::isSame(new \stdClass());
		$this->assertFalse($f (new \stdClass()));

	}

	public function testIsSame4()
	{
		$s = new \stdClass();
		$f = Filter::isSame($s);
		$this->assertTrue($f ($s));
	}

	public function testIsEqual()

	{
		$f = Filter::isEqual("aaa");
		$this->assertTrue($f("aaa"));
		$this->assertFalse($f(2));
	}

	public function testIsEqual2()
	{
		$f = Filter::isEqual(['a' => 'b']);
		$this->assertTrue($f(['a' => 'b']));
		$this->assertFalse($f(['a' => 'c']));
	}
	public function testIsEqual3()
	{
		$f = Filter::isEqual(new \stdClass());
		$this->assertTrue($f (new \stdClass()));

	}

	public function testIsEqual4()
	{
		$s = new \stdClass();
		$f = Filter::isEqual($s);
		$this->assertTrue($f ($s));
	}
	public function testIsNotEqual()
	{
		$f = Filter::isNotEqual(['a' => 'b']);
		$this->assertFalse($f(['a' => 'b']));
		$this->assertTrue($f(['a' => 'c']));
	}

	public function testIsBool()
	{
		$f = Filter::isBool();
		$this->assertTrue($f (false));
		$this->assertTrue($f (true));
		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));

		$this->assertFalse($f('aaab'));
		$this->assertFalse($f([1]));
		$this->assertFalse($f("0"));

		$this->assertFalse($f([]));
		$this->assertFalse($f(""));
		$this->assertFalse($f(0));
		$this->assertFalse($f(null));
	}
	public function testIsBoolean()
	{
		$f = Filter::isBoolean();
		$this->assertTrue($f (false));
		$this->assertTrue($f (true));
		$this->assertFalse($f(2));
		$this->assertFalse($f("2"));
		$this->assertFalse($f(2.8));
		$this->assertFalse($f(0x2));

		$this->assertFalse($f('aaab'));
		$this->assertFalse($f([1]));
		$this->assertFalse($f("0"));

		$this->assertFalse($f([]));
		$this->assertFalse($f(""));
		$this->assertFalse($f(0));
		$this->assertFalse($f(null));
	}
}