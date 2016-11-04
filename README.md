iConneqt REST API PHP Client
============================
Version 1.0.2

A PHP class library for the iConneqt REST API.

[![license](https://img.shields.io/github/license/iConneqt/PHP-REST-API-client.svg)]()
[![Build Status](https://travis-ci.org/iConneqt/PHP-REST-API-client.svg?branch=master)](https://travis-ci.org/iConneqt/PHP-REST-API-client)

Copyright &copy; 2016 Advanced CRMMail Technology B.V.

Documentation
-------------
The API documentation can be found here: [http://test.iconneqt.nl/api/docs/](http://test.iconneqt.nl/api/docs/).

Installation
------------
Either use the included autoloader in `src/autoloader.php` or install using
Composer:

	composer require iconneqt/rest-api-client

Classes
-------
Class hierarchy in the `src` directory.

If you use Composer, you can add the `src` to the autoloader as such:

	/* @var $loader Composer\Autoload\ClassLoader */
	$loader = require 'path-to-vendor/autoload.php';
	$loader->add('Iconneqt', 'path-to-src');

The two most important classes are the following:

### `\Iconneqt\Api\Rest\Iconneqt`
High-level access to the iConneqt REST API, returning rich objects from which
you can explore/dive into the API further.

Method calls to the `Iconneqt` class return objects where properties can be
accessed using getters and further objects can be queried from the REST API.

Alternatively, you can just use the `Iconneqt` class directly.

### `\Iconneqt\Api\Rest\Client\Client`
Low-level API access component used internally by the `Iconneqt` class.

Essentially, this class is a somewhat generic wrapper for `cURL` lightly tuned
for the iConneqt REST API.

You may want to use this class if you want to use all available functionality
the REST API has to offer or want to bypass the use of objects.

Method calls to the `Client` class return `stdClass` objects by default, but
can be set to return associative arrays instead.

Examples
--------
Examples in the `example` directory.

### Authentication for examples
*	Copy the file `auth.example.ini` to `auth.ini`.
*	Put your iConneqt username and password in the new file.
*	If you are on a different server from `demo.iconneqt.nl`, change the URL in
	the `auth.ini` file accordingly.

### Examples
*	`check_email` demonstrates a simple form to check if an email address
	exists on a given list. Start with this example as an introduction to the
	`Iconneqt` class.
*	`form` shows a dynamic form to add new subscribers to a list.
*	`low-level` demonstrates using the `Client` class directly.