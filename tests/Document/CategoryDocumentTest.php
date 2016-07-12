<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Document;

use Mekras\AtomPub\Document\CategoryDocument;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Document\CategoryDocument
 */
class CategoryDocumentTest extends TestCase
{
    /**
     *
     */
    public function testParse()
    {
        $document = new CategoryDocument(
            $this->createExtensions(),
            $this->loadFixture('CategoryDocument.xml')
        );
        $items = $document->getCategories();

        static::assertTrue($document->isFixed());
        static::assertEquals('http://example.com/cats/big3', $document->getScheme());
        static::assertNull($document->getHref());
        static::assertCount(3, $items);
        static::assertEquals('vegetable', $items[1]->getTerm());
    }

    /**
     *
     */
    public function testCreate()
    {
        $document = new CategoryDocument($this->createExtensions());
        $document->setFixed(false);
        $document->setScheme('http://example.com/cats/big3');
        //$document->setHref(null);
        $document->addCategory('animal');
        $document->addCategory('vegetable');
        $document->addCategory('mineral');

        $doc = $document->getDomDocument();
        $doc->formatOutput = true;
        static::assertEquals(
            file_get_contents($this->locateFixture('CategoryDocument.txt')),
            $doc->saveXML()
        );
    }
}
