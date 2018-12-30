<?php
namespace Haluz;

require_once __DIR__ . '/../vendor/autoload.php';

use \Console_Getopt;
use \Twig_Loader_Filesystem;

global $argv;

$shortopts = "";
$longopts = array("json=");
$parsed = (new Console_Getopt())->getopt($argv, $shortopts, $longopts);
// $opts = $parsed[0];
$opts = array();
foreach ($parsed[0] as $item) {
	$opts[$item[0]] = $item[1];
}
$args = $parsed[1];
var_dump($opts);
var_dump($args);

$cwd = getcwd();
$output = array_pop($args);
$templates = $args[0];
$templateDir = dirname($templates);
$templateName = basename($templates);

echo "Current working directory: $cwd" . PHP_EOL;
echo "Template argument: $templates" . PHP_EOL;
echo "Templates directory: $templateDir" . PHP_EOL;
echo "Template filename: $templateName" . PHP_EOL;
echo PHP_EOL;

$loader = new Twig_Loader_Filesystem($templateDir);
$processor = new Processor();
$processor->setLoader($loader);
$processor->setTemplateName($templateName);

// $arr = array();
// $arr[] = array('name' => 'Aaa', 'number' => 34);
// $arr[] = array('name' => 'Bbb', 'number' => 8);
// $arr[] = array('name' => 'Ccc', 'number' => array(65, 74, 8));
// $source = new ArrayDataSource($arr);
// $processor->setDataSource($source);

if (\array_key_exists("--json", $opts)) {
	$processor->setDataSource(new JsonFileDataSourceSingle($opts["--json"]));
// 	new JsonFileDataSourceSingle($opts["--json"]);
}

if (!empty($output)) {
	$processor->setOutput(new FileOutput($output));
} else {
	throw new \Exception("No output specified");
}
$processor->run();
?>
