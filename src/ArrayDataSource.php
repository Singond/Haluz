<?php
namespace Haluz;

use \ArrayIterator;

/**
 * A data source where each data entry is represented by an array.
 * The whole data source itself is an array of these entries.
 */
class ArrayDataSource implements DataSource {

	private $data = array();

	/**
	 * Creates a new instance with the given array of arrays as the data.
	 *
	 * @param array $data an array of arrays, where the elements in the
	 *        top-level array are individual data elements
	 */
	public function __construct(array $data = array(array())) {
		foreach ($data as $item) {
			$this->data[] = new ArrayDataEntry($item);
		}
	}

	public function data(): iterable {
		return new ArrayIterator($this->data);
	}

	public function close() {}

	public function open() {}

}
?>