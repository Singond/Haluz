<?php
namespace Haluz;

class ArrayDataEntry implements DataEntry {

	private $data;

	public function __construct(array $data = array()) {
		$this->data = $data;
	}

	public function asArray() {
		return $this->data;
	}

	public function __toString() {
		return json_encode($this->data, JSON_PRETTY_PRINT);
	}
}
?>