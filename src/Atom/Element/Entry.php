<?php
/**
 * Atom Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Atom\Element;

use Mekras\AtomPub\Atom\Construct\Text;

/**
 * Atom Entry.
 *
 * @since 1.0
 */
class Entry extends Element
{
    use Traits\Title;

    /**
     * Return node name.
     *
     * @return string
     *
     * @since 1.0
     */
    protected function getNodeName()
    {
        return 'entry';
    }
}
