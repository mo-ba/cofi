<?php namespace CofiTest\Comparator;

use Cofi\Comparator;
use Cofi\Comparator\ArrayComparator;
use Cofi\Comparator\ComparatorFunction;
use Cofi\Comparator\Interfaces\ComparatorInterface;
use PHPUnit_Framework_TestCase;

/**
 * Class ArrayComparatorTest
 * @package CofiTest\Comparator
 */
class ArrayComparatorTest extends PHPUnit_Framework_TestCase
{
	public function testBuildComparator()
	{

		$cmp = ArrayComparator::init(['a']);
		$this->assertInstanceOf(ArrayComparator::class, $cmp);
		return $cmp;
	}

	/**
	 */
	public function testCompare()
	{
		$cmp = ArrayComparator::init(['a']);

		$this->assertEquals(1,
			$cmp->compare(
				['a' => 6, 'b' => 34],
				['a' => 1, 'b' => 6]
			)
		);

		$this->assertEquals(1,
			$cmp(
				['a' => 6, 'b' => 34],
				['a' => 1, 'b' => 6]
			)
		);
		$this->assertEquals(-1,
			$cmp(
				['a' => 6, 'b' => 34],
				['a' => 10, 'b' => 6]
			)
		);
		$this->assertEquals(-1,
			$cmp->compare(
				['a' => 6, 'b' => 34],
				['a' => 10, 'b' => 6]
			)
		);
		$cmp2 = $cmp->invert();
		$this->assertEquals(1,
			$cmp2(
				['a' => 6, 'b' => 34],
				['a' => 10, 'b' => 6]
			)
		);
	}

	public function testCompare2()
	{
		$cmp = ArrayComparator::init(['a' => Comparator::number(), 'b' => 'asc']);
		$this->assertEquals(1,
			$cmp(
				['a' => 6, 'b' => 34],
				['a' => 1, 'b' => 6]
			)
		);
		$this->assertEquals(-1,
			$cmp(
				['a' => 6, 'b' => 34],
				['a' => 10, 'b' => 6]
			)
		);
		$this->assertEquals(1,
			$cmp->invert()->compare(
				['a' => 6, 'b' => 34],
				['a' => 10, 'b' => 6]
			)
		);
	}

	/**
	 * @depends testBuildComparator
	 * @param ArrayComparator $cmp
	 */
	public function testSort(ArrayComparator $cmp)
	{
		$data = [
			['a' => 6, 'b' => 34],
			['a' => 1, 'b' => 6],
			['a' => 3, 'b' => 45],
			['a' => 5, 'b' => 54],
			['a' => 2, 'b' => 3],
			['a' => 4, 'b' => 435],
		];
		$expected = [
			['a' => 1, 'b' => 6],
			['a' => 2, 'b' => 3],
			['a' => 3, 'b' => 45],
			['a' => 4, 'b' => 435],
			['a' => 5, 'b' => 54],
			['a' => 6, 'b' => 34],
		];
		usort($data, $cmp);
		$this->assertEquals($expected, $data);


	}

	/**
	 *
	 */
	public function testSortMultiple()
	{
		$cmp = ArrayComparator::init(['a', 'b']);
		$data = [
			['a' => 2, 'b' => 34],
			['a' => 1, 'b' => 6],
			['a' => 3, 'b' => 45],
			['a' => 1, 'b' => 54],
			['a' => 2, 'b' => 3],
			['a' => 2, 'b' => 435],
		];
		$expected = [
			['a' => 1, 'b' => 6],
			['a' => 1, 'b' => 54],
			['a' => 2, 'b' => 3],
			['a' => 2, 'b' => 34],
			['a' => 2, 'b' => 435],
			['a' => 3, 'b' => 45],
		];
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple2()
	{
		$cmp = ArrayComparator::init(['a', 'b' => 'desc']);
		$data = [
			['a' => 2, 'b' => '34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => '3'],
			['a' => 2, 'b' => '435'],
		];
		$expected = [
			['a' => 1, 'b' => '54'],
			['a' => 1, 'b' => '6'],
			['a' => 2, 'b' => '435'],
			['a' => 2, 'b' => '34'],
			['a' => 2, 'b' => '3'],
			['a' => 3, 'b' => '45'],
		];
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple3()
	{
		$cmp = ArrayComparator::init(['a' => 'desc', 'b' => 'asc']);
		$data = [
			['a' => 2, 'b' => '34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => '3'],
			['a' => 2, 'b' => '435'],
		];
		$expected = [
			['a' => 3, 'b' => '45'],
			['a' => 2, 'b' => '3'],
			['a' => 2, 'b' => '34'],
			['a' => 2, 'b' => '435'],
			['a' => 1, 'b' => '6'],
			['a' => 1, 'b' => '54'],
		];
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple4()
	{
		$cmp = ArrayComparator::init(['a' => Comparator::number()->invert(), 'b' => 'strcmp']);
		$data = [
			['a' => 2, 'b' => 'a34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => 'x3'],
			['a' => 2, 'b' => 'd435'],
		];
		$expected = [
			['a' => 3, 'b' => '45'],
			['a' => 2, 'b' => 'a34'],
			['a' => 2, 'b' => 'd435'],
			['a' => 2, 'b' => 'x3'],
			['a' => 1, 'b' => '54'],
			['a' => 1, 'b' => '6'],
		];
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple5()
	{
		$cmp = ArrayComparator::init(
			[
				'a' => ComparatorFunction::number(),
				'b' => function ($a, $b) {
					return strcmp($a, $b);
				}
			]
		);
		$data = [
			['a' => 2, 'b' => 'a34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => 'x3'],
			['a' => 2, 'b' => 'd435'],
		];
		$expected = [
			['a' => 1, 'b' => '54'],
			['a' => 1, 'b' => '6'],
			['a' => 2, 'b' => 'a34'],
			['a' => 2, 'b' => 'd435'],
			['a' => 2, 'b' => 'x3'],
			['a' => 3, 'b' => '45'],
		];
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple6()
	{
		$data = [
			['a' => 1, 'b' => 7, 'c' => 3, 'd' => 3],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 6],
			['a' => 2, 'b' => 2, 'c' => 7, 'd' => 2],
			['a' => 2, 'b' => 8, 'c' => 3, 'd' => 7],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 2],
			['a' => 1, 'b' => 2, 'c' => 8, 'd' => 2],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 5],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 9],
		];
		$expected = [
			['a' => 1, 'b' => 2, 'c' => 8, 'd' => 2],
			['a' => 1, 'b' => 7, 'c' => 3, 'd' => 3],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 2],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 5],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 6],
			['a' => 2, 'b' => 2, 'c' => 2, 'd' => 9],
			['a' => 2, 'b' => 2, 'c' => 7, 'd' => 2],
			['a' => 2, 'b' => 8, 'c' => 3, 'd' => 7],
		];
		usort($data, ArrayComparator::init(['a', 'b', 'c', 'd']));
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple7()
	{
		$data = [
			['a' => 1, 'b' => 7, 'c' => 3, 3],
			['a' => 2, 'b' => 2, 'c' => 2, 6],
			['a' => 2, 'b' => 2, 'c' => 7, 2],
			['a' => 2, 'b' => 8, 'c' => 3, 7],
			['a' => 2, 'b' => 2, 'c' => 2, 2],
			['a' => 1, 'b' => 2, 'c' => 8, 2],
			['a' => 2, 'b' => 2, 'c' => 2, 5],
			['a' => 2, 'b' => 2, 'c' => 2, 9],
		];
		$expected = [
			['a' => 1, 'b' => 2, 'c' => 8, 2],
			['a' => 1, 'b' => 7, 'c' => 3, 3],
			['a' => 2, 'b' => 2, 'c' => 2, 2],
			['a' => 2, 'b' => 2, 'c' => 2, 5],
			['a' => 2, 'b' => 2, 'c' => 2, 6],
			['a' => 2, 'b' => 2, 'c' => 2, 9],
			['a' => 2, 'b' => 2, 'c' => 7, 2],
			['a' => 2, 'b' => 8, 'c' => 3, 7],
		];
		usort($data, ArrayComparator::init(['a', 'b', 'c' => new CComparator(), 0]));
		$this->assertEquals($expected, $data);

	}
	/**
	 * @expectedException \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode 3
	 */
	public function testSortMultiple8()
	{
		$data = [
			['a' => 1, 'b' => 7, 'c' => 3, 3],
			['a' => 2, 'b' => 2, 'c' => 2, 6],
			['a' => 2, 'b' => 2, 'c' => 7, 2],
			['a' => 2, 'b' => 8, 'c' => 3, 7],
			['a' => 2, 'b' => 2, 'c' => 2, 2],
			['a' => 1, 'b' => 2, 'c' => 8, 2],
			['a' => 2, 'b' => 2, 'c' => 2, 5],
			['a' => 2, 'b' => 2, 'c' => 2, 9],
		];
		$expected = [
			['a' => 1, 'b' => 2, 'c' => 8, 2],
			['a' => 1, 'b' => 7, 'c' => 3, 3],
			['a' => 2, 'b' => 2, 'c' => 2, 2],
			['a' => 2, 'b' => 2, 'c' => 2, 5],
			['a' => 2, 'b' => 2, 'c' => 2, 6],
			['a' => 2, 'b' => 2, 'c' => 2, 9],
			['a' => 2, 'b' => 2, 'c' => 7, 2],
			['a' => 2, 'b' => 8, 'c' => 3, 7],
		];


		usort($data, ArrayComparator::init(['a', 'b' => true , 'c' => new CComparator(), 0]));
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple9()
	{
		$data = [
			['a' => 1, 'b' => 'aaaah'],
			['a' => 2, 'b' => 'hjhg'],
			['a' => 1, 'b' => 'aaaaa'],
			['a' => 1, 'b' => 'aaaab'],
		];
		$expected = [
			['a' => 1, 'b' => 'aaaaa'],
			['a' => 1, 'b' => 'aaaab'],
			['a' => 1, 'b' => 'aaaah'],
			['a' => 2, 'b' => 'hjhg'],
		];


		usort($data, ArrayComparator::init(['a', 'b']));
		$this->assertEquals($expected, $data);
	}
	/**
	 * @expectedException \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode 5
	 */
	public function testSortMultiple10()
	{
		$data = [
			['a' => 1, 'b' => 'aaaah'],
			['a' => 2, 'b' => 'hjhg'],
			['a' => 1, 'b' => 'aaaaa'],
			['a' => 1, 'b' => 5],
		];
		$expected = [
			['a' => 1, 'b' => 'aaaaa'],
			['a' => 1, 'b' => 'aaaab'],
			['a' => 1, 'b' => 'aaaah'],
			['a' => 2, 'b' => 'hjhg'],
		];


		usort($data, ArrayComparator::init(['a', 'b']));
		$this->assertEquals($expected, $data);

	}
	/**
	 * @expectedException \Cofi\Exceptions\InvalidComparatorArgumentException
	 * @expectedExceptionCode 4
	 */
	public function testSortMultiple11()
	{
		$data = [
			['a' => 1, 'b' => 'aaaah'],
			['a' => 2, 'b' => 'hjhg'],
			['a' => 1, 'b' => 'aaaaa'],
			['a' => 1],
		];
		$expected = [
			['a' => 1, 'b' => 'aaaaa'],
			['a' => 1, 'b' => 'aaaab'],
			['a' => 1, 'b' => 'aaaah'],
			['a' => 2, 'b' => 'hjhg'],
		];


		usort($data, ArrayComparator::init(['a', 'b']));
		$this->assertEquals($expected, $data);

	}


}

class CComparator implements Comparator\Interfaces\ComparatorInterface
{

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return $a - $b;
	}

	/**
	 * @return ComparatorInterface
	 */
	public function invert()
	{
		return new Comparator\InvertedComparator($this);
	}
}