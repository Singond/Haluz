<?php
namespace Haluz;

$root = dirname(__DIR__);
if (file_exists($root.'/vendor/autoload.php')) {
	// Running from source; vendor/ is alongside src/
	require_once $root.'/vendor/autoload.php';
} elseif (file_exists(dirname($root, 2).'/autoload.php')) {
	// Running from vendor/singon/haluz
	require_once dirname($root, 2).'/autoload.php';
} else {
	echo "Could not find autoloader".PHP_EOL;
	exit(1);
}

$app = new Application();
$app->run();
?>