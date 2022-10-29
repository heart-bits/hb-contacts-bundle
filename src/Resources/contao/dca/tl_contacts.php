<?php

$GLOBALS['TL_DCA']['tl_contacts'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'ptable' => 'tl_companies',
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
            'mode' => 4,
            'fields' => array('lastname'),
            'panelLayout' => 'filter;search,limit',
            'headerFields' => array('title'),
            'child_record_callback' => array('tl_contacts', 'listContacts'),
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
            'departments' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['department_legend'],
                'href' => 'table=tl_departments',
                'icon' => 'bundles/heartbitscontaocontacts/bookmarks.svg',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="c"',
            ),
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
                'icon' => 'edit.svg'
            ),
            'copy' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['copy'],
                'href' => 'act=paste&amp;mode=copy',
                'icon' => 'copy.svg',
                'attributes' => 'onclick="Backend.getScrollOffset()"'
            ),
            'cut' => array
            (
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.svg'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . (isset($GLOBALS['TL_LANG']['MSC']['deleteConfirm']) ? $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] : null) . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contacts']['toggle'],
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
        'default' => '{person_legend},lastname,firstname,department,birthday,position;{image_legend},singleSRC;{contact_legend},phone,fax,mobile,email;{address_legend},street,zip,city,country;{social_legend:hide},facebook,twitter,xing,linkedin;{expert_legend:hide},invisible;',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),

        'pid' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ),

        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),

        'firstname' => array
        (
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

        'street' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'zip' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "CHAR(5) NOT NULL default ''"
        ),

        'city' => array
        (
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array(
                'maxlength' => 255,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'country' => array
        (
            'exclude' => true,
            'filter' => true,
            'inputType' => 'select',
            'options' => $this->getCountries(),
            'eval' => array(
                'includeBlankOption' => true,
                'tl_class' => 'w50'
            ),
            'sql' => "varchar(2) NOT NULL default 'de'"
        ),

        'phone' => array
        (
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

        'position' => array
        (
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

    /**
     * List a contact
     *
     * @param array $arrRow
     *
     * @return string
     */
    public function listContacts($arrRow)
    {
        return '<div class="tl_content_left">' . $arrRow['lastname'] . ', ' . $arrRow['firstname'] . '</div>';
    }
}
