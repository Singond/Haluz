<?php
namespace Haluz;

class Application extends \Symfony\Component\Console\Application {

	public const NAME = 'Haluz';
	public const CMD = 'haluz';
	public const DESC = "Haluz -- a template processor based on Twig";
	public const VERSION_UNKNOWN = '? (version unknown)';

	public function __construct(string $version = null) {
		if (is_null($version)) {
			$version = $this->getAppVersion();
		}
		parent::__construct(self::NAME, $version);
		$theCommand = new MainCommand();
		$this->add($theCommand);
		$this->setDefaultCommand($theCommand->getName(), true);
	}

	private function getAppVersion(): string {
		$filename = dirname(__DIR__).'/composer.json';
		if (file_exists($filename)) {
			$cj = file_get_contents($filename);
			$cj = json_decode($cj, true);
			$version = $cj['version'];
			return !empty($version) ? $version : self::VERSION_UNKNOWN;
		}
		return SELF::VERSION_UNKNOWN;
	}

	public function getHelp() {
		return self::DESC;
	}
}
?>