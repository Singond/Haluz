<?php
namespace Haluz;

use Traversable;

class JsonFileDataSourceSingle implements DataSource {

	/** @var array $data json parsed into associative array */
	private $data;

	public function __construct(string $filename) {
		$contents = file_get_contents($filename);
		$this->data = json_decode($contents, true);
		var_dump($this->data);
	}

	public function getIterator(): Traversable {
		return new ArrayDataEntry(array($this->data));
	}
}
?>