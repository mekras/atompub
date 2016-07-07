<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub;

use Mekras\Atom\DocumentFactory as BaseDocumentFactory;
use Mekras\AtomPub\Extension\AtomPubExtension;

/**
 * XML to AtomPub Document converter.
 *
 * @since 1.0
 *
 * @api
 */
class DocumentFactory extends BaseDocumentFactory
{
    /**
     * Create new factory.
     */
    public function __construct()
    {
        parent::__construct();
        $this->getExtensions()->register(new AtomPubExtension());
    }
}
