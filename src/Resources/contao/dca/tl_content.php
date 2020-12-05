<?php

/**
 * Palettes
 */
array_push($GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'], 'useSingleCompany', 'useSingleContact');
$GLOBALS['TL_DCA']['tl_content']['palettes']['contact'] = '{type_legend},type,company_select,department_select,useSingleContact,size;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['company'] = '{type_legend},type,country_select,useSingleCompany,size;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['useSingleContact'] = 'contact_select';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['useSingleCompany'] = 'company_select';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['department_select'] = array
(
    'exclude' => true,
    'options_callback' => array('Heartbits\ContaoContacts\Callbacks', 'getDepartments'),
    'inputType' => 'select',
    'eval' => array(
        'submitOnChange'=>true,
        'includeBlankOption' => true,
        'tl_class' => 'w50'
    ),
    'sql' => 'int(100) unsigned NULL',
);

$GLOBALS['TL_DCA']['tl_content']['fields']['useSingleContact'] = array
(
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array(
        'submitOnChange'=>true,
        'tl_class' => 'clr'
    ),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['contact_select'] = array
(
    'exclude' => true,
    'options_callback' => array('Heartbits\ContaoContacts\Callbacks', 'getContacts'),
    'inputType' => 'select',
    'eval' => array(
        'mandatory' => true,
        'tl_class' => 'w50 clr'
    ),
    'sql' => 'int(100) unsigned NULL'
);

$GLOBALS['TL_DCA']['tl_content']['fields']['country_select'] = array
(
    'exclude' => true,
    'sql' => "varchar(2) NOT NULL default 'de'",
    'options' => $this->getCountries(),
    'inputType' => 'select',
    'eval' => array(
        'submitOnChange'=>true,
        'includeBlankOption' => true,
        'tl_class' => 'w50 clr'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['useSingleCompany'] = array
(
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array(
        'submitOnChange'=>true,
        'tl_class' => 'clr',
        'submitOnChange' => true
    ),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['company_select'] = array
(
    'exclude' => true,
    'sql' => 'int(100) unsigned NULL',
    'options_callback' => array('Heartbits\ContaoContacts\Callbacks', 'getCompanies'),
    'inputType' => 'select',
    'eval' => array(
        'submitOnChange'=>true,
        'mandatory' => true,
        'tl_class' => 'w50 clr'
    )
);
