doc_formats := html pdf
src_php := $(shell find src -name "*.php")

build: build/haluz.phar $(foreach ext, $(doc_formats), build/doc/manual.$(ext))

clean:
	rm -rf build/

.PHONY: build clean

build/haluz.phar: build.php stub.php $(patsubst %,build/%,$(src_php))
	cd build && php -c .. ../build.php

build/%.php: %.php
	@mkdir -p build/src
	cp $< $@
build/src/run-phar.php: src/run-phar.php
	@echo Reading version from composer.json
	version=$$(grep -E '\s*\"version\":' composer.json | sed -r 's/\s*\"version\":\s\"([^\"]*)\",/\1/'); \
	m4 -D "VAR_VERSION=$${version}" $< > $@

build/doc/%.html: doc/%.md
	@mkdir -p build/doc
	pandoc doc/$*.md --to=html --standalone -o $@

build/doc/%.pdf: doc/%.md
	@mkdir -p build/doc
	pandoc doc/$*.md  --standalone -Vpapersize:a4 -o $@
