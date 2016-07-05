<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Document;

use Mekras\Atom\Document\EntryDocument as AtomEntryDocument;
use Mekras\AtomPub\Element\Entry;

/**
 * Atom Entry Document.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc4287#section-2
 */
class EntryDocument extends AtomEntryDocument
{
    /**
     * Return entry.
     *
     * @return Entry
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getEntry()
    {
        return $this->getCachedProperty(
            'entry',
            function () {
                return new Entry($this->getDomDocument()->documentElement);
            }
        );
    }
}
