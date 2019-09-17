<?php

namespace Heartbits\ContaoContacts;

use Contao\Database;

class Contact extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_contact';


    /**
     * Generate the content element
     */
    protected function compile()
    {
        // Get selected Contact/s from database
        if (!$this->useSingleContact && $this->department_select && $this->company_select) {
            $contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE department=? AND company=? AND invisible=''")->execute($this->department_select, $this->company_select)->fetchAllAssoc();
        } elseif (!$this->useSingleContact && $this->department_select) {
            $contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE department=? AND invisible=''")->execute($this->department_select)->fetchAllAssoc();
        } elseif (!$this->useSingleContact && $this->company_select) {
            $contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE company=? AND invisible=''")->execute($this->company_select)->fetchAllAssoc();
        } elseif($this->useSingleContact && $this->contact_select) {
            $contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE id=? AND invisible=''")->execute($this->contact_select)->fetchAllAssoc();
        }

        // Push selected Contact/s to template
        if (TL_MODE == 'BE') {
            $this->Template = new \BackendTemplate('be_wildcard');
            $title = '';
            if (!empty($contactData)) {
                $contactCount = count($contactData);
                $i = 1;
                foreach ($contactData as $contact) {
                    if ($contactCount === $i) {
                        $title .= $contact['firstname'] . ' ' . $contact['lastname'] . '<br>';
                    } else {
                        $title .= $contact['firstname'] . ' ' . $contact['lastname'] . ',<br>';
                    }
                    $i++;
                }
            }
            $this->Template->title = $title;
        } else {
            \System::loadLanguageFile('tl_contacts');
            $arrContacts = [];
            if (!empty($contactData)) {
                $i = 0;
                foreach ($contactData as $contact) {
                    foreach ($contact as $key => $value) {
                        if ($key === 'department') {
                            $department = Database::getInstance()->prepare("SELECT title FROM tl_departments WHERE id=? AND invisible=''")->execute($value);
                            $arrContacts[$i][$key] = $department->title;
                        } elseif ($key === 'company') {
                            $company = Database::getInstance()->prepare("SELECT title FROM tl_companies WHERE id=? AND invisible=''")->execute($value);
                            $arrContacts[$i][$key] = $company->title;
                        } elseif ($key === 'geocoderCountry') {
                            \System::loadLanguageFile('countries');
                            $arrContacts[$i][$key] = $GLOBALS['TL_LANG']['CNT'][$value];
                        } else {
                            $arrContacts[$i][$key] = $value;
                        }
                    }
                    $i++;
                }
                $this->Template->size = \Contao\StringUtil::deserialize($this->size)[2];
                $this->Template->contacts = $arrContacts;
            }
        }
    }
}
