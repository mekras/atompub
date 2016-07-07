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
use Mekras\Atom\Element\Element;
use Mekras\Atom\Extension\DocumentExtension;
use Mekras\Atom\Extension\ElementExtension;
use Mekras\Atom\Extension\NamespaceExtension;
use Mekras\Atom\Extensions;
use Mekras\Atom\Node;
use Mekras\AtomPub\AtomPub;
use Mekras\AtomPub\Document\CategoryDocument;
use Mekras\AtomPub\Document\ServiceDocument;
use Mekras\AtomPub\Element\Collection;
use Mekras\AtomPub\Element\Entry;
use Mekras\AtomPub\Element\Feed;
use Mekras\AtomPub\Element\Workspace;

/**
 * AtomPub additional documents.
 *
 * @since 1.0
 */
class AtomPubExtension implements DocumentExtension, ElementExtension, NamespaceExtension
{
    /**
     * Create Atom document from XML DOM document.
     *
     * @param Extensions   $extensions Extension registry.
     * @param \DOMDocument $document   Source document.
     *
     * @return Document|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function parseDocument(Extensions $extensions, \DOMDocument $document)
    {
        if (AtomPub::NS === $document->documentElement->namespaceURI) {
            switch ($document->documentElement->localName) {
                case 'service':
                    return new ServiceDocument($extensions, $document);
                case 'categories':
                    return new CategoryDocument($extensions, $document);
            }
        }

        return null;
    }

    /**
     * Create new Atom document.
     *
     * @param Extensions $extensions Extension registry.
     * @param string     $name       Element name.
     *
     * @return Document|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function createDocument(Extensions $extensions, $name)
    {
        switch ($name) {
            case 'app:service':
                return new ServiceDocument($extensions);
            case 'app:categories':
                return new CategoryDocument($extensions);
        }

        return null;
    }

    /**
     * Create Atom node from XML DOM element.
     *
     * @param Node        $parent  Parent node.
     * @param \DOMElement $element DOM element.
     *
     * @return Element|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function parseElement(Node $parent, \DOMElement $element)
    {
        if (Atom::NS === $element->namespaceURI) {
            switch ($element->localName) {
                case 'entry':
                    return new Entry($parent, $element);
                case 'feed':
                    return new Feed($parent, $element);
            }
        } elseif (AtomPub::NS === $element->namespaceURI) {
            switch ($element->localName) {
                case 'collection':
                    return new Collection($parent, $element);
                case 'workspace':
                    return new Workspace($parent, $element);
            }
        }

        return null;
    }

    /**
     * Create new Atom node.
     *
     * @param Node   $parent Parent node.
     * @param string $name   Element name.
     *
     * @return Element|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function createElement(Node $parent, $name)
    {
        switch ($name) {
            case 'atom:entry':
                return new Entry($parent);
            case 'atom:feed':
                return new Feed($parent);
            case 'app:collection':
                return new Collection($parent);
            case 'app:workspace':
                return new Workspace($parent);
        }

        return null;
    }

    /**
     * Return additional XML namespaces.
     *
     * @return string[] prefix => namespace.
     *
     * @since 1.0
     */
    public function getNamespaces()
    {
        return [AtomPub::NS];
    }
}
