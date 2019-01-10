<?php
namespace Haluz;

/**
 * Options for parsing CSV files.
 *
 * @author Singon
 */
trait CsvOptions {

	private $separator = ",";

	/**
	 * Sets the separator to be used for parsing the CSV data.
	 *
	 * @param string $separator
	 */
	public function setSeparator($separator) {
		$this->separator = $separator;
	}
}

