.PHONY: build clean

build: build/haluz.phar

clean:
	rm -rf build/

build/haluz.phar: build.php stub.php $(shell find src -name "*.php")
	mkdir -p build
	cd build && php -c .. ../build.php