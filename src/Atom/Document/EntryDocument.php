<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Atom\Document;

use Mekras\AtomPub\Atom\Element\Entry;

/**
 * Atom Entry Document.
 *
 * @since 1.0
 *
 * @link  @link  https://tools.ietf.org/html/rfc4287#section-2
 */
class EntryDocument extends Document
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

    /**
     * Return root node name.
     *
     * @return string
     *
     * @since 1.0
     */
    protected function getRootNodeName()
    {
        return 'entry';
    }
}
