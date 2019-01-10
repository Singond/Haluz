<?php
namespace Haluz;

class CsvFileDataSource extends AbstractDataSource {
	use FileDataSource, CsvOptions;

	public function __construct(string $filename) {
		parent::__construct();
		$this->filename = $filename;
	}

	public function data(): iterable {
		if (($header = $this->nextLine())) {
			$this->logger->debug("Parsed header row");
		} else {
			throw new \Exception("The CSV file must contain at least two rows");
		}
		if (($values = $this->nextLine())) {
			$this->logger->debug("Parsed first data row");
			$data = $this->compose($header, $values);
		} else {
			throw new \Exception("The CSV file must contain at least two rows");
		}
		if (($values = $this->nextLine())) {
			// Nest the array to allow for more lines
			$this->logger->debug("Parsed second data row, wrapping array in another");
			$data = array($data);
			$data[] = $this->compose($header, $values);
			while (($values = $this->nextLine())) {
				$this->logger->debug("Parsed another data row");
				$data[] = $this->compose($header, $values);
			}
			$this->logger->debug("Reached end");
		}
		$this->logger->debug("Parsed data: " . json_encode($data, JSON_PRETTY_PRINT));
		yield new ArrayDataEntry($data);
	}

	private function nextLine() {
		if ($this->handle !== false) {
			$this->logger->debug("Reading line");
			return fgetcsv($this->handle, 0, $this->separator);
		} else {
			throw new \Exception("File not open");
		}
	}

	/**
	 * Creates an associative array mapping each cell in header to the
	 * corresponding cell in the value row.
	 *
	 * @param array $header the header row
	 * @param array $values the value row
	 * @return array the composed associative array
	 */
	private function compose(array $header, array $values): array {
		$data = array();
		for ($i = 0; $i < count($header); $i++) {
			$data[$header[$i]] = $values[$i];
		}
		return $data;
	}

}
?>