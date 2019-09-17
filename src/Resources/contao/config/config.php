<?php

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['contacts'] = array(
    'tables' => array('tl_contacts')
);

$GLOBALS['BE_MOD']['content']['departments'] = array(
    'tables' => array('tl_departments')
);

$GLOBALS['BE_MOD']['content']['companies'] = array(
    'tables' => array('tl_companies')
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
