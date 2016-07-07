<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests;

use Mekras\AtomPub\Document\CategoryDocument;
use Mekras\AtomPub\Document\ServiceDocument;
use Mekras\AtomPub\DocumentFactory;

/**
 * Tests for Mekras\AtomPub\AtomPub
 */
class DocumentFactoryTest extends TestCase
{
    /**
     *
     */
    public function testParseService()
    {
        $factory = new DocumentFactory();
        $doc = $factory->parseDocument($this->loadFixture('ServiceDocument.xml'));
        static::assertInstanceOf(ServiceDocument::class, $doc);
    }

    /**
     *
     */
    public function testParseCategory()
    {
        $factory = new DocumentFactory();
        $doc = $factory->parseDocument($this->loadFixture('CategoryDocument.xml'));
        static::assertInstanceOf(CategoryDocument::class, $doc);
    }
}
