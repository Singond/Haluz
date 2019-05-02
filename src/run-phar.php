<?php
namespace Haluz;

require_once \Phar::running() . DIRECTORY_SEPARATOR . 'vendor'
	. DIRECTORY_SEPARATOR . 'autoload.php';

$app = new Application();
$app->run();
?>