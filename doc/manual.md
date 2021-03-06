---
title: Haluz
subtitle: A command-line wrapper around the Twig templating engine
---

_Haluz_ is a simple wrapper around the [Twig](https://twig.symfony.com/)
templating engine with a command-line interface.

Requirements
============
Haluz requires PHP >7.2? to run.

Usage
=====

With multiple data entries, one can use a special variable `_i` to obtain the
one-based index of this entry in the data source.

Options
-------

### `--json`
Reads data from a JSON file. See [_Data sources_](#source-json) section below.

### `--csv`
Reads data from a CSV file. See [_Data sources_](#source-csv) section below.

Data sources
------------

### JSON file (`--json`) {#source-json}
Reads data from a JSON file.

### CSV file (`--csv`) {#source-csv}
Reads data from a CSV table. The first row is used as a header.
Cell values in subsequent rows are indexed with the corresponding value
in the header.

By default, the whole table is a considered a single data entry.

If the `--multiple` option is given, each row of the CSV table is treated
as a separate data entry.
