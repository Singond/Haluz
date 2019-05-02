<?php
/* This file is an entry point into the PHP archive. */
namespace Haluz;

require_once \Phar::running() . DIRECTORY_SEPARATOR . 'vendor'
	. DIRECTORY_SEPARATOR . 'autoload.php';

$app = new Application();
$app->run();
?>