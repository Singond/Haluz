<?php
namespace Haluz;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Logger\ConsoleLogger;

class Context {

	/** @var Command */
	private $command;
	/** @var ConsoleLogger */
	private $logger;

	public function __construct(Command $command, ConsoleLogger $logger) {
		$this->command = $command;
		$this->logger = $logger;
	}

	/**
	 * Returns the currently executing command
	 *
	 * @return \Symfony\Component\Console\Command\Command
	 */
	public function getCommand(): Command {
		return $this->command;
	}

	/**
	 * Returns the logger instance from the currently executing command.
	 *
	 * @return \Symfony\Component\Console\Logger\ConsoleLogger
	 */
	public function getLogger() {
		return $this->logger;
	}
}

