<?php
namespace Haluz;

/**
 * A data source which does not need to call open() or close().
 *
 * @author Singon
 */
abstract class AbstractDataSource implements DataSource {

	protected $logger;

	protected function __construct() {
		$this->logger = Log::getLogger();
	}

	/**
	 * This default implementation does nothing.
	 *
	 * @see \Haluz\DataSource::open()
	 */
	public function open() {}

	/**
	 * This default implementation does nothing.
	 *
	 * @see \Haluz\DataSource::close()
	 */
	public function close() {}
}

