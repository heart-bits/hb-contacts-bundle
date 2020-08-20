<?php


/**
 * Table tl_companies
 */
$GLOBALS['TL_DCA']['tl_companies'] = array
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
            'fields' => array('title'),
            'flag' => 1,
            'panelLayout' => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields' => array('title'),
            'format' => '%s',
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
                'label' => &$GLOBALS['TL_LANG']['tl_companies']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_companies']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'icon' => 'visible.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_companies', 'toggleIcon')
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_companies']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif',
                'attributes' => 'style="margin-right:3px"'
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array('title'),
        'default' => '{company_legend},title,href;{logo_legend},singleSRC;{address_legend},geocoderAddress,geocoderCountry;{contact_legend},phone,fax,mobile,email;{social_legend:hide},facebook,twitter,xing,linkedin;{expert_legend:hide},invisible;',
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

        'title' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'search' => true,
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'href' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'phone' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'mobile' => array
        (
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
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'fax' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'singleSRC' => array
        (
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

        'facebook' => array
        (
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
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'geocoderAddress' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(255) NOT NULL default ''"/*,
            'save_callback' => array(
                array('tl_companies', 'generateCoords')
            )*/
        ),

        'geocoderCountry' => array
        (
            'exclude' => true,
            'inputType' => 'select',
            'options' => $this->getCountries(),
            'eval' => array(
                'includeBlankOption' => true,
                'tl_class' => 'w50 clr'
            ),
            'sql' => "varchar(2) NOT NULL default 'de'"
        ),

        /*'singleCoords' => array
        (
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 64,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(64) NOT NULL default ''",
            'save_callback' => array(
                array('tl_companies', 'generateCoords')
            )
        ),*/

        'invisible' => array
        (
            'exclude' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'sql' => "char(1) NOT NULL default ''"
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
        if (\is_array($GLOBALS['TL_DCA']['tl_companies']['config']['onload_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_companies']['config']['onload_callback'] as $callback) {
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
            $objRow = $this->Database->prepare("SELECT * FROM tl_companies WHERE id=?")
                ->limit(1)
                ->execute($intId);

            if ($objRow->numRows) {
                $dc->activeRecord = $objRow;
            }
        }

        $objVersions = new Contao\Versions('tl_companies', $intId);
        $objVersions->initialize();

        // Reverse the logic (elements have invisible=1)
        $blnVisible = !$blnVisible;

        // Trigger the save_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_companies']['fields']['invisible']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_companies']['fields']['invisible']['save_callback'] as $callback) {
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
        $this->Database->prepare("UPDATE tl_companies SET tstamp=$time, invisible='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
            ->execute($intId);

        if ($dc) {
            $dc->activeRecord->tstamp = $time;
            $dc->activeRecord->invisible = ($blnVisible ? '1' : '');
        }

        // Trigger the onsubmit_callback
        if (\is_array($GLOBALS['TL_DCA']['tl_companies']['config']['onsubmit_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_companies']['config']['onsubmit_callback'] as $callback) {
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
