<?php
namespace Haluz;
interface Output {

	public function consume(string $rendered, array $data);
}
?>