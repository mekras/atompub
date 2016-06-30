<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub;

use Mekras\AtomPub\Atom\Document\Document;
use Mekras\AtomPub\Atom\Document\FeedDocument;
use Mekras\AtomPub\Document\ServiceDocument;

/**
 * AtomPub.
 *
 * @since 1.0
 *
 * @api
 * @link  https://tools.ietf.org/html/rfc5023
 */
class AtomPub
{
    /**
     * AtomPub namespace
     *
     * @since 1.0
     */
    const NS = 'http://www.w3.org/2007/app';

    /**
     * Parse AtomPub response.
     *
     * @param string $xml Response XML.
     *
     * @return Document
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function parseXML($xml)
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML($xml);

        switch ($doc->documentElement->localName) {
            case 'service':
                return new ServiceDocument($doc);
            case 'feed':
                return new FeedDocument($doc);
        }

        throw new \InvalidArgumentException(
            sprintf('Unexpected root element "%s"', $doc->documentElement->localName)
        );
    }
}
