<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Type;

use Mekras\AtomPub\Atom\Construct\Text;

/**
 * Collection.
 *
 * @since 1.0
 *
 * @link  http://tools.ietf.org/html/rfc5023#section-8.3.3
 */
class Collection extends Element
{
    /**
     * Return title.
     *
     * @return Text
     *
     * @throws \InvalidArgumentException
     * @throws \Mekras\AtomPub\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     */
    public function getTitle()
    {
        return $this->getCachedProperty(
            'title',
            function () {
                return new Text($this->query('atom:title', self::SINGLE | self::REQUIRED));
            }
        );
    }

    /**
     * Set title.
     *
     * @param Text|string $title
     *
     * @since 1.0
     */
    public function setTitle($title)
    {
        $element = $this->query('atom:title', self::SINGLE);
        if (null === $element) {
            $element = $this->getDomElement()->ownerDocument->createElementNS(self::ATOM, 'title');
            $this->getDomElement()->appendChild($element);
        }
        $text = new Text($element);
        $text->setValue($title);
        $this->setCachedProperty('title', $text);
    }

    /**
     * The IRI of the Collection.
     *
     * @return string
     *
     * @since 1.0
     */
    public function getHref()
    {
        return $this->getDomElement()->getAttribute('href');
    }

    /**
     * Set IRI of the Collection.
     *
     * @param string $href
     *
     * @since 1.0
     */
    public function setHref($href)
    {
        $this->getDomElement()->setAttribute('href', $href);
    }

    /**
     * Return types of representations accepted by the Collection.
     *
     * @return string[]
     *
     * @since 1.0
     */
    public function getAcceptedTypes()
    {
        return $this->getCachedProperty(
            'accept',
            function () {
                $result = [];
                /** @var \DOMNodeList $nodes */
                $nodes = $this->query('app:accept');
                foreach ($nodes as $value) {
                    $result[] = trim($value->textContent);
                }

                return $result;
            }
        );
    }

    /**
     * Set types of representations accepted by the Collection.
     *
     * @param string[] $types
     *
     * @since 1.0
     */
    public function setAcceptedTypes(array $types)
    {
        /** @var \DOMNodeList $nodes */
        $nodes = $this->query('app:accept');
        foreach ($nodes as $node) {
            $this->getDomElement()->removeChild($node);
        }
        foreach ($types as $type) {
            $element = $this->getDomElement()->ownerDocument
                ->createElementNS($this->ns(), 'accept', $type);
            $this->getDomElement()->appendChild($element);
        }
        $this->setCachedProperty('accept', $types);
    }

    /**
     * Return root node name.
     *
     * @return string
     *
     * @since 1.0
     */
    protected function getNodeName()
    {
        return 'collection';
    }
}
