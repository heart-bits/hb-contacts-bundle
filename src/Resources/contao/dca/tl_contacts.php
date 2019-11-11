<?php

$GLOBALS['TL_DCA']['tl_contacts'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        ),
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 2,
            'fields' => array('lastname'),
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label' => array
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
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'icon' => 'visible.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_contacts', 'toggleIcon')
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif',
                'attributes' => 'style="margin-right:3px"'
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array('lastname', 'firstname'),
        'default' => '{person_legend},lastname,firstname,department,birthday,position;{image_legend},singleSRC;{contact_legend},phone,fax,mobile,email,company;{address_legend},geocoderAddress,singleCoords,geocoderCountry;{social_legend:hide},facebook,twitter,xing,linkedin;{expert_legend:hide},invisible;',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),

        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),

        'firstname' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['firstname'],
            'inputType' => 'text',
            'exclude' => true,
            'sorting' => true,
            'flag' => 1,
            'search' => true,
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'lastname' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['lastname'],
            'inputType' => 'text',
            'exclude' => true,
            'sorting' => true,
            'flag' => 1,
            'search' => true,
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'singleSRC' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['singleSRC'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array(
                'filesOnly' => true,
                'fieldType' => 'radio',
                'tl_class' => 'clr',
                'extensions' => Contao\Config::get('validImageTypes')
            ),
            'sql' => "binary(16) NULL"
        ),

        'geocoderAddress' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['geocoderAddress'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''",
            'save_callback' => array
            (
                array('tl_contacts', 'generateCoords')
            )
        ),

        'geocoderCountry' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['geocoderCountry'],
            'exclude' => true,
            'filter' => true,
            'inputType' => 'select',
            'options' => $this->getCountries(),
            'eval' => array(
                'includeBlankOption' => true,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(2) NOT NULL default 'de'"
        ),

        'singleCoords' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['singleCoords'],
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 64,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(64) NOT NULL default ''",
            'save_callback' => array
            (
                array('tl_contacts', 'generateCoords')
            )
        ),

        'phone' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['phone'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'mobile' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['mobile'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'email' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['email'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'company' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['company'],
            'exclude' => true,
            'sorting' => true,
            'flag' => 1,
            'search' => true,
            'sql' => 'int(100) unsigned NULL',
            'foreignKey' => 'tl_companies.CONCAT(title," (",geocoderAddress,")")',
            'inputType' => 'select',
            'eval' => array(
                'includeBlankOption' => true,
                'tl_class' => 'w50'
            )
        ),

        'fax' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['fax'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'position' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['position'],
            'inputType' => 'text',
            'exclude' => true,
            'sorting' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'department' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['department'],
            'exclude' => true,
            'sorting' => true,
            'filter' => true,
            'flag' => 1,
            'search' => true,
            'sql' => 'int(100) unsigned NULL',
            'foreignKey' => 'tl_departments.title',
            'inputType' => 'select',
            'eval' => array(
                'includeBlankOption' => true,
                'tl_class' => 'w50'
            )
        ),

        'birthday' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['birthday'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'rgxp' => 'date',
                'datepicker' => true,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'facebook' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['facebook'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'twitter' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['twitter'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'xing' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['xing'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'linkedin' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['linkedin'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'invisible' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_contacts']['invisible'],
            'exclude' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'sql' => "char(1) NOT NULL default ''"
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

    /**
     * Return the "toggle visibility" button
     *
     * @param array $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (Contao\Input::get('cid')) {
            $this->toggleVisibility(Contao\Input::get('cid'), (Contao\Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;id=' . Contao\Input::get('id') . '&amp;cid=' . $row['id'] . '&amp;state=' . $row['invisible'];

        if ($row['invisible']) {
            $icon = 'invisible.svg';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . Contao\StringUtil::specialchars($title) . '" data-tid="cid"' . $attributes . '>' . Contao\Image::getHtml($icon, $label, 'data-state="' . ($row['invisible'] ? 0 : 1) . '"') . '</a> ';
    }

    /**
     * Toggle the visibility of an element
     *
     * @param integer $intId
     * @param boolean $blnVisible
     * @param Contao\DataContainer $dc
     *
     * @throws Contao\CoreBundle\Exception\AccessDeniedException
     */
    public function toggleVisibility($intId, $blnVisible, Contao\DataContainer $dc = null)
    {
        // Set the ID and action
        Contao\Input::setGet('id', $intId);
        Contao\Input::setGet('act', 'toggle');

        if ($dc) {
            $dc->id = $intId; // see #8043
        }

        // Trigger the onload_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_contacts']['config']['onload_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_contacts']['config']['onload_callback'] as $callback) {
                if (\is_array($callback)) {
                    $this->import($callback[0]);
                    $this->{$callback[0]}->{$callback[1]}($dc);
                } elseif (\is_callable($callback)) {
                    $callback($dc);
                }
            }
        }

        // Set the current record
        if ($dc) {
            $objRow = $this->Database->prepare("SELECT * FROM tl_contacts WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows) {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Contao\Versions('tl_contacts', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_contacts']['fields']['invisible']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_contacts']['fields']['invisible']['save_callback'] as $callback) {
                if (\is_array($callback)) {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
                } elseif (\is_callable($callback)) {
                    $blnVisible = $callback($blnVisible, $dc);
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_contacts SET tstamp=$time, invisible='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
            ->execute($intId);

        if ($dc) {
            $dc->activeRecord->tstamp = $time;
            $dc->activeRecord->invisible = ($blnVisible ? '1' : '');
        }

        // Trigger the onsubmit_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_contacts']['config']['onsubmit_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_contacts']['config']['onsubmit_callback'] as $callback) {
                if (\is_array($callback)) {
                    $this->import($callback[0]);
                    $this->{$callback[0]}->{$callback[1]}($dc);
                } elseif (\is_callable($callback)) {
                    $callback($dc);
                }
            }
        }

        $objVersions->create();
    }
}
