<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  Sascha Wustmann 2014
 * @package    AnimateElements
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['contact'] = '{type_legend},type,contact_select,alt_title,size;{animate_element},animate_switch,parallax_switch;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['contact_select'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['contact_select'],
	'exclude' => true,
	'sorting'   => true,
	'flag'      => 1,
	'search'    => true,
	'sql' => 'int(100) unsigned NULL',
	'foreignKey' => 'tl_contacts.CONCAT(lastname," ", firstname)',
	'inputType'	=> 'select',
	'eval' => array('includeBlankOption' => true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['alt_title'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['alt_title'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
