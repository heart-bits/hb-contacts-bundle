<?php

namespace Heartbits\ContaoContacts;

use Contao\ContentElement;
use Contao\Database;
use Contao\BackendTemplate;
use Contao\System;
use Contao\FilesModel;
use Contao\StringUtil;

class Company extends ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_company';


    /**
     * Generate the content element
     */
    protected function compile()
    {
        // Get selected Company/ies from template
        if ($this->useSingleCompany && $this->company_select) {
            $companyData = Database::getInstance()->prepare("SELECT * FROM tl_companies WHERE id=? AND invisible=''")->limit(1)->execute($this->company_select)->fetchAllAssoc();
        } else {
            $companyData = Database::getInstance()->prepare("SELECT * FROM tl_companies WHERE country=? AND invisible=''")->execute($this->country_select)->fetchAllAssoc();
        }

        // Push selected Company/ies to template
        if (TL_MODE == 'BE') {
            $this->Template = new BackendTemplate('be_wildcard');
            $title = '';
            if (!empty($companyData)) {
                $companyCount = count($companyData);
                $i = 1;
                foreach ($companyData as $company) {
                    if ($companyCount === $i) {
                        $title .= $company['title'] . ' (' . $company['street'] . ', ' . $company['zip'] . $company['city'] . ')';
                    } else {
                        $title .= $company['title'] . ' (' . $company['street'] . ', ' . $company['zip'] . $company['city'] . '),<br>';
                    }
                    $i++;
                }
            }
            $this->Template->title = $title;
        } else {
            $container = System::getContainer();
            $rootDir = $container->getParameter('kernel.project_dir');
            System::loadLanguageFile('tl_companies');
            $arrCompanies = [];
            if (!empty($companyData)) {
                $i = 0;
                foreach ($companyData as $company) {
                    foreach ($company as $key => $value) {
                        if ($key === 'country') {
                            System::loadLanguageFile('countries');
                            $arrCompanies[$i][$key] = $GLOBALS['TL_LANG']['CNT'][$value];
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
                                    $arrCompanies[$i][$key] = $data;
                                }
                            }
                        } else {
                            $arrCompanies[$i][$key] = $value;
                        }
                    }
                    $i++;
                }
                $this->Template->size = StringUtil::deserialize($this->size)[2];
                $this->Template->companies = $arrCompanies;
            }
        }
    }
}
