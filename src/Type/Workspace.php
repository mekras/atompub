<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Type;

use Mekras\AtomPub\Atom\Element\Traits\Title;

/**
 * Workspace.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc5023#section-8.3.2
 */
class Workspace extends Element
{
    use Title;

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
                    $result[] = new Collection($item);
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

        $collection = new Collection($this);
        $collection->setTitle($title);

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
