<?php
namespace Haluz;

use \IteratorAggregate;
use \Traversable;

/**
 * Iterates over \Haluz\DataEntry objects.
 *
 * @author Singon
 */
interface DataSource extends IteratorAggregate {

	/**
	 * Returns an iterator over the individual DataEntries.
	 *
	 * @see IteratorAggregate::getIterator()
	 */
	public function getIterator(): Traversable;
}
?>