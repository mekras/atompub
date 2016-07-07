<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests;

use Mekras\Atom\AtomDocuments;
use Mekras\Atom\AtomElements;
use Mekras\Atom\Extensions;
use Mekras\AtomPub\Extension\AtomPubExtension;

/**
 * Base test case.
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Create and fill Extensions instance.
     *
     * @return Extensions
     */
    protected function createExtensions()
    {
        $extensions = new Extensions();
        $extensions->register(new AtomDocuments());
        $extensions->register(new AtomElements());
        $extensions->register(new AtomPubExtension());

        return $extensions;
    }

    /**
     * Locate fixture and return absolute path.
     *
     * @param string $path Path to fixture relative to tests root folder.
     *
     * @return \DOMDocument
     */
    protected function locateFixture($path)
    {
        $filename = __DIR__ . '/fixtures/' . ltrim($path, '/');
        if (!file_exists($filename)) {
            static::fail(sprintf('Fixture file "%s" not found', $filename));
        }

        return $filename;
    }

    /**
     * Load fixture and return DOM document.
     *
     * @param string $path Path to fixture relative to tests root folder.
     *
     * @return \DOMDocument
     */
    protected function loadFixture($path)
    {
        $document = new \DOMDocument('1.0', 'utf-8');
        $document->load($this->locateFixture($path));

        return $document;
    }
}
