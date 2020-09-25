<?php

namespace Heartbits\ContaoContacts;

use Contao\ContentElement;
use Contao\BackendTemplate;
use Contao\System;
use Contao\FilesModel;
use Contao\StringUtil;
use Heartbits\ContaoContacts\Models\CompaniesModel;
use Heartbits\ContaoContacts\Models\ContactsModel;
use Heartbits\ContaoContacts\Models\DepartmentsModel;

class Contact extends ContentElement
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
            $arrColumns = array
            (
                'tl_contacts.department=?',
                'tl_contacts.pid=?',
                'tl_contacts.invisible=?',
            );
            $arrValues = array
            (
                $this->department_select,
                $this->company_select,
                '',
            );
            $arrOptions = array
            (
                'order' => 'tl_contacts.lastname ASC',
            );
        } elseif (!$this->useSingleContact && $this->company_select) {
            $arrColumns = array
            (
                'tl_contacts.pid=?',
                'tl_contacts.invisible=?',
            );
            $arrValues = array
            (
                $this->company_select,
                '',
            );
            $arrOptions = array
            (
                'order' => 'tl_contacts.lastname ASC',
            );
        } elseif($this->useSingleContact && $this->contact_select) {
            $arrColumns = array
            (
                'tl_contacts.id=?',
                'tl_contacts.invisible=?',
            );
            $arrValues = array
            (
                $this->contact_select,
                '',
            );
            $arrOptions = array
            (
                'order' => 'tl_contacts.lastname ASC',
            );
        }
        $objContact = ContactsModel::findBy($arrColumns, $arrValues, $arrOptions);

        // Push selected Contact/s to template
        if (TL_MODE == 'BE') {
            $this->Template = new BackendTemplate('be_wildcard');
            $title = '';
            if (null !== $objContact) {
                $contactCount = $objContact->count();
                $i = 1;
                while ($objContact->next()) {
                    if ($contactCount === $i) {
                        $title .= $objContact->firstname . ' ' . $objContact->lastname . '<br>';
                    } else {
                        $title .= $objContact->firstname . ' ' . $objContact->lastname . ',<br>';
                    }
                    $i++;
                }
            }
            $this->Template->title = $title;
        } else {
            $container = System::getContainer();
            $rootDir = $container->getParameter('kernel.project_dir');
            System::loadLanguageFile('tl_contacts');
            $arrContacts = [];
            if (null !== $objContact) {
                $i = 0;
                while ($objContact->next()) {
                    foreach ($objContact->row() as $key => $value) {
                        if ($key === 'department') {
                            $objDepartment = DepartmentsModel::findById($value);
                            $arrContacts[$i][$key] = $objDepartment->title;
                        } elseif ($key === 'pid') {
                            $objCompany = CompaniesModel::findById($value);
                            $arrContacts[$i][$key] = $objCompany->title;
                            $arrContacts[$i]['company_href'] = $objCompany->href;
                        } elseif ($key === 'country') {
                            System::loadLanguageFile('countries');
                            $arrContacts[$i][$key] = $GLOBALS['TL_LANG']['CNT'][$value];
                        } elseif ($key === 'singleSRC') {
                            if ($value !== '') {
                                $objFile = FilesModel::findByUuid($value);
                                $path = $objFile->path;
                                if ($objFile !== null || is_file(System::getContainer()->getParameter('kernel.project_dir') . '/' . $path)) {
                                    $picture = $container
                                        ->get('contao.image.picture_factory')
                                        ->create($rootDir . '/' . $path, StringUtil::deserialize($this->size)[2]);
                                    $data = [
                                        'picture' => [
                                            'img' => $picture->getImg($rootDir),
                                            'sources' => $picture->getSources($rootDir),
                                        ]
                                    ];
                                    $arrContacts[$i][$key] = $data;
                                }
                            }
                        } else {
                            $arrContacts[$i][$key] = $value;
                        }
                    }
                    $i++;
                }
                $this->Template->contacts = $arrContacts;
            }
        }
    }
}
