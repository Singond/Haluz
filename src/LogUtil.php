<?php
namespace Haluz;

use Psr\Log\LogLevel;
use Symfony\Component\Console\Output\OutputInterface;

class LogUtil {

	/*
	 * The Symfony verbosity levels are the following:
	 * const VERBOSITY_QUIET = 16;
	 * const VERBOSITY_NORMAL = 32;
	 * const VERBOSITY_VERBOSE = 64;
	 * const VERBOSITY_VERY_VERBOSE = 128;
	 * const VERBOSITY_DEBUG = 256;
	 */

	private static $verbosityLevelMap = array(
		LogLevel::EMERGENCY => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::ALERT     => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::CRITICAL  => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::ERROR     => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::WARNING   => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::NOTICE    => OutputInterface::VERBOSITY_NORMAL,
		LogLevel::INFO      => OutputInterface::VERBOSITY_VERBOSE,
		LogLevel::DEBUG     => OutputInterface::VERBOSITY_DEBUG
	);

	public static function verbosityMap() {
		return self::$verbosityLevelMap;
	}
}
?>