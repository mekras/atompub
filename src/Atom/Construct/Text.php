<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Atom\Construct;

use Mekras\AtomPub\Atom\Node;

/**
 * Atom Text Construct.
 *
 * @since 1.0
 * @link  https://tools.ietf.org/html/rfc4287#section-3.1
 */
class Text extends Node
{
    /**
     * Represent text as a string.
     *
     * @return string
     *
     * @since 1.0
     */
    public function __toString()
    {
        /** @var string $string */
        $string = $this->getCachedProperty(
            'value',
            function () {
                if ($this->getType() === 'xhtml') {
                    $xhtml = $this->getXPath()->query('xhtml:div')->item(0);
                    $doc = new \DOMDocument('1.0', 'utf-8');
                    $imported = $doc->importNode($xhtml, true);
                    $doc->appendChild($imported);

                    $prefix = $doc->lookupPrefix('http://www.w3.org/1999/xhtml');
                    if ('' !== $prefix) {
                        $prefix .= ':';
                    }
                    $patterns = [
                        '/<\?xml[^<]*>[^<]*<' . $prefix . 'div[^<]*/',
                        '/<\/' . $prefix . 'div>\s*$/'
                    ];
                    $text = preg_replace($patterns, '', $doc->saveXML());
                    if ('' !== $prefix) {
                        $text = preg_replace('/(<[\/]?)' . $prefix . '([a-zA-Z]+)/', '$1$2', $text);
                    }

                    return (string) $text;
                }

                return $this->getDomElement()->textContent;
            }
        );

        return $string;
    }

    /**
     * Return text type.
     *
     * @return string "text", "html", or "xhtml"
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-3.1.1
     */
    public function getType()
    {
        return $this->getCachedProperty(
            'type',
            function () {
                return $this->getDomElement()->getAttribute('type') ?: 'text';
            }
        );
    }

    /**
     * Set new value
     *
     * @param string $text
     * @param string $type
     *
     * @since 1.0
     */
    public function setValue($text, $type = 'text')
    {
        $this->getDomElement()->setAttribute('type', $type);
        $this->getDomElement()->nodeValue = $text;
    }
}
