<?php
namespace Haluz;

require_once __DIR__ . '/ArrayDataEntry.php';
require_once __DIR__ . '/DataSource.php';

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