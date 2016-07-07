<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Element;

use Mekras\AtomPub\Element\Entry;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Element\Entry
 */
class EntryTest extends TestCase
{
    /**
     * @covers Mekras\AtomPub\Element\Entry::getMemberUri
     */
    public function testGetMemberUri()
    {
        $entry = new Entry(
            $this->createExtensions(),
            $this->loadFixture('EntryDocument.xml')->documentElement
        );
        static::assertEquals('http://example.com/atom/atom/?edit=0001', $entry->getMemberUri());
    }

    /**
     * @covers Mekras\AtomPub\Element\Entry::setMemberUri
     */
    public function testSetMemberUri1()
    {
        $entry = new Entry(
            $this->createExtensions(),
            $this->loadFixture('EntryDocument.xml')->documentElement
        );
        $entry->setMemberUri('http://example.com/atom/atom/?edit=0002');
        static::assertEquals('http://example.com/atom/atom/?edit=0002', $entry->getMemberUri());
        static::assertContains(
            'http://example.com/atom/atom/?edit=0002',
            $entry->getDomElement()->ownerDocument->saveXML($entry->getDomElement())
        );
    }

    /**
     * @covers Mekras\AtomPub\Element\Entry::setMemberUri
     */
    public function testSetMemberUri2()
    {
        $entry = new Entry(
            $this->createExtensions(),
            $this->loadFixture('EmptyEntry.xml')->documentElement
        );
        $entry->setMemberUri('http://example.com/atom/atom/?edit=0001');
        static::assertEquals('http://example.com/atom/atom/?edit=0001', $entry->getMemberUri());
        static::assertContains(
            'http://example.com/atom/atom/?edit=0001',
            $entry->getDomElement()->ownerDocument->saveXML($entry->getDomElement())
        );
    }
}
