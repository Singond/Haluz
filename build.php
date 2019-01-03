<?php

// use \Phar;

// define('BASEDIR', __DIR__);
// define('BUILDDIR, ')
$basedir = __DIR__;
$builddir = $basedir . DIRECTORY_SEPARATOR . 'build';
$archivename = 'haluz.phar';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basedir, RecursiveDirectoryIterator::SKIP_DOTS));

$phar = new Phar($archivename);
$phar->setSignatureAlgorithm(Phar::SHA1);
$phar->startBuffering();
$phar->buildFromIterator($iterator, $basedir);
$phar->setStub(file_get_contents($basedir . DIRECTORY_SEPARATOR . 'stub.php'));
$phar->stopBuffering();
?>