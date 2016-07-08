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
    public function testParseServiceDocument()
    {
        $factory = new DocumentFactory();
        $document = $factory->parseDocument($this->loadFixture('ServiceDocument.xml'));
        static::assertInstanceOf(ServiceDocument::class, $document);
    }

    /**
     *
     */
    public function testCreateServiceDocument()
    {
        $factory = new DocumentFactory();
        $document = $factory->createDocument('app:service');
        static::assertInstanceOf(ServiceDocument::class, $document);
    }

    /**
     *
     */
    public function testParseCategoryDocument()
    {
        $factory = new DocumentFactory();
        $document = $factory->parseDocument($this->loadFixture('CategoryDocument.xml'));
        static::assertInstanceOf(CategoryDocument::class, $document);
    }

    /**
     *
     */
    public function testCreateCategoryDocument()
    {
        $factory = new DocumentFactory();
        $document = $factory->createDocument('app:categories');
        static::assertInstanceOf(CategoryDocument::class, $document);
    }
}
