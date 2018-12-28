<?php
// namespace Haluz;

require_once __DIR__ . '/../vendor/autoload.php';

use Haluz\Processor;
use Haluz\ArrayDataSource;

$cwd = getcwd();
$templates = $argv[1];
$templateDir = dirname($templates);
$templateName = basename($templates);

echo "Current working directory: $cwd" . PHP_EOL;
echo "Template argument: $templates" . PHP_EOL;
echo "Templates directory: $templateDir" . PHP_EOL;
echo "Template filename: $templateName" . PHP_EOL;
echo PHP_EOL;

$loader = new \Twig_Loader_Filesystem($templateDir);
$processor = new Processor();
$processor->setLoader($loader);
$processor->setTemplateName($templateName);

$arr = array();
$arr[] = array('name' => 'Aaa', 'number' => 34);
$arr[] = array('name' => 'Bbb', 'number' => 8);
$arr[] = array('name' => 'Ccc', 'number' => array(65, 74, 8));
$source = new ArrayDataSource($arr);
$processor->setDataSource($source);
$processor->run();
?>
