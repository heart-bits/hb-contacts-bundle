<?php

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['contacts'] = array(
    'tables' => array('tl_contacts')
);

$GLOBALS['BE_MOD']['content']['companies'] = array(
    'tables' => array('tl_companies')
);

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['heart-bits']['contact'] = array
(
    'contact'   => 'Heartbits\Contao\Contacts\Contact'
);
