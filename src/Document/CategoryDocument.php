<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Document;

use Mekras\Atom\Element\Meta\HasCategories;

/**
 * Category Document.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc5023#section-7
 */
class CategoryDocument extends Document
{
    use HasCategories;

    /**
     * Indicating whether the list of categories is a fixed or an open set.
     *
     * @return bool
     *
     * @since 1.0
     */
    public function isFixed()
    {
        // No NS prefix — no exception.
        return $this->getAttribute('fixed') === 'yes';
    }

    /**
     * Set whether the list of categories is a fixed or an open set.
     *
     * @param bool $state
     *
     * @since 1.0
     */
    public function setFixed($state)
    {
        // No NS prefix — no exception.
        $this->setAttribute('fixed', $state ? 'yes' : 'no');
    }

    /**
     * Return parent scheme.
     *
     * @return string|null
     *
     * @since 1.0
     */
    public function getScheme()
    {
        // No NS prefix — no exception.
        return $this->getAttribute('scheme');
    }

    /**
     * Set parent scheme.
     *
     * @param  string|null $iri Scheme IRI.
     *
     * @since 1.0
     */
    public function setScheme($iri)
    {
        // No NS prefix — no exception.
        $this->setAttribute('scheme', $iri);
    }

    /**
     * Return reference identifying a Category Document.
     *
     * @return string|null
     *
     * @since 1.0
     */
    public function getHref()
    {
        // No NS prefix — no exception.
        return $this->getAttribute('href');
    }

    /**
     * Set reference identifying a Category Document.
     *
     * @param  string|null $iri IRI.
     *
     * @since 1.0
     */
    public function setHref($iri)
    {
        // No NS prefix — no exception.
        $this->setAttribute('href', $iri);
    }

    /**
     * Return root node name here.
     *
     * @return string
     *
     * @since 1.0
     */
    protected function getRootNodeName()
    {
        return 'categories';
    }
}
