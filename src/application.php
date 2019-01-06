<?php
namespace Haluz;

$path = dirname(\Phar::running(false));
if (strlen($path) > 0) {
	// Running from PHAR
	require_once \Phar::running() . DIRECTORY_SEPARATOR . 'vendor'
		. DIRECTORY_SEPARATOR . 'autoload.php';
} else {
	// Running from source
	require_once __DIR__ . '/../vendor/autoload.php';
}

$app = new Application();
$app->run();
?>