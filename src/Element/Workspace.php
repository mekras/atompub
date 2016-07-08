<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Element;

use Mekras\Atom\Element\Meta\HasTitle;

/**
 * Workspace.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc5023#section-8.3.2
 */
class Workspace extends Element
{
    use HasTitle;

    /**
     * Return collections.
     *
     * @return Collection[]
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getCollections()
    {
        return $this->getCachedProperty(
            'collections',
            function () {
                $result = [];
                /** @var \DOMNodeList $items */
                $items = $this->query('app:collection');
                foreach ($items as $item) {
                    $result[] = $this->getExtensions()->parseElement($this, $item);
                }

                return $result;
            }
        );
    }

    /**
     * Add new Collection
     *
     * @param string $title
     *
     * @return Collection
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function addCollection($title)
    {
        $collections = $this->getCollections();

        /** @var Collection $collection */
        $collection = $this->getExtensions()->createElement($this, 'app:collection');
        $collection->addTitle($title);

        $collections[] = $collection;
        $this->setCachedProperty('collections', $collections);

        return $collection;
    }

    /**
     * Return root node name.
     *
     * @return string
     *
     * @since 1.0
     */
    protected function getNodeName()
    {
        return 'workspace';
    }
}
