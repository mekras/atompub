<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Document;

use Mekras\AtomPub\Atom\Document\Document as AtomDocument;
use Mekras\AtomPub\AtomPub;

/**
 * AtomPub Document.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc5023#section-6
 */
abstract class Document extends AtomDocument
{
    /**
     * Create document.
     *
     * @param \DOMDocument|null $document
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function __construct($document = null)
    {
        parent::__construct($document);
        $this->getDomDocument()->documentElement
            ->setAttributeNS(self::XMLNS, 'xmlns:atom', self::ATOM);
    }

    /**
     * Return node main namespace.
     *
     * @return string
     *
     * @since 1.0
     */
    public function ns()
    {
        return AtomPub::NS;
    }
}