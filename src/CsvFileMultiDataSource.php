<?php
namespace Haluz;

class CsvFileMultiDataSource extends AbstractDataSource {
	use FileDataSource, CsvOptions;

	public function __construct(string $filename) {
		parent::__construct();
		$this->filename = $filename;
	}

	private function nextLine() {
		if ($this->handle !== false) {
			return fgetcsv($this->handle, 0, $this->separator);
		} else {
			throw new \Exception("File not open");
		}
	}

	public function data(): iterable {
		$header = $this->nextLine();
		while (($values = $this->nextLine()) !== false) {
			$data = array();
			for ($i = 0; $i < count($header); $i++) {
				$data[$header[$i]] = $values[$i];
			}
			yield new ArrayDataEntry($data);
		}
	}

}
?>