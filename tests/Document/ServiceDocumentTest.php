<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Document;

use Mekras\AtomPub\Document\ServiceDocument;

/**
 * Tests for Mekras\AtomPub\Document\ServiceDocument
 *
 * @covers Mekras\AtomPub\Document\ServiceDocument
 * @covers Mekras\AtomPub\Document\Document
 */
class ServiceDocumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testParse()
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->load(__DIR__ . '/../fixtures/ServiceDocument.xml');

        $document = new ServiceDocument($doc);
        $items = $document->getWorkspaces();

        static::assertCount(2, $items);
        static::assertEquals('Main Site', $items[0]->getTitle());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unexpected NS "", expecting "http://www.w3.org/2007/app"
     */
    public function testInvalidNS()
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML('<service/>');

        new ServiceDocument($doc);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unexpected node "foo", expecting "service"
     */
    public function testInvalidTag()
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML('<foo xmlns="http://www.w3.org/2007/app"/>');

        new ServiceDocument($doc);
    }

    /**
     *
     */
    public function testCreate()
    {
        $document = new ServiceDocument();
        $workspace = $document->addWorkspace('My Workspace');
        $collection = $workspace->addCollection('My Collection');
        $collection->setHref('http://example/org/coll1');

        $doc = $document->getDomDocument();
        $doc->formatOutput = true;
        static::assertEquals(
            file_get_contents(__DIR__ . '/../fixtures/ServiceDocument.txt'),
            $doc->saveXML()
        );
    }
}