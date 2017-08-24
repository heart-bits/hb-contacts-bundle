<?php


/**
 * Table tl_companies
 */
$GLOBALS['TL_DCA']['tl_companies'] = array
(

	// Config
	'config'   => array
	(
		'dataContainer'    => 'Table',
		'enableVersioning' => true,
		'sql'              => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),
	// List
	'list'     => array
	(
		'sorting'           => array
		(
			'mode'        => 2,
			'fields'      => array('company'),
			'flag'        => 1,
			'panelLayout' => 'filter;sort,search,limit'
		),
		'label'             => array
		(
			'fields' => array('company'),
			'format' => '%s',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations'        => array
		(
			'edit'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_companies']['edit'],
				'href'  => 'act=edit',
				'icon'  => 'edit.gif'
			),
			'delete' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_companies']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show'   => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_companies']['show'],
				'href'       => 'act=show',
				'icon'       => 'show.gif',
				'attributes' => 'style="margin-right:3px"'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'  => array('company'),
		'default'       => '{company_legend},company,geocoderAddress,singleCoords,geocoderCountry,company_phone,company_fax,company_mobile,company_email;{company_social:hide},company_facebook,company_googleplus,company_twitter,company_xing,company_linkedin;',
	),

	// Subpalettes
	'subpalettes' => array
	(

	),

	// Fields
	'fields'   => array
	(
		'id'     => array
		(
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		),

		'tstamp' => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),

		'company'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company'],
			'inputType' => 'text',
			'exclude'   => true,
			'sorting'   => true,
			'search'    => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_phone'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_phone'],
			'inputType' => 'text',
			'exclude'   => true,
			'sorting'   => true,
			'flag'      => 1,
			'search'    => true,
			'eval'      => array(
				'mandatory' => true,
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_mobile'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_mobile'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_email'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_email'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_fax'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_fax'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_facebook'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_facebook'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_googleplus'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_googleplus'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_twitter'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_twitter'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_xing'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_xing'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company_linkedin'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['company_linkedin'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'geocoderAddress'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_companies']['address'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''",
			'save_callback' => array
			(
				array('tl_contacts', 'generateCoords')
			)
		),

		'geocoderAddress' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_companies']['geocoderAddress'],
				'exclude'                 => true,
				'search'                  => true,
				'inputType'               => 'text',
				'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50 clr'),
				'sql'                     => "varchar(255) NOT NULL default ''"
		),

		'geocoderCountry' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_companies']['geocoderCountry'],
				'exclude'                 => true,
				'filter'                  => true,
				'inputType'               => 'select',
				'options'                 => $this->getCountries(),
				'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
				'sql'                     => "varchar(2) NOT NULL default 'de'"
		),

		'singleCoords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_companies']['singleCoords'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''",
						'save_callback' => array
						(
								array('tl_companies', 'generateCoords')
						)
		),
	)
);

/**
 * Class tl_companies
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2015 Sascha Wustmann
 * @author     Sascha Wustmann <http://saschawustmann.com>
 * @package
 */
class tl_companies extends \Backend
{

	/**
	 * Get geo coodinates from address
	 * @param string
	 * @param object
	 * @return string
	 */
	function generateCoords($varValue, DataContainer $dc)
	{
			return $varValue ? $varValue : \delahaye\GeoCode::getCoordinates($dc->activeRecord->geocoderAddress, $dc->activeRecord->geocoderCountry, 'de');
	}
}
