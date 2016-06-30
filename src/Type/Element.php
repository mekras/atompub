<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Type;

use Mekras\AtomPub\Atom\Element\Element as AtomElement;
use Mekras\AtomPub\AtomPub;

/**
 * Abstract AtomPub Node.
 *
 * @since 1.0
 */
abstract class Element extends AtomElement
{
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

    /**
     * Get the XPath query object
     *
     * @return \DOMXPath
     *
     * @since 1.0
     */
    protected function getXPath()
    {
        $xpath = parent::getXPath();
        $xpath->registerNamespace('app', $this->ns());

        return $xpath;
    }
}
