<?php
/**
 * Atom Publishing Protocol support
 *
 * @author  Михаил Красильников <m.krasilnikov@yandex.ru>
 * @license MIT
 */
namespace Mekras\AtomPub;

use Mekras\Atom\Atom;
use Mekras\AtomPub\Extension\AtomPubDocuments;

/**
 * XML to AtomPub Document converter.
 *
 * @since 1.0
 *
 * @api
 * @link  https://tools.ietf.org/html/rfc5023
 */
class AtomPub extends Atom
{
    /**
     * AtomPub namespace
     *
     * @since 1.0
     */
    const NS = 'http://www.w3.org/2007/app';

    /**
     * AtomPub constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->registerDocumentType(new AtomPubDocuments());
    }
}
