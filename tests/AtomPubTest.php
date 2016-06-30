<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests;

use Mekras\AtomPub\Atom\Document\FeedDocument;
use Mekras\AtomPub\AtomPub;
use Mekras\AtomPub\Document\ServiceDocument;

/**
 * Tests for Mekras\AtomPub\AtomPub
 *
 * @covers Mekras\AtomPub\AtomPub
 */
class AtomPubTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testParseService()
    {
        $atompub = new AtomPub();
        $doc = $atompub->parseXML(file_get_contents(__DIR__ . '/fixtures/ServiceDocument.txt'));
        static::assertInstanceOf(ServiceDocument::class, $doc);
    }

    /**
     *
     */
    public function testParseFeed()
    {
        $atompub = new AtomPub();
        $doc = $atompub->parseXML(file_get_contents(__DIR__ . '/fixtures/FeedDocument.xml'));
        static::assertInstanceOf(FeedDocument::class, $doc);
    }
}
