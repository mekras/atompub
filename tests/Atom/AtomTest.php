<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Atom;

use Mekras\AtomPub\Atom\Atom;
use Mekras\AtomPub\Atom\Document\FeedDocument;

/**
 * Tests for Mekras\AtomPub\Atom\Atom
 *
 * @covers Mekras\AtomPub\Atom\Atom
 */
class AtomTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testParseFeed()
    {
        $atom = new Atom();
        $doc = $atom->parseXML(file_get_contents(__DIR__ . '/fixtures/FeedDocument.xml'));
        static::assertInstanceOf(FeedDocument::class, $doc);
    }
}
