<?php
namespace Haluz;

require_once __DIR__ . '/../vendor/autoload.php';

use \Console_Getopt;
use \Twig_Loader_Filesystem;

global $argv;

$g = new Console_Getopt();
$o = $g->getopt($argv, "");
$opts = $o[0];
$args = $o[1];
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

$arr = array();
$arr[] = array('name' => 'Aaa', 'number' => 34);
$arr[] = array('name' => 'Bbb', 'number' => 8);
$arr[] = array('name' => 'Ccc', 'number' => array(65, 74, 8));
$source = new ArrayDataSource($arr);
$processor->setDataSource($source);
$processor->setOutput(new FileOutput($output));
$processor->run();
?>
