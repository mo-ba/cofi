<?php namespace CofiTest\Comparator;

use Cofi\Comparator;
use PHPUnit_Framework_TestCase;

/**
 * Class SortArrayWithComparatorTest
 * @package CofiTest\Comparator
 */
class SortArrayWithComparatorTest extends PHPUnit_Framework_TestCase
{

	public function testSort()
	{
		$data = [43, 25, 54, 26, 879, 23, 43, 1234, 5.653, 23435.3, 233.11, 1.1, 1.44, 1.09, 1.12];
		usort($data, Comparator::number());
		$expected = [1.09, 1.1, 1.12, 1.44, 5.653, 23, 25, 26, 43, 43, 54, 233.11, 879, 1234, 23435.3];
		$this->assertEquals($expected, $data);
	}

	public function testSortInvert()
	{
		$data = [43, 25, 54, 26, 879, 23, 43, 1234, 5.653, 23435.3, 233.11, 1.1, 1.44, 1.09, 1.12];
		usort($data, Comparator::number()->invert());
		$expected = [23435.3, 1234, 879, 233.11, 54, 43, 43, 26, 25, 23, 5.653, 1.44, 1.12, 1.1, 1.09];
		$this->assertEquals($expected, $data);
	}
}