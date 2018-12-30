<?php
namespace Haluz;

use Iterator;

class JsonFileDataSourceSingle implements Iterator, DataSource {

	/** @var array $data json parsed into associative array */
	private $data;

	private $dataEntry;

	/** @var int $iter iteration is at the beginning */
	private $valid = true;

	public function __construct(string $filename) {
		$contents = file_get_contents($filename);
		$this->data = json_decode($contents, true);
		$this->dataEntry = new ArrayDataEntry($this->data);
		var_dump($this->data);
	}

	public function next() {
		$this->valid = false;
	}

	public function valid() {
		return $this->valid;
	}

	public function current() {
		if ($this->valid) return $this->dataEntry;
		else return null;
	}

	public function rewind() {
		$this->valid = true;
	}

	public function key() {
		if ($this->valid) return 0;
		else return 1;
	}
}
?>