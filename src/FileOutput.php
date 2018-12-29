<?php
namespace Haluz;

use \Twig_Environment;
use \Twig_Loader_Array;

class FileOutput implements Output {

	private $filenameTemplate;

	/**
	 * Creates a new data consumer object which writes to a file with
	 * dynamic name resolved from a pattern.
	 *
	 * @param string $pattern a Twig-compatible pattern for the output
	 *        file name
	 */
	public function __construct(string $pattern) {
		$loader = new Twig_Loader_Array(array('filename'=>$pattern));
		$env = new Twig_Environment($loader);
		$this->filenameTemplate = $env->load('filename');
	}

	public function consume(string $rendered, array $data) {
		$filename = $this->filenameTemplate->render($data);
		file_put_contents($filename, $rendered);
	}
}
?>