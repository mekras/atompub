<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Tests\Atom\Construct;

use Mekras\AtomPub\Atom\Construct\Text;

/**
 * Tests for Mekras\AtomPub\Atom\Construct\Text
 *
 * @covers Mekras\AtomPub\Atom\Construct\Text
 * @covers Mekras\AtomPub\Atom\Node
 */
class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test "text" type
     */
    public function testText()
    {
        $doc = new \DOMDocument();
        $doc->loadXML(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<text xmlns="http://www.w3.org/2005/Atom">Less: &lt;</text>'
        );

        $text = new Text($doc->documentElement);
        static::assertEquals('text', $text->getType());
        static::assertEquals('Less: <', (string) $text);
    }

    /**
     * Test "html" type
     */
    public function testHtml()
    {
        $doc = new \DOMDocument();
        $doc->loadXML(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<text xmlns="http://www.w3.org/2005/Atom" type="html">&lt;em> &amp;lt; &lt;/em></text>'
        );

        $text = new Text($doc->documentElement);
        static::assertEquals('html', $text->getType());
        static::assertEquals('<em> &lt; </em>', (string) $text);
    }

    /**
     * Test "xhtml" type
     */
    public function testXhtml()
    {
        $doc = new \DOMDocument();
        $doc->loadXML(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<text xmlns="http://www.w3.org/2005/Atom" type="xhtml" ' .
            'xmlns:xhtml="http://www.w3.org/1999/xhtml">&lt;em>' .
            '<xhtml:div><xhtml:em> &lt; </xhtml:em></xhtml:div>' .
            '</text>'
        );

        $text = new Text($doc->documentElement);
        static::assertEquals('xhtml', $text->getType());
        static::assertEquals('<em> &lt; </em>', (string) $text);
    }
}
