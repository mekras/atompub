<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests;

use Mekras\AtomPub\AtomPub;
use Mekras\AtomPub\Document\CategoryDocument;
use Mekras\AtomPub\Document\EntryDocument;
use Mekras\AtomPub\Document\FeedDocument;
use Mekras\AtomPub\Document\ServiceDocument;

/**
 * Tests for Mekras\AtomPub\AtomPub
 *
 * @covers Mekras\AtomPub\AtomPub
 * @covers Mekras\AtomPub\Extension\AtomPubDocuments
 */
class AtomPubTest extends TestCase
{
    /**
     *
     */
    public function testParseService()
    {
        $atompub = new AtomPub();
        $doc = $atompub->parseDocument($this->loadFixture('ServiceDocument.xml'));
        static::assertInstanceOf(ServiceDocument::class, $doc);
    }

    /**
     *
     */
    public function testParseCategory()
    {
        $atompub = new AtomPub();
        $doc = $atompub->parseDocument($this->loadFixture('CategoryDocument.xml'));
        static::assertInstanceOf(CategoryDocument::class, $doc);
    }

    /**
     *
     */
    public function testParseFeed()
    {
        $atompub = new AtomPub();
        $doc = $atompub->parseDocument($this->loadFixture('FeedDocument.xml'));
        static::assertInstanceOf(FeedDocument::class, $doc);
    }

    /**
     *
     */
    public function testParseEntry()
    {
        $atompub = new AtomPub();
        $doc = $atompub->parseDocument($this->loadFixture('EntryDocument.xml'));
        static::assertInstanceOf(EntryDocument::class, $doc);
    }
}
