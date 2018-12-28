<?php
namespace Haluz;

/**
 * A single set of data to be used when rendering a template in one instance
 * of rendering the templates.
 *
 * @author Singon
 */
interface DataEntry {
	
	/**
	 * Returns the data for the template as an associative array where each
	 * variable name is mapped to its value.
	 */
	public function asArray();
}
?>