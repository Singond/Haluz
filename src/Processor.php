<?php
namespace Haluz;

use \Twig_Environment;

class Processor {
	
	private $loader;
	private $templateName;
	private $source;

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

	public function run() {
		$twig = new Twig_Environment($this->loader);
		$template = $twig->load($this->templateName);
		foreach ($this->source as $data) {
			echo $template->render($data->asArray()) . PHP_EOL;
		}
	}
}
?>