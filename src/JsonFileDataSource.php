<?php
namespace Haluz;

use Symfony\Component\Console\Logger\ConsoleLogger;

class JsonFileDataSource extends SingleEntryDataSource {

	private $dataEntry;
	private $logger;

	public function __construct(string $filename) {
		$contents = file_get_contents($filename);
		$data = json_decode($contents, true);
		$this->dataEntry = new ArrayDataEntry($data);
		$this->logger = Log::getLogger();
		$this->logger->debug("Parsed JSON data: $this->dataEntry");
	}

	public function entry(): DataEntry {
		return $this->dataEntry;
	}

	public function setLogger($logger): ConsoleLogger {
		$this->logger = $logger;
	}
}
?>