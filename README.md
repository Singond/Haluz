Haluz -- a Command-line Wrapper for Twig
======================================
_Haluz_ is a simple wrapper around the [Twig](https://twig.symfony.com/)
templating engine with a command-line interface.

Installation
============
Requirements
------------
Haluz requires PHP 7.2 or higher to run.

Installation via Composer
-------------------------
Add the following to your `composer.json`:
```
"repositories": [
	{
		"type": "vcs",
		"url": "https://github.com/Singond/Haluz.git"
	}
],
"minimum-stability": "dev",
"require": {
	"singon/haluz": "dev-dev"
}
```
Then run `composer install` or `composer update` as usual. You should see
a file called `haluz.php` in your `vendor/bin` directory.

Manual Installation
-------------------
You can also install Haluz as a standalone file.

### On Unix-like Systems
1) Download or [build](#build) the file `haluz.phar` and put it anywhere
   on your system. The archive is executable (it contains a shebang).
2) Link `haluz.phar` to your `PATH` and make it executable:
    ```
    chmod +x haluz.phar
    ln -s haluz.phar <a folder in your $PATH>/haluz
    ```

### On Windows
1) Download or [build](#build) the file `haluz.phar` and put it anywhere
   on your system.
2) Link `haluz.phar` to your `PATH`.
3) The application can now be invoked by `haluz.phar`. In order to call it by
   `haluz`, either add `.phar` to `PathExt` environment variable,
   or create a batch file called `haluz.bat` in your `PATH`.


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
