<?php
namespace Haluz;

class Application extends \Symfony\Component\Console\Application {

	public const NAME = 'Haluz';
	public const CMD = 'haluz';
	public const DESC = "Haluz -- a template processor based on Twig";

	public function __construct() {
		parent::__construct(self::NAME, "0.1.0-alpha");
		$theCommand = new MainCommand();
		$this->add($theCommand);
		$this->setDefaultCommand($theCommand->getName(), true);
	}

	public function getHelp() {
		return self::DESC;
	}
}
?>