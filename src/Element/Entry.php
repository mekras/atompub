<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Element;

use Mekras\Atom\Element\Entry as AtomEntry;

/**
 * Atom Entry.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc4287#section-4.1.2
 */
class Entry extends AtomEntry
{
    use Meta\HasMemberUri;
}
