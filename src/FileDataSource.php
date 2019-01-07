<?php
namespace Haluz;

/**
 * A data source which reads the data from a file.
 *
 * @author Singon
 */
trait FileDataSource {
	private $filename;
	private $handle;

	public function open() {
		$this->logger->debug("Opening $this->filename");
		$this->handle = fopen($this->filename, "r");
	}

	public function close() {
		fclose($this->handle);
	}
}

