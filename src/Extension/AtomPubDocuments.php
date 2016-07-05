<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Extension;

use Mekras\Atom\Atom;
use Mekras\Atom\Document\Document;
use Mekras\Atom\Extension\DocumentType;
use Mekras\AtomPub\AtomPub;
use Mekras\AtomPub\Document\CategoryDocument;
use Mekras\AtomPub\Document\EntryDocument;
use Mekras\AtomPub\Document\FeedDocument;
use Mekras\AtomPub\Document\ServiceDocument;

/**
 * AtomPub additional documents.
 *
 * @since 1.0
 */
class AtomPubDocuments implements DocumentType
{
    /**
     * Create AtomPub document from XML document.
     *
     * @param \DOMDocument $document
     *
     * @return Document|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function createDocument(\DOMDocument $document)
    {
        if (AtomPub::NS === $document->documentElement->namespaceURI) {
            switch ($document->documentElement->localName) {
                case 'service':
                    return new ServiceDocument($document);
                case 'categories':
                    return new CategoryDocument($document);
            }
        } elseif (Atom::NS === $document->documentElement->namespaceURI) {
            switch ($document->documentElement->localName) {
                case 'feed':
                    return new FeedDocument($document);
                case 'entry':
                    return new EntryDocument($document);
            }
        }

        return null;
    }
}
