<?php
namespace Haluz;

require_once __DIR__ . '/DataEntry.php';

class ArrayDataEntry implements DataEntry {
	
	private $data;
	
	public function __construct(array $data = array()) {
		$this->data = $data;
	}
	
	public function asArray() {
		return $this->data;
	}
}
?>