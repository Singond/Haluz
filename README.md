Haluz -- a command-line wrapper for Twig
======================================
_Haluz_ is a simple wrapper around the [Twig](https://twig.symfony.com/)
templating engine with a command-line interface.

Requirements
============
Haluz requires PHP 7.2 or higher to run.

Build {#build}
=====
Composer installs the project from its source obtained from the repository,
therefore no build is needed for Composer.

The following instructions apply you wish to make a standalone executable
PHP archive (phar).

Requirements
------------
In order to build the project, you will need the following:

- `composer` to download PHP dependencies
- PHP to build the archive
- `make`
- `pandoc` for building the documentation

Instructions
------------
1) In the project root, run `composer install`.
2) Once `composer` has finished installing dependencies, run `make build`.
   This will create a `build` directory containing the built project, including:
   - `build/haluz.phar` -- the executable PHP archive
   - `build/doc/` -- documentation in HTML and PDF format

Usage
=====
Please see `doc/manual.md`.
