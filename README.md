# [Atom Publishing Protocol](http://tools.ietf.org/html/rfc5023) support library

[![Latest Stable Version](https://poser.pugx.org/mekras/atompub/v/stable.png)](https://packagist.org/packages/mekras/atompub)
[![License](https://poser.pugx.org/mekras/atompub/license.png)](https://packagist.org/packages/mekras/atompub)
[![Build Status](https://travis-ci.org/mekras/atompub.svg?branch=master)](https://travis-ci.org/mekras/atompub)
[![Coverage Status](https://coveralls.io/repos/mekras/atompub/badge.svg?branch=master&service=github)](https://coveralls.io/github/mekras/atompub?branch=master)

## Purpose

This library is designed to work with the [AtomPub](http://tools.ietf.org/html/rfc5023) documents in
an object-oriented style. It does not contain the functionality to download or display documents.

This library is an extension of the package [Atom](https://packagist.org/packages/mekras/atom). 

## AtomPub instead of Atom

Your should use [AtomPub](src/AtomPub.php) class for parsing documents instead of `Atom`.

```php
use Mekras\AtomPub\AtomPub;
use Mekras\Atom\Exception\AtomException;

$parser = new AtomPub;

$xml = file_get_contents('http://example.com/atom');
try {
    $document = $parser->parseXML($xml);
} catch (AtomException $e) {
    die($e->getMessage());
}
//...
```

## Additional documents

`AtomPub` class registers new document types:

- [ServiceDocument](src/Document/ServiceDocument.php)
- [CategoryDocument](src/Document/CategoryDocument.php)

