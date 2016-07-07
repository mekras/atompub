<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Element;

use Mekras\AtomPub\Element\Collection;
use Mekras\AtomPub\Element\Workspace;
use Mekras\AtomPub\Tests\TestCase;

/**
 * Tests for Mekras\AtomPub\Element\Workspace
 */
class WorkspaceTest extends TestCase
{
    /**
     *
     */
    public function testParse()
    {
        $workspace = new Workspace(
            $this->createFakeNode(),
            $this->loadFixture('Workspace.xml')->documentElement
        );

        static::assertEquals('Main Site', $workspace->getTitle());
        $collections = $workspace->getCollections();
        static::assertInternalType('array', $collections);
        static::assertInstanceOf(Collection::class, $collections[0]);
    }

    /**
     *
     */
    public function testCreate()
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML(
            '<workspace xmlns="http://www.w3.org/2007/app" ' .
            'xmlns:atom="http://www.w3.org/2005/Atom"/>'
        );
        $workspace = new Workspace($this->createFakeNode(), $doc->documentElement);
        $workspace->setTitle('Foo');
        $workspace->addCollection('Foo Collection');
        static::assertEquals('Foo', (string) $workspace->getTitle());
        $collections = $workspace->getCollections();
        static::assertCount(1, $collections);
        static::assertEquals('Foo Collection', (string) $collections[0]->getTitle());
        $workspace->setTitle('Bar');
        static::assertEquals('Bar', (string) $workspace->getTitle());
    }
}
