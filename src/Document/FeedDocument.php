<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Document;

use Mekras\Atom\Document\FeedDocument as AtomFeedDocument;
use Mekras\AtomPub\Element\Feed;

/**
 * Atom Feed Document.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc4287#section-2
 */
class FeedDocument extends AtomFeedDocument
{
    /**
     * Return feed.
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getFeed()
    {
        return $this->getCachedProperty(
            'feed',
            function () {
                return new Feed($this->getDomDocument()->documentElement);
            }
        );
    }
}
