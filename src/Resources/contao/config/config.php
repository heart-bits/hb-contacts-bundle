<?php

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['companies'] = array(
    'tables' => array('tl_companies', 'tl_contacts', 'tl_departments')
);

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['contact'] = array
(
    'contact'   => 'Heartbits\ContaoContacts\Contact'
);
$GLOBALS['TL_CTE']['company'] = array
(
    'company'   => 'Heartbits\ContaoContacts\Company'
);

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_companies'] = 'Heartbits\ContaoContacts\Models\CompanyModel';
$GLOBALS['TL_MODELS']['tl_contacts'] = 'Heartbits\ContaoContacts\Models\ContactModel';
$GLOBALS['TL_MODELS']['tl_departments'] = 'Heartbits\ContaoContacts\Models\DepartmentModel';
