<?php
namespace Haluz;

use Iterator;

abstract class SingleEntryDataSource implements Iterator, DataSource {

	/** @var int $iter iteration is at the beginning */
	private $valid = true;

	/**
	 * Returns the sole data entry in this data source.
	 *
	 * @return \Haluz\DataEntry the data entry
	 */
	public abstract function entry(): DataEntry;

	public function next() {
		$this->valid = false;
	}

	public function valid() {
		return $this->valid;
	}

	public function current() {
		if ($this->valid) return $this->entry();
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