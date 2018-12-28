<?php
// namespace Haluz;

use Haluz\Processor;
use Haluz\ArrayDataSource;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Processor.php';
require_once __DIR__ . '/ArrayDataSource.php';

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
$source = new ArrayDataSource();
$processor->setDataSource($source);
$processor->run();
?>
