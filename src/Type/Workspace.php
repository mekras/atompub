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
 * Workspace.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc5023#section-8.3.2
 */
class Workspace extends Element
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
     * Return collections.
     *
     * @return Collection[]
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getCollections()
    {
        return $this->getCachedProperty(
            'collections',
            function () {
                $result = [];
                /** @var \DOMNodeList $items */
                $items = $this->query('app:collection');
                foreach ($items as $item) {
                    $result[] = new Collection($item);
                }

                return $result;
            }
        );
    }

    /**
     * Add new Collection
     *
     * @param string $title
     *
     * @return Collection
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function addCollection($title)
    {
        $collections = $this->getCollections();

        $collection = new Collection($this);
        $collection->setTitle($title);

        $collections[] = $collection;
        $this->setCachedProperty('collections', $collections);

        return $collection;
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
        return 'workspace';
    }
}
