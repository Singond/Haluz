<?php
namespace Haluz;

use Psr\Log\LogLevel;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

class Log {

	private static $loggers = array();
	private const DEFAULT_NAME = 'DEFAULT_HALUZ_LOGGER';

	/*
	 * The Symfony verbosity levels are the following:
	 * const VERBOSITY_QUIET = 16;
	 * const VERBOSITY_NORMAL = 32;
	 * const VERBOSITY_VERBOSE = 64;
	 * const VERBOSITY_VERY_VERBOSE = 128;
	 * const VERBOSITY_DEBUG = 256;
	 */

	private static $verbosityMap = array(
		LogLevel::EMERGENCY => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::ALERT     => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::CRITICAL  => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::ERROR     => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::WARNING   => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::NOTICE    => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::INFO      => OutputInterface::VERBOSITY_VERBOSE,
		LogLevel::DEBUG     => OutputInterface::VERBOSITY_DEBUG
	);

	public static function getLogger(string $name = self::DEFAULT_NAME) {
		return self::$loggers[$name];
	}

	public static function newLogger(
		OutputInterface $output, string $name = self::DEFAULT_NAME) {
		self::$loggers[$name] = new ConsoleLogger($output, self::$verbosityMap);
	}

	public static function verbosityMap() {
		return self::$verbosityMap;
	}
}
?>