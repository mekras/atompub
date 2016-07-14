# [Atom Publishing Protocol](http://tools.ietf.org/html/rfc5023) support library

[![Latest Stable Version](https://poser.pugx.org/mekras/atompub/v/stable.png)](https://packagist.org/packages/mekras/atompub)
[![License](https://poser.pugx.org/mekras/atompub/license.png)](https://packagist.org/packages/mekras/atompub)
[![Build Status](https://travis-ci.org/mekras/atompub.svg?branch=master)](https://travis-ci.org/mekras/atompub)
[![Coverage Status](https://coveralls.io/repos/mekras/atompub/badge.svg?branch=master&service=github)](https://coveralls.io/github/mekras/atompub?branch=master)

## Purpose

This library is designed to work with the [AtomPub](http://tools.ietf.org/html/rfc5023) documents in
an object-oriented style. It does not contain the functionality to download or display documents.

This library is an extension of the package [Atom](https://packagist.org/packages/mekras/atom). 

## Parsing documents

```php
use Mekras\Atom\Document\EntryDocument;
use Mekras\Atom\Document\FeedDocument;
use Mekras\Atom\Exception\AtomException;
use Mekras\AtomPub\Document\CategoryDocument;
use Mekras\AtomPub\Document\ServiceDocument;
use Mekras\AtomPub\DocumentFactory;

$factory = new DocumentFactory;

$xml = file_get_contents('http://example.com/atom');
try {
    $document = $factory->parseXML($xml);
} catch (AtomException $e) {
    die($e->getMessage());
}

if ($document instanceof CategoryDocument) {
    $categories = $document->getCategories();
    //...
} elseif ($document instanceof ServiceDocument) {
    $workspaces = $document->getWorkspaces();
    //...
} elseif ($document instanceof FeedDocument) {
    $feed = $document->getFeed();
    //...
} elseif ($document instanceof EntryDocument) {
    $entry = $document->getEntry();
    //...
}
```

## Creating entries

```php
use Mekras\AtomPub\DocumentFactory;

$factory = new DocumentFactory;
$document = $factory->createDocument('atom:entry');
$entry = $document->getEntry();
$entry->addId('urn:entry:0001');
$entry->addTitle('Entry Title');
$entry->addAuthor('Author 1')->setEmail('foo@example.com');
$entry->addContent('<h1>Entry content</h1>', 'html');
$entry->addCategory('tag1')->setLabel('Tag label')->setScheme('http://example.com/scheme');
$entry->addUpdated(new \DateTime());

// Suppose that $httpClient is some kind of HTTP client...
$httpClient->sendRequest('POST', 'http://example.com/', (string) $document);
```
