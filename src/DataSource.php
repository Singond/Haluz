<?php
namespace Haluz;

/**
 * Iterates over \Haluz\DataEntry objects.
 *
 * @author Singon
 */
interface DataSource {

	public function open();

	/**
	 * Returns an iterator over the data entries.
	 *
	 * @return iterable iterates over \Haluz\DataEntry objects
	 */
	public function data(): iterable;

	public function close();
}
?>