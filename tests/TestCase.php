<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests;

use Mekras\Atom\Atom;
use Mekras\Atom\AtomExtension;
use Mekras\Atom\Extensions;
use Mekras\Atom\Node;
use Mekras\AtomPub\Extension\AtomPubExtension;

/**
 * Base test case.
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Return new fake Node instance.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|Node
     */
    protected function createFakeNode()
    {
        $doc = $this->createDocument();

        $node = $this->getMockBuilder(Node::class)->disableOriginalConstructor()
            ->setMethods(['getDomElement', 'getExtensions'])->getMock();
        $node->expects(static::any())->method('getDomElement')
            ->willReturn($doc->documentElement);
        $node->expects(static::any())->method('getExtensions')
            ->willReturn($this->createExtensions());

        return $node;
    }

    /**
     * Create and fill Extensions instance.
     *
     * @return Extensions
     */
    protected function createExtensions()
    {
        $extensions = new Extensions();
        $extensions->register(new AtomExtension());
        $extensions->register(new AtomPubExtension());

        return $extensions;
    }

    /**
     * Create new empty document
     *
     * @param string $contents     XML
     * @param string $rootNodeName default "doc"
     *
     * @return \DOMDocument
     */
    protected function createDocument($contents = '', $rootNodeName = 'doc')
    {
        $document = new \DOMDocument();
        $document->loadXML(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<' . $rootNodeName . ' xmlns="' . Atom::NS . '" ' .
            'xmlns:xhtml="' . Atom::XHTML . '">' .
            $contents .
            '</' . $rootNodeName . '>'
        );

        return $document;
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
