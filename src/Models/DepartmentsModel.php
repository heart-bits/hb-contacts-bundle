<?php

declare(strict_types=1);

namespace Heartbits\ContaoContacts\Models;

use Contao\Model;

/**
 * Reads and writes departments.
 */
class DepartmentsModel extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $strTable = 'tl_departments';
}