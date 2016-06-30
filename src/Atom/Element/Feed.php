<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Atom\Element;

use Mekras\AtomPub\Atom\Construct\Text;
use Mekras\AtomPub\Atom\Exception\MalformedNodeException;

/**
 * Atom Feed.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc4287#section-4.1.1
 */
class Feed extends Element
{
    /**
     * Return Feed ID.
     *
     * @return string IRI
     *
     * @throws \Mekras\AtomPub\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-4.2.6
     */
    public function getId()
    {
        return $this->getCachedProperty(
            'id',
            function () {
                return trim($this->query('atom:id', self::SINGLE | self::REQUIRED)->nodeValue);
            }
        );
    }

    /**
     * Return Feed title.
     *
     * @return Text
     *
     * @throws \InvalidArgumentException
     * @throws \Mekras\AtomPub\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-4.2.14
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
     * Return the most recent instant in time when a feed was modified.
     *
     * @return \DateTime
     *
     * @throws \Mekras\AtomPub\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-4.2.15
     */
    public function getUpdated()
    {
        return $this->getCachedProperty(
            'updated',
            function () {
                return new \DateTimeImmutable(
                    trim($this->query('atom:updated', self::SINGLE | self::REQUIRED)->nodeValue)
                );
            }
        );
    }

    /**
     * Return the preferred URI for retrieving Atom Feed Documents representing this Atom feed.
     *
     * @return string
     *
     * @throws \Mekras\AtomPub\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-4.1.1
     */
    public function getSelfLink()
    {
        return $this->getCachedProperty(
            'selfLink',
            function () {
                $element = $this->query('atom:link[@rel="self"]', self::SINGLE | self::REQUIRED);

                return trim($element->getAttribute('href'));
            }
        );
    }

    public function getAlternateLinks()
    {
        return [];
    }

    /**
     * Return list of the Feed authors.
     *
     * @return array
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-4.2.1
     */
    public function getAuthors()
    {
        return []; // TODO 1..*
    }

    /**
     * Return list of the Feed categories.
     *
     * @return array
     *
     * @since 1.0
     * @link  https://tools.ietf.org/html/rfc4287#section-4.2.2
     */
    public function getCategories()
    {
        return []; // TODO *
    }

    public function getContributors()
    {
        return [];
    }

    public function getGenerator()
    {
        return null; // TODO 0..1
    }

    public function getIcon()
    {
        return null; // TODO 0..1
    }

    public function getLogo()
    {
        return null; // TODO 0..1
    }

    public function getRights()
    {
        return null; // TODO
    }

    public function getSubTitle()
    {
        return null; // TODO
    }

    public function getEntries()
    {
        return null; // TODO
    }

    /**
     * Return node name.
     *
     * @return string
     *
     * @since 1.0
     */
    protected function getNodeName()
    {
        return 'feed';
    }
}