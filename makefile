build/haluz.phar: build.php stub.php
	mkdir -p build
	cd build && php -c .. ../build.php

.PHONY: build clean

build: build/haluz.phar

clean:
	rm -rf build/