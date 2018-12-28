<?php
namespace Haluz;

class ArrayDataSource implements DataSource {

	private $data = array();
	
	public function __construct() {
		$this->data[] = new ArrayDataEntry(array('name' => "Aaa", 'number' => 34));
		$this->data[] = new ArrayDataEntry(array('name' => "Bbb", 'number' => 8));
	}

	public function getIterator():\Traversable {
		return new \ArrayIterator($this->data);
	}
}
?>