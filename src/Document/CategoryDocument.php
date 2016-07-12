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
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function isFixed()
    {
        return $this->getCachedProperty(
            'fixed',
            function () {
                return $this->getAttribute('fixed') === 'yes';
            }
        );
    }

    /**
     * Set whether the list of categories is a fixed or an open set.
     *
     * @param bool $state
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function setFixed($state)
    {
        $this->setAttribute('fixed', $state ? 'yes' : 'no');
        $this->setCachedProperty('fixed', $state);
    }

    /**
     * Return parent scheme.
     *
     * @return string|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getScheme()
    {
        return $this->getCachedProperty(
            'scheme',
            function () {
                return $this->getAttribute('scheme');
            }
        );
    }

    /**
     * Set parent scheme.
     *
     * @param  string|null $iri Scheme IRI.
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function setScheme($iri)
    {
        $this->setAttribute('scheme', $iri);
        $this->setCachedProperty('scheme', $iri);
    }

    /**
     * Return reference identifying a Category Document.
     *
     * @return string|null
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getHref()
    {
        return $this->getCachedProperty(
            'href',
            function () {
                return $this->getAttribute('href');
            }
        );
    }

    /**
     * Set reference identifying a Category Document.
     *
     * @param  string|null $iri IRI.
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function setHref($iri)
    {
        $this->setAttribute('href', $iri);
        $this->setCachedProperty('href', $iri);
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
