doc_formats := html pdf

build: build/haluz.phar $(foreach ext, $(doc_formats), build/doc/manual.$(ext))

clean:
	rm -rf build/

.PHONY: build clean

build/haluz.phar: build.php stub.php $(shell find src -name "*.php")
	mkdir -p build
	cd build && php -c .. ../build.php

build/doc/%.html: doc/%.md
	mkdir -p build/doc
	pandoc doc/$*.md --to=html --standalone -o $@

build/doc/%.pdf: doc/%.md
	mkdir -p build/doc
	pandoc doc/$*.md  --standalone -Vpapersize:a4 -o $@
