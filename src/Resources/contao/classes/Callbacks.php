<?php

namespace Heartbits\ContaoContacts;

use Contao\Database;
use Contao\DataContainer;

class Callbacks extends \Backend
{
    /**
     * Get all visible companies
     *
     * @return array
     */
    public function getCompanies(DataContainer $dc)
    {
        $companies = Database::getInstance()->prepare("SELECT id, title FROM tl_companies WHERE country=? AND invisible='' ORDER BY title ASC")->execute($dc->activeRecord->country_select)->fetchAllAssoc();
        $options = array();
        if (!empty($companies) && is_array($companies)) {
            foreach ($companies as $company) {
                $options[$company['id']] = $company['title'];
            }
        }
        return $options;
    }

    /**
     * Get all visible contacts
     *
     * @return array
     */
    public function getContacts(DataContainer $dc)
    {
        if ($dc->activeRecord->department_select) {
            $contacts = Database::getInstance()->prepare("SELECT id, lastname, firstname FROM tl_contacts WHERE pid=? AND department=? AND invisible='' ORDER BY lastname ASC")->execute($dc->activeRecord->company_select, $dc->activeRecord->department_select)->fetchAllAssoc();
        } else {
            $contacts = Database::getInstance()->prepare("SELECT id, lastname, firstname FROM tl_contacts WHERE pid=? AND invisible='' ORDER BY lastname ASC")->execute($dc->activeRecord->company_select)->fetchAllAssoc();
        }
        $options = array();
        if (!empty($contacts) && is_array($contacts)) {
            foreach ($contacts as $contact) {
                $options[$contact['id']] = $contact['lastname'] . ', ' . $contact['firstname'];
            }
        }
        return $options;
    }

    /**
     * Get all visible departments
     *
     * @return array
     */
    public function getDepartments(DataContainer $dc)
    {
        $departments = Database::getInstance()->prepare("SELECT id, title FROM tl_departments WHERE invisible='' ORDER BY title ASC")->execute($dc->activeRecord->company_select)->fetchAllAssoc();
        $options = array();
        if (!empty($departments) && is_array($departments)) {
            foreach ($departments as $department) {
                $options[$department['id']] = $department['title'];
            }
        }
        return $options;
    }
}
