<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Document;

use Mekras\AtomPub\Document\FeedDocument;
use Mekras\AtomPub\Element\Feed;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Document\FeedDocument
 *
 * @covers Mekras\AtomPub\Document\FeedDocument
 */
class FeedDocumentTest extends TestCase
{
    /**
     * FeedDocument::getFeed should return AtomPub version of Feed class.
     */
    public function testAtomPubFeed()
    {
        $document = new FeedDocument($this->loadFixture('FeedDocument.xml'));
        $feed = $document->getFeed();

        static::assertInstanceOf(Feed::class, $feed);
    }
}
