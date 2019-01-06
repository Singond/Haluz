<?php
namespace Haluz;

class CsvFileDataSource extends SingleEntryDataSource {

	private $dataEntry;
	private $logger;

	public function __construct(string $filename) {
		$this->logger = Log::getLogger();
		$csv = $this->parse($filename, ",");
		$header = $csv[0];
		$values = $csv[1];
		$data = array();
		for ($i = 0; $i < count($header); $i++) {
			$data[$header[$i]] = $values[$i];
		}
		$this->dataEntry = new ArrayDataEntry($data);
		$this->logger->debug("Parsed CSV data: $this->dataEntry");
	}

	public function entry(): DataEntry {
		return $this->dataEntry;
	}

	private function parse(string $file, string $separator): array {
		$rows = array();
		if (($handle = fopen($file, "r")) !== false) {
			while (($rowdata = fgetcsv($handle, 0, $separator)) !== false) {
				$rows[] = $rowdata;
			}
		}
		fclose($handle);
		return $rows;
	}

}
?>