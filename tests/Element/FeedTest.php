<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Element;

use Mekras\AtomPub\Element\Entry;
use Mekras\AtomPub\Element\Feed;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Element\Feed
 *
 * @covers Mekras\AtomPub\Element\Feed
 */
class FeedTest extends TestCase
{
    /**
     * Feed::getEntries should return AtomPub versions of Entry class.
     */
    public function testAtomPubEntries()
    {
        $feed = new Feed($this->loadFixture('FeedDocument.xml')->documentElement);
        $entries = $feed->getEntries();
        foreach ($entries as $entry) {
            static::assertInstanceOf(Entry::class, $entry);
        }
    }

    /**
     * Feed::addEntry should return AtomPub version of Entry class.
     */
    public function testAtomPubAddEntry()
    {
        $feed = new Feed($this->loadFixture('FeedDocument.xml')->documentElement);
        $entry = $feed->addEntry();
        static::assertInstanceOf(Entry::class, $entry);
    }
}
