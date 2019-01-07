<?php
namespace Haluz;

class JsonFileDataSource extends AbstractDataSource {

	// TODO: Not implementing open() and close() is lying about the nature
	// of this class. FileDataSource is appropriate here.

	private $dataEntry;

	public function __construct(string $filename) {
		parent::__construct();
		$contents = file_get_contents($filename);
		$data = json_decode($contents, true);
		$this->dataEntry = new ArrayDataEntry($data);
		$this->logger->debug("Parsed JSON data: $this->dataEntry");
	}

	public function data(): iterable {
		yield $this->dataEntry;
	}

}
?>