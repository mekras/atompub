<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Element\Meta;

use Mekras\Atom\Atom;
use Mekras\Atom\Node;
use Mekras\Atom\NodeInterfaceTrait;

/**
 * Support for "atom:link[rel=edit]".
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc4287#section-9.1
 */
trait HasMemberUri
{
    use NodeInterfaceTrait;

    /**
     * Return Member URI.
     *
     * @return string IRI
     *
     * @throws \Mekras\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     */
    public function getMemberUri()
    {
        return $this->getCachedProperty(
            'memberUri',
            function () {
                $element = $this->query('atom:link[@rel="edit"]', Node::SINGLE);

                return $element ? trim($element->getAttribute('href')) : null;
            }
        );
    }

    /**
     * Set Member URI.
     *
     * @param string $value IRI
     *
     * @throws \Mekras\Atom\Exception\MalformedNodeException
     *
     * @since 1.0
     */
    public function setMemberUri($value)
    {
        $element = $this->query('atom:link[@rel="edit"]', Node::SINGLE);
        if (null === $element) {
            $element = $this->getDomElement()->ownerDocument->createElementNS(Atom::NS, 'link');
            $this->getDomElement()->appendChild($element);
            $element->setAttribute('rel', 'edit');
        }
        $element->setAttribute('href', $value);
        $this->setCachedProperty('memberUri', $value);
    }
}
