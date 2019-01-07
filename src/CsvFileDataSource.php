<?php
namespace Haluz;

class CsvFileDataSource extends SingleEntryDataSource {
	use FileDataSource;

	private $dataEntry;

	public function __construct(string $filename) {
		parent::__construct();
		$this->filename = $filename;
	}

	public function entry(): DataEntry {
		if ($this->dataEntry) {
			return $this->dataEntry;
		} else {
			$csv = $this->parse($this->filename, ",");
			$header = $csv[0];
			$values = $csv[1];
			$data = array();
			for ($i = 0; $i < count($header); $i++) {
				$data[$header[$i]] = $values[$i];
			}
			$this->dataEntry = new ArrayDataEntry($data);
			$this->logger->debug("Parsed CSV data: $this->dataEntry");
			return $this->dataEntry;
		}
	}

	private function parse(string $file, string $separator): array {
		$rows = array();
		if ($this->handle !== false) {
			while (($rowdata = fgetcsv($this->handle, 0, $separator)) !== false) {
				$rows[] = $rowdata;
			}
		}
		return $rows;
	}

}
?>