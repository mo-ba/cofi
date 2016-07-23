<?php namespace Cofi\Comparator\Abstracts;

use Cofi\Comparator\ComparatorFunction;
use Cofi\Comparator\Interfaces\ComparatorInterface;

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
						die('error1 -> asc|desc|callable|comparator');
					}
				} else if ($comparator instanceof ComparatorInterface) {
					$cmp = $comparator->compare($this->_get($a, $key), $this->_get($b, $key));
				} else {
					die('error3 comparator type not supported');
				}
			} else {
				die('error2 key must be string or integer');
			}
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
	 */
	public function _cmpAsc($a, $b, $field)
	{
		$issetA = $this->_isset($a, $field);
		$issetB = $this->_isset($b, $field);
		$valA = $this->_get($a, $field);
		$valB = $this->_get($b, $field);
		if ($issetA && is_numeric($valA) && $issetB && is_numeric($valB)) {
			$f = ComparatorFunction::number();
			$cmp = $f($valA, $valB);
			return $cmp;
		} else if ($issetA && is_string($valA) && $issetB && is_string($valB)) {
			$f = ComparatorFunction::string();
			$cmp = $f($a, $b);
			return $cmp;
		} else {
			die('error4');
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

