<?php
class CsvParser {
	private $handle;
	private $separator;

	public function open(string $file) {
		$this->handle = fopen($file);
	}

	/**
	 * @return array the output of 'fgetcsv()'
	 */
	public function nextLine() {
		return fgetcsv($this->handle, 0, $this->separator);
	}

	public function close() {
		fclose($this->handle);
	}
}
?>