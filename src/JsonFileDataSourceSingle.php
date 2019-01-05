<?php
namespace Haluz;

class JsonFileDataSourceSingle extends SingleEntryDataSource {

	private $dataEntry;

	public function __construct(string $filename) {
		$contents = file_get_contents($filename);
		$data = json_decode($contents, true);
		$this->dataEntry = new ArrayDataEntry($data);
		var_dump($data);
	}

	public function entry(): DataEntry {
		return $this->dataEntry;
	}

}
?>