<?php namespace CofiTest\Comparator;

use Cofi\Comparator;
use Cofi\Comparator\ComparatorFunction;
use Cofi\Comparator\ObjectComparator;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @param array $data
 * @return stdClass
 */
function arrayToStdObject(array $data)
{
	$obj = new stdClass();
	foreach ($data as $key => $value) {

		$obj->$key = $value;
	}
	return $obj;
}

/**
 * @param array $data
 * @return stdClass[]
 */
function mapArrayToStdObject(array $data)
{
	return array_map('CofiTest\Comparator\arrayToStdObject', $data);
}

/**
 * Class ObjectComparatorTest
 * @package CofiTest\Comparator
 */
class ObjectComparatorTest extends PHPUnit_Framework_TestCase
{
	public function testBuildComparator()
	{

		$cmp = new ObjectComparator(['a']);
		$this->assertInstanceOf(ObjectComparator::class, $cmp);
		return $cmp;
	}

	/**
	 */
	public function testCompare()
	{
		$cmp = new ObjectComparator(['a']);

		$this->assertEquals(1,
			$cmp->compare(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 1, 'b' => 6])
			)
		);

		$this->assertEquals(1,
			$cmp(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 1, 'b' => 6])
			)
		);
		$this->assertEquals(-1,
			$cmp(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 10, 'b' => 6])
			)
		);
		$this->assertEquals(-1,
			$cmp->compare(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 10, 'b' => 6])
			)
		);
		$cmp2 = $cmp->invert();
		$this->assertEquals(1,
			$cmp2(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 10, 'b' => 6])
			)
		);
	}

	public function testCompare2()
	{
		$cmp = new ObjectComparator(['a' => Comparator::number(), 'b' => 'asc']);
		$this->assertEquals(1,
			$cmp(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 1, 'b' => 6])
			)
		);
		$this->assertEquals(-1,
			$cmp(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 10, 'b' => 6])
			)
		);
		$cmp2 = $cmp->invert();
		$this->assertEquals(1,
			$cmp2(
				arrayToStdObject(['a' => 6, 'b' => 34]),
				arrayToStdObject(['a' => 10, 'b' => 6])
			)
		);
	}

	/**
	 * @depends testBuildComparator
	 * @param ObjectComparator $cmp
	 */
	public function testSort(ObjectComparator $cmp)
	{
		$data = mapArrayToStdObject([
			['a' => 6, 'b' => 34],
			['a' => 1, 'b' => 6],
			['a' => 3, 'b' => 45],
			['a' => 5, 'b' => 54],
			['a' => 2, 'b' => 3],
			['a' => 4, 'b' => 435],
		]);
		$expected = mapArrayToStdObject([
			['a' => 1, 'b' => 6],
			['a' => 2, 'b' => 3],
			['a' => 3, 'b' => 45],
			['a' => 4, 'b' => 435],
			['a' => 5, 'b' => 54],
			['a' => 6, 'b' => 34],
		]);
		usort($data, $cmp);
		$this->assertEquals($expected, $data);


	}

	/**
	 *
	 */
	public function testSortMultiple()
	{
		$cmp = new ObjectComparator(['a', 'b']);
		$data = mapArrayToStdObject([
			['a' => 2, 'b' => 34],
			['a' => 1, 'b' => 6],
			['a' => 3, 'b' => 45],
			['a' => 1, 'b' => 54],
			['a' => 2, 'b' => 3],
			['a' => 2, 'b' => 435],
		]);
		$expected = mapArrayToStdObject([
			['a' => 1, 'b' => 6],
			['a' => 1, 'b' => 54],
			['a' => 2, 'b' => 3],
			['a' => 2, 'b' => 34],
			['a' => 2, 'b' => 435],
			['a' => 3, 'b' => 45],
		]);
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple2()
	{
		$cmp = new ObjectComparator(['a', 'b' => 'desc']);
		$data = mapArrayToStdObject([
			['a' => 2, 'b' => '34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => '3'],
			['a' => 2, 'b' => '435'],
		]);
		$expected = mapArrayToStdObject([
			['a' => 1, 'b' => '54'],
			['a' => 1, 'b' => '6'],
			['a' => 2, 'b' => '435'],
			['a' => 2, 'b' => '34'],
			['a' => 2, 'b' => '3'],
			['a' => 3, 'b' => '45'],
		]);
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple3()
	{
		$cmp = new ObjectComparator(['a' => 'desc', 'b' => 'asc']);
		$data = mapArrayToStdObject([
			['a' => 2, 'b' => '34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => '3'],
			['a' => 2, 'b' => '435'],
		]);
		$expected = mapArrayToStdObject([
			['a' => 3, 'b' => '45'],
			['a' => 2, 'b' => '3'],
			['a' => 2, 'b' => '34'],
			['a' => 2, 'b' => '435'],
			['a' => 1, 'b' => '6'],
			['a' => 1, 'b' => '54'],
		]);
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple4()
	{
		$cmp = new ObjectComparator(['a' => Comparator::number()->invert(), 'b' => 'strcmp']);
		$data = mapArrayToStdObject([
			['a' => 2, 'b' => 'a34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => 'x3'],
			['a' => 2, 'b' => 'd435'],
		]);
		$expected = mapArrayToStdObject([
			['a' => 3, 'b' => '45'],
			['a' => 2, 'b' => 'a34'],
			['a' => 2, 'b' => 'd435'],
			['a' => 2, 'b' => 'x3'],
			['a' => 1, 'b' => '54'],
			['a' => 1, 'b' => '6'],
		]);
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}

	/**
	 *
	 */
	public function testSortMultiple5()
	{
		$cmp = new ObjectComparator(['a' => ComparatorFunction::number(), 'b' => function ($a, $b) {
			return strcmp($a, $b);
		}]);
		$data = mapArrayToStdObject([
			['a' => 2, 'b' => 'a34'],
			['a' => 1, 'b' => '6'],
			['a' => 3, 'b' => '45'],
			['a' => 1, 'b' => '54'],
			['a' => 2, 'b' => 'x3'],
			['a' => 2, 'b' => 'd435'],
		]);
		$expected = mapArrayToStdObject([
			['a' => 1, 'b' => '54'],
			['a' => 1, 'b' => '6'],
			['a' => 2, 'b' => 'a34'],
			['a' => 2, 'b' => 'd435'],
			['a' => 2, 'b' => 'x3'],
			['a' => 3, 'b' => '45'],
		]);
		usort($data, $cmp);
		$this->assertEquals($expected, $data);

	}


}