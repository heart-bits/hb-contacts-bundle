<?php


/**
 * Table tl_contacts
 */
$GLOBALS['TL_DCA']['tl_contacts'] = array
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
			'fields'      => array('lastname'),
			'flag'        => 1,
			'panelLayout' => 'filter;sort,search,limit'
		),
		'label'             => array
		(
			'fields' => array(
				'lastname',
				'firstname',
			),
			'format' => '%s, %s',
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
				'label' => &$GLOBALS['TL_LANG']['tl_contacts']['edit'],
				'href'  => 'act=edit',
				'icon'  => 'edit.gif'
			),
			'delete' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_contacts']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show'   => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_contacts']['show'],
				'href'       => 'act=show',
				'icon'       => 'show.gif',
				'attributes' => 'style="margin-right:3px"'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'  => array('lastname', 'firstname', 'addImage'),
		'default'       => '{person_legend},lastname,firstname,department,birthday,position;{image_legend},addImage;{contact_legend},phone,fax,mobile,email,company;{address_legend},geocoderAddress,singleCoords,geocoderCountry;{social_legend:hide},facebook,googleplus,twitter,xing,linkedin;',
	),

	'subpalettes' => array
	(
		'addImage'                    => 'singleSRC,size,alt',
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

		'firstname'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['firstname'],
			'inputType' => 'text',
			'exclude'   => true,
			'sorting'   => true,
			'flag'      => 1,
			'search'    => true,
			'eval'      => array(
				'mandatory' => true,
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'lastname'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['lastname'],
			'inputType' => 'text',
			'exclude'   => true,
			'sorting'   => true,
			'flag'      => 1,
			'search'    => true,
			'eval'      => array(
				'mandatory' => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'addImage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['addImage'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'clr'),
			'load_callback' => array
			(
				array('tl_contacts', 'setSingleSrcFlags')
			),
			'save_callback' => array
			(
				array('tl_contacts', 'storeFileMetaInformation')
			),
			'sql'                     => "binary(16) NULL"
		),
		'alt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['alt'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),

		'imagemargin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['imagemargin'],
			'exclude'                 => true,
			'inputType'               => 'trbl',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'imageUrl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['imageUrl'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'filesOnly'=>true, 'tl_class'=>'w50 wizard'),
			'wizard' => array
			(
				array('tl_contacts', 'pagePicker')
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['caption'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'allowHtml'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'floating' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['floating'],
			'default'                 => 'above',
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('above', 'left', 'right', 'below'),
			'eval'                    => array('cols'=>4, 'tl_class'=>'w50'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'sql'                     => "varchar(32) NOT NULL default ''"
		),

		'geocoderAddress'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['address'],
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
				'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['geocoderAddress'],
				'exclude'                 => true,
				'search'                  => true,
				'inputType'               => 'text',
				'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50 clr'),
				'sql'                     => "varchar(255) NOT NULL default ''"
		),

		'geocoderCountry' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['geocoderCountry'],
				'exclude'                 => true,
				'filter'                  => true,
				'inputType'               => 'select',
				'options'                 => $this->getCountries(),
				'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
				'sql'                     => "varchar(2) NOT NULL default 'de'"
		),

		'singleCoords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_contacts']['singleCoords'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''",
						'save_callback' => array
						(
								array('tl_contacts', 'generateCoords')
						)
		),

		'phone'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['phone'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'mobile'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['mobile'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'email'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['email'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'company'  => array
		(
			'label'		=> &$GLOBALS['TL_LANG']['tl_contacts']['company'],
			'exclude' => true,
			'sorting'   => true,
			'flag'      => 1,
			'search'    => true,
			'sql' => 'int(100) unsigned NULL',
			'foreignKey' => 'tl_companies.CONCAT(company," (",geocoderAddress,")")',
			'inputType'	=> 'select',
			'eval' => array(
        	'includeBlankOption' => true,
					'tl_class' => 'w50'
			)
		),

		'fax'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['fax'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'position'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['position'],
			'inputType' => 'text',
			'exclude'   => true,
			'sorting'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'department'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['department'],
			'inputType' => 'text',
			'exclude'   => true,
			'sorting'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'birthday'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['birthday'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'maxlength' => 255,
				'rgxp' => 'date',
				'datepicker' => true,
				'tl_class' => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'facebook'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['facebook'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'googleplus'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['googleplus'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'twitter'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['twitter'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'xing'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['xing'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),

		'linkedin'  => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_contacts']['linkedin'],
			'inputType' => 'text',
			'exclude'   => true,
			'eval'      => array(
				'unique'    => true,
				'maxlength' => 255,
				'tl_class'  => 'w50 clr'
			),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
	)
);

/**
 * Class tl_contacts
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2015 Sascha Wustmann
 * @author     Sascha Wustmann <http://saschawustmann.com>
 * @package
 */
class tl_contacts extends \Backend
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

	function pagePicker(DataContainer $dc)
	{
		return ' <a href="' . (($dc->value == '' || strpos($dc->value, '{{link_url::') !== false) ? 'contao/page.php' : 'contao/file.php') . '?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . rawurlencode(str_replace(array('{{link_url::', '}}'), '', $dc->value)) . '&amp;switch=1' . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_'. $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
	}

	public function setSingleSrcFlags($varValue, DataContainer $dc)
	{
		if ($dc->activeRecord)
		{
			switch ($dc->activeRecord->type)
			{
				case 'contact':
					$GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('validImageTypes');
					break;
			}
		}

		return $varValue;
	}

	function storeFileMetaInformation($varValue, DataContainer $dc)
	{
		if ($dc->activeRecord->singleSRC != $varValue)
		{
			$this->addFileMetaInformationToRequest($varValue, ($dc->activeRecord->ptable ?: 'tl_contacts'), $dc->activeRecord->pid);
		}

		return $varValue;
	}
}
