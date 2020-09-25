<?php

declare(strict_types=1);

namespace Heartbits\ContaoContacts\Models;

use Contao\Model;

/**
 * Reads and writes contacts.
 */
class ContactModel extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $strTable = 'tl_contacts';
}