<?php
namespace Haluz;

use \Twig_Environment;
use \Twig_Lexer;

class Processor {

	private $logger;

	private $loader;
	private $templateName;
	private $source;
	private $output;

	private $delimComment;
	private $delimBlock;
	private $delimVariable;
	private $delimInterpolation;

	public function __construct() {
		$this->logger = Log::getLogger();
	}

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

	public function setVariableDelimiters(string $start, string $end) {
		$this->logger->debug("Variable delimiters are: ${start}, ${end}");
		$this->delimVariable = [$start, $end];
	}

	public function setBlockDelimiters(string $start, string $end) {
		$this->logger->debug("Block delimiters are: ${start}, ${end}");
		$this->delimBlock = [$start, $end];
	}

	public function setCommentDelimiters(string $start, string $end) {
		$this->logger->debug("Comment delimiters are: ${start}, ${end}");
		$this->delimComment = [$start, $end];
	}

	public function setInterpolationDelimiters(string $start, string $end) {
		$this->logger->debug("Interpolation delimiters are: ${start}, ${end}");
		$this->delimInterpolation = [$start, $end];
	}

	public function run() {
		$twig = new Twig_Environment($this->loader);

		// Syntax
		$delimiters = array();
		if ($this->delimComment) {
			$delimiters['tag_comment'] = $this->delimComment;
		}
		if ($this->delimBlock) {
			$delimiters['tag_block'] = $this->delimBlock;
		}
		if ($this->delimVariable) {
			$delimiters['tag_variable'] = $this->delimVariable;
		}
		if ($this->delimInterpolation) {
			$delimiters['interpolation'] = $this->delimInterpolation;
		}
		if (!empty($delimiters)) {
			$lexer = new Twig_Lexer($twig, $delimiters);
			$twig->setLexer($lexer);
		}

		// Run
		$template = $twig->load($this->templateName);
		$this->source->open();
		$i = 1;
		foreach ($this->source->data() as $data) {
			$dataArray = $data->asArray();
			$dataArray['_i'] = $i++;
			$this->output->consume($template->render($dataArray), $dataArray);
		}
		$this->source->close();
	}
}
?>