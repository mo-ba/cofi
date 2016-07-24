<?php namespace Cofi\Comparator\Abstracts;

use Cofi\Comparator\ComparatorFunction;
use Cofi\Comparator\Interfaces\ComparatorInterface;
use Cofi\Exceptions\InvalidComparatorArgumentException;

/**
 * Class AbstractContainerComparator
 * @package Cofi\Comparator\Abstracts
 */
abstract class AbstractContainerComparator extends AbstractComparator
{

	private $comparators = [];

	/**
	 * ArrayComparator constructor.
	 * @param array $comparators
	 */
	public function __construct(array $comparators)
	{
		$this->comparators = $comparators;
	}

	/**
	 * @param array $comparators
	 * @return AbstractContainerComparator
	 */
	public static function init(array $comparators)
	{
		return new static($comparators);
	}

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 * @throws InvalidComparatorArgumentException
	 */
	public function compare($a, $b)
	{
		$cmp = 0;
		foreach ($this->comparators as $key => $comparator) {
			if (is_int($key)) {
				$cmp = $this->_cmpAsc($a, $b, $comparator);
			} else if (is_string($key)) {
				if (is_callable($comparator)) {
					$cmp = $comparator($this->_get($a, $key), $this->_get($b, $key));
				} else if (is_string($comparator)) {
					if (strtolower($comparator) == 'desc') {
						$cmp = $this->_cmpDesc($a, $b, $key);
					} else if (strtolower($comparator) == 'asc') {
						$cmp = $this->_cmpAsc($a, $b, $key);
					} else {
						throw new InvalidComparatorArgumentException('asc|desc|callable|comparator', 1);
					}
				} else if ($comparator instanceof ComparatorInterface) {
					$cmp = $comparator->compare($this->_get($a, $key), $this->_get($b, $key));
				} else {
					throw new InvalidComparatorArgumentException('comparator type not supported', 3);
				}
			} /*else {
				throw new InvalidComparatorArgumentException('key must be string or integer', 2);
			}*/
			if ($cmp != 0) {
				break;
			}
		}
		return $cmp;
	}

	/**
	 * @param $a
	 * @param $b
	 * @param $field
	 * @return int
	 * @throws InvalidComparatorArgumentException
	 */
	public function _cmpAsc($a, $b, $field)
	{
		$issetA = $this->_isset($a, $field);
		$issetB = $this->_isset($b, $field);
		if ($issetA && $issetB) {
			$valA = $this->_get($a, $field);
			$valB = $this->_get($b, $field);
			if (is_numeric($valA) && is_numeric($valB)) {
				$f = ComparatorFunction::number();
				$cmp = $f($valA, $valB);
				return $cmp;
			} else if (is_string($valA) && is_string($valB)) {
				$f = ComparatorFunction::string();
				$cmp = $f($valA, $valB);
				return $cmp;
			} else {
				throw new InvalidComparatorArgumentException('comparator type not supported', 5);
			}
		} else {
			throw new InvalidComparatorArgumentException('field not set', 4);
		}
	}

	/**
	 * @param $a
	 * @param $b
	 * @param $key
	 * @return int
	 */
	private function _cmpDesc($a, $b, $key)
	{
		return -$this->_cmpAsc($a, $b, $key);
	}

	/**
	 * @param $container
	 * @param $field
	 * @return boolean
	 */
	abstract protected function _isset(&$container, $field);

	/**
	 * @param $container
	 * @param $field
	 * @return mixed
	 */
	abstract protected function _get(&$container, $field);
}

