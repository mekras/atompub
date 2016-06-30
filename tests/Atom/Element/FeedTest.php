<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Atom\Element;

use Mekras\AtomPub\Atom\Construct\Text;
use Mekras\AtomPub\Atom\Element\Entry;
use Mekras\AtomPub\Atom\Element\Feed;

/**
 * Tests for Mekras\AtomPub\Atom\Element\Feed
 *
 * @covers Mekras\AtomPub\Atom\Element\Feed
 * @covers Mekras\AtomPub\Atom\Element\Element
 * @covers Mekras\AtomPub\Atom\Node
 */
class FeedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test importing valid feed
     */
    public function testImport()
    {
        $doc = new \DOMDocument();
        $doc->load(__DIR__ . '/../fixtures/FeedDocument.xml');

        $feed = new Feed($doc->documentElement);
        static::assertEquals('urn:foo:atom1:feed:id', $feed->getId());
        static::assertEquals('http://example.com/atom', $feed->getSelfLink());
        $value = $feed->getTitle();
        static::assertInstanceOf(Text::class, $value);
        static::assertEquals('text', $value->getType());
        static::assertEquals('Feed Title', $value);
        static::assertEquals('2016-01-23 11:22:33', $feed->getUpdated()->format('Y-m-d H:i:s'));
        $entries = $feed->getEntries();
        static::assertCount(3, $entries);
        static::assertInstanceOf(Entry::class, $entries[0]);
        static::assertEquals('Entry 3 Title', (string) $entries[0]->getTitle());
    }
}
