<?php
namespace Haluz;

use \Traversable;

/**
 * Iterates over \Haluz\DataEntry objects.
 *
 * @author Singon
 */
interface DataSource extends Traversable {

	public function open();

	public function close();
}
?>