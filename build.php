<?php
$basedir = __DIR__;
$builddir = $basedir . DIRECTORY_SEPARATOR . 'build';
$archivename = 'haluz.phar';

$iterator = new AppendIterator();
$dir = $basedir . DIRECTORY_SEPARATOR . 'src';
$iterator->append(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
	$dir, RecursiveDirectoryIterator::SKIP_DOTS)));
$dir = $basedir . DIRECTORY_SEPARATOR . 'vendor';
$iterator->append(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
	$dir, RecursiveDirectoryIterator::SKIP_DOTS)));
foreach ($iterator as $file) {
	echo $file . PHP_EOL;
}

$phar = new Phar($archivename);
$phar->setSignatureAlgorithm(Phar::SHA1);
$phar->startBuffering();
$phar->buildFromIterator($iterator, $basedir);
$phar->setStub(file_get_contents($basedir . DIRECTORY_SEPARATOR . 'stub.php'));
$phar->stopBuffering();
?>