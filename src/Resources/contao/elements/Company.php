<?php

namespace Heartbits\ContaoContacts;

use Contao\ContentElement;
use Contao\BackendTemplate;
use Contao\System;
use Contao\FilesModel;
use Contao\StringUtil;
use Heartbits\ContaoContacts\Models\CompaniesModel;

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
            $arrColumns = array
            (
                'tl_companies.id=?',
                'tl_companies.invisible=?',
            );
            $arrValues = array
            (
                $this->company_select,
                '',
            );
            $arrOptions = array
            (
                'order' => 'tl_companies.title ASC',
                'limit' => 1
            );
        } else {
            $arrColumns = array
            (
                'tl_companies.country=?',
                'tl_companies.invisible=?',
            );
            $arrValues = array
            (
                $this->country_select,
                '',
            );
            $arrOptions = array
            (
                'order' => 'tl_companies.title ASC',
            );
        }
        $objCompany = CompaniesModel::findBy($arrColumns, $arrValues, $arrOptions);

        // Push selected Company/ies to template
        if (TL_MODE == 'BE') {
            $this->Template = new BackendTemplate('be_wildcard');
            $title = '';
            if (null !== $objCompany) {
                $companyCount = $objCompany->count();
                $i = 1;
                while ($objCompany->next()) {
                    if ($companyCount === $i) {
                        $title .= '[' . $i . '] ' . $objCompany->title . ' (' . $objCompany->street . ', ' . $objCompany->zip . ' ' . $objCompany->city . ')';
                    } else {
                        $title .= '[' . $i . '] ' . $objCompany->title . ' (' . $objCompany->street . ', ' . $objCompany->zip . ' ' . $objCompany->city . '),<br>';
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
            if (null !== $objCompany) {
                $i = 0;
                while ($objCompany->next()) {
                    foreach ($objCompany->row() as $key => $value) {
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
