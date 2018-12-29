<?php
namespace Haluz;

use \Twig_Environment;

class Processor {

	private $loader;
	private $templateName;
	private $source;
	private $output;

	/**
	 * @param \Twig_LoaderInterface $loader
	 */
	public function setLoader($loader) {
		$this->loader = $loader;
	}

	/**
	 * @param string $templateName
	 */
	public function setTemplateName($templateName) {
		$this->templateName = $templateName;
	}

	/**
	 * @param \Haluz\DataSource $source
	 */
	public function setDataSource(DataSource $source) {
		$this->source = $source;
	}

	/**
	 * @param \Haluz\Output $output the output consumer
	 */
	public function setOutput(Output $output) {
		$this->output = $output;
	}

	public function run() {
		$twig = new Twig_Environment($this->loader);
		$template = $twig->load($this->templateName);
		foreach ($this->source as $data) {
			$dataArray = $data->asArray();
			$this->output->consume($template->render($dataArray), $dataArray);
		}
	}
}
?>