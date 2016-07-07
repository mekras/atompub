<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub\Document;

use Mekras\AtomPub\Element\Workspace;

/**
 * Service Document.
 *
 * @since 1.0
 *
 * @link  https://tools.ietf.org/html/rfc5023#section-8
 */
class ServiceDocument extends Document
{
    /**
     * Return workspaces.
     *
     * @return Workspace[]
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function getWorkspaces()
    {
        return $this->getCachedProperty(
            'workspaces',
            function () {
                $workspaces = [];
                $items = $this->getDomElement()->getElementsByTagNameNS($this->ns(), 'workspace');
                foreach ($items as $item) {
                    $workspaces[] = $this->getExtensions()->parseElement($item);
                }

                return $workspaces;
            }
        );
    }

    /**
     * Add workspace to document.
     *
     * @param string $title
     *
     * @return Workspace
     *
     * @throws \InvalidArgumentException
     *
     * @since 1.0
     */
    public function addWorkspace($title)
    {
        $workspaces = $this->getWorkspaces();

        /** @var Workspace $workspace */
        $workspace = $this->getExtensions()->createElement($this, 'workspace');
        $workspace->setTitle($title);

        $workspaces[] = $workspace;
        $this->setCachedProperty('workspaces', $workspaces);

        return $workspace;
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
        return 'service';
    }
}
