<?php
require_once __DIR__ . '/../vendor/autoload.php';

$cwd = getcwd();
$templates = $argv[1];
$templateDir = dirname($templates);
$templateName = basename($templates);

echo "Current working directory: $cwd" . PHP_EOL;
echo "Template argument: $templates" . PHP_EOL;
echo "Templates directory: $templateDir" . PHP_EOL;
echo "Template filename: $templateName" . PHP_EOL;

$loader = new Twig_Loader_Filesystem($templateDir);
$twig = new Twig_Environment($loader);
$template = $twig->load($templateName);

class MyData {
	public $name = "Twig";
}

echo PHP_EOL;
$data = new MyData();
echo $template->render(array('data' => $data)) . PHP_EOL;
?>
