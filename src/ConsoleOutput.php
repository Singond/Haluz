<?php
namespace Haluz;

class ConsoleOutput implements Output {

	public function consume(string $rendered, array $data) {
		echo $rendered . PHP_EOL;
	}

}
?>