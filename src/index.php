<?php
namespace Haluz;

echo "Running on PHP version: " . PHP_VERSION . PHP_EOL;

$path = dirname(\Phar::running(false));
if (strlen($path) > 0) {
	// Running from PHAR
	require_once \Phar::running() . DIRECTORY_SEPARATOR . 'vendor'
		. DIRECTORY_SEPARATOR . 'autoload.php';
} else {
	// Running from source
	require_once __DIR__ . '/../vendor/autoload.php';
}

use \Console_Getopt;
use \Twig_Loader_Filesystem;

global $argv;

$shortopts = "";
$longopts = array("json=");
$parsed = (new Console_Getopt())->getopt($argv, $shortopts, $longopts);
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

if (\array_key_exists("--json", $opts)) {
	$processor->setDataSource(new JsonFileDataSourceSingle($opts["--json"]));
}

if (!empty($output)) {
	$processor->setOutput(new FileOutput($output));
} else {
	throw new \Exception("No output specified");
}
$processor->run();
?>
