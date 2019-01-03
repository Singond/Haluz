<?php
$basedir = __DIR__;
$builddir = $basedir . DIRECTORY_SEPARATOR . 'build';
$archivename = 'haluz.phar';

$phar = new Phar($archivename);
$phar->setSignatureAlgorithm(Phar::SHA1);
$phar->startBuffering();
$phar->setStub(file_get_contents($basedir . DIRECTORY_SEPARATOR . 'stub.php'));

// If changing the base directory for buildFromIterator, remember to update
// the path in autoload.psr-4 in composer.json.
// In the current setup, the autoloader searches the src/ and vendor/ subdirs.

$dir = $basedir . DIRECTORY_SEPARATOR . 'src';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
	$dir, RecursiveDirectoryIterator::SKIP_DOTS));
$phar->buildFromIterator($iterator, $basedir);

$dir = $basedir . DIRECTORY_SEPARATOR . 'vendor';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
	$dir, RecursiveDirectoryIterator::SKIP_DOTS));
$phar->buildFromIterator($iterator, $basedir);

$phar->stopBuffering();
?>