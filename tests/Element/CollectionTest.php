<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Element;

use Mekras\AtomPub\Element\Collection;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Element\Collection
 */
class CollectionTest extends TestCase
{
    /**
     *
     */
    public function testParse()
    {
        $collection = new Collection(
            $this->createFakeNode(),
            $this->loadFixture('Collection.xml')->documentElement
        );

        static::assertEquals('Pictures', $collection->getTitle());
        static::assertEquals('http://example.org/blog/pic', $collection->getHref());
        static::assertEquals(
            ['image/png', 'image/jpeg', 'image/gif'],
            $collection->getAcceptedTypes()
        );
    }

    /**
     *
     */
    public function testCreate()
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML(
            '<collection xmlns="http://www.w3.org/2007/app" ' .
            'xmlns:atom="http://www.w3.org/2005/Atom"/>'
        );
        $collection = new Collection($this->createFakeNode(), $doc->documentElement);
        $collection->setTitle('Foo');
        $collection->setHref('http://example.org/foo');
        $collection->setAcceptedTypes(['a', 'b', 'c']);
        static::assertEquals('Foo', (string) $collection->getTitle());
        static::assertEquals('http://example.org/foo', $collection->getHref());
        static::assertEquals(['a', 'b', 'c'], $collection->getAcceptedTypes());
        $collection->setTitle('Bar');
        $collection->setAcceptedTypes(['1', '2', '3']);
        static::assertEquals('Bar', (string) $collection->getTitle());
        static::assertEquals(['1', '2', '3'], $collection->getAcceptedTypes());
    }
}
