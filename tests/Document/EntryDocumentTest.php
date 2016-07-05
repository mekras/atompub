<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Document;

use Mekras\AtomPub\Document\EntryDocument;
use Mekras\AtomPub\Element\Entry;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Document\EntryDocument
 *
 * @covers Mekras\AtomPub\Document\EntryDocument
 */
class EntryDocumentTest extends TestCase
{
    /**
     * EntryDocument::getEntry should return AtomPub version of Entry class.
     */
    public function testAtomPubEntry()
    {
        $document = new EntryDocument($this->loadFixture('EntryDocument.xml'));
        $feed = $document->getEntry();

        static::assertInstanceOf(Entry::class, $feed);
    }
}
