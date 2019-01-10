<?php
namespace Haluz;

use \SimpleXMLElement;

/**
 * Reads data from an XML file.
 * Parses the XML so that the value of each node is mapped to its element type.
 * For nodes without children, the value is the node's plain text content.
 * For nodes with children, the value is an associative array mapping
 * the name of each child element to its value.
 * Multiple children of the same name under a single parent node are wrapped
 * into an array.
 * If there are both children and text, the text is available in the
 * returned array under a special key '_text'.
 *
 * @author Singon
 */
class XmlFileDataSource extends AbstractDataSource {

	// TODO: Not implementing open() and close() is lying about the nature
	// of this class. FileDataSource is appropriate here.

	private $dataEntry;

	public function __construct(string $filename) {
		parent::__construct();
		$xml = simplexml_load_file($filename, SimpleXMLElement::class,
			LIBXML_NOBLANKS);
		$data = $this->value($xml);
		$this->dataEntry = new ArrayDataEntry($data);
		$this->logger->debug("Parsed XML data: $this->dataEntry");
	}

	public function data(): iterable {
		yield $this->dataEntry;
	}

	/**
	 * Gets the value of an XML node.
	 * For a node without children, the value is the node's plain text content.
	 * For a node with children, the value is an associative array mapping
	 * the name of each child element to its value as defined by this function.
	 * Multiple children of the same name are grouped into a sub-array.
	 * If there are both children and text, the text is available in the
	 * returned array under a special key '_text'.
	 *
	 * @param SimpleXMLElement $node the node
	 * @return mixed an array of the node's children or the string value of
	 *         a plain text node
	 */
	private function value(SimpleXMLElement $node) {
		$childCount = $node->count();
		if ($childCount == 0) {
			// An empty node or a text node: return the contents
			return $node->__toString();
		} else {
			// A node with children: return value for each child
			$children = array();
			$nameCounter = array();    // Counts processed children by name
			foreach ($node->children() as $child) {
				$name = $child->getName();
				if (!array_key_exists($name, $nameCounter)) {
					// No child of that name yet: put the raw value
					$children[$name] = $this->value($child);
					$nameCounter[$name] = 1;
				} else if ($nameCounter[$name] == 1) {
					// One child of that name. It is the raw value:
					// wrap it in an array and add this as its second element
					$children[$name] = array($children[$name]);
					$children[$name][] = $this->value($child);
					$nameCounter[$name] += 1;
				} else {
					$children[$name][] = $this->value($child);
					$nameCounter[$name] += 1;   // Not necessary
				}
			}
			// If there is any plain text, add id under a special key
			if ($text = $node->__toString()) {
				$children['_text'] = $text;
			}
			return $children;
		}
	}
}
?>