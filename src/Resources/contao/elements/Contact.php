<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Heartbits\Contao\Contacts;


/**
 * Front end content element "contact".
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class Contact extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_contact';

	/**
	 * Return if the image does not exist
	 *
	 * @return string
	 */
	public function generate()
	{
		$contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE id=?")->execute($this->contact_select);

		if ($contactData->singleSRC == '')
		{
			return '';
		}

		$objFile = \FilesModel::findByUuid($contactData->singleSRC);

		if ($objFile === null)
		{
			if (!\Validator::isUuid($contactData->singleSRC))
			{
				return '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
			}

			return '';
		}

		if (!is_file(TL_ROOT . '/' . $objFile->path))
		{
			return '';
		}

		$this->singleSRC = $objFile->path;

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		if (TL_MODE == 'BE')
		{
			$contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE id=?")->execute($this->contact_select);

			$this->Template 												= new \BackendTemplate('be_hb_contact');
			$this->Template->lastname								= $contactData->lastname;
			$this->Template->firstname							= $contactData->firstname;
			$this->addImageToTemplate($this->Template, $this->arrData);
		}
		else {
			// Get database
			$contactData = Database::getInstance()->prepare("SELECT * FROM tl_contacts WHERE id=?")->execute($this->contact_select);

			// Add contact fields
			// Contact image
			$this->Template->addImage								= $contactData->addImage;
			$this->Template->alt										= $contactData->alt;
			$this->Template->title									= $contactData->title;
			$this->size															= deserialize($this->size);
			$this->Template->size										= $this->size[2];
			$this->Template->imagemargin						= $contactData->imagemargin;
			$this->Template->imageUrl								= $contactData->imageUrl;
			$this->Template->caption								= $contactData->caption;
			$this->Template->floating								= $contactData->floating;

			// Contact data
			$this->Template->lastname								= $contactData->lastname;
			$this->Template->firstname							= $contactData->firstname;
			$this->Template->department_en					= $contactData->department_en;
			$this->Template->department_de					= $contactData->department_de;
			$this->Template->position_en						= $contactData->position_en;
			$this->Template->position_de						= $contactData->position_de;
			$this->Template->position_en_secondline	= $contactData->position_en_secondline;
			$this->Template->position_de_secondline	= $contactData->position_de_secondline;
			$this->Template->birthday								= $contactData->birthday;
			$this->Template->phone									= $contactData->phone;
			$this->Template->fax										= $contactData->fax;
			$this->Template->mobile									= $contactData->mobile;
			$this->Template->email									= $contactData->email;
			$this->Template->facebook								= $contactData->facebook;
			$this->Template->googleplus							= $contactData->googleplus;
			$this->Template->twitter								= $contactData->twitter;
			$this->Template->xing										= $contactData->xing;
			$this->Template->linkedin								= $contactData->linkedin;

			// Contact address ccordinates
			$contactData->geocoderAddress						= explode(',', $contactData->geocoderAddress);
			$this->Template->street									= ltrim($contactData->geocoderAddress[0]);
			$contactData->geocoderAddressLocation		= ltrim($contactData->geocoderAddress[1]);
			$contactData->geocoderAddressLocation		= explode(' ', $contactData->geocoderAddressLocation);
			$this->Template->zip										= $contactData->geocoderAddressLocation[0];
			$this->Template->location								= $contactData->geocoderAddressLocation[1];

			$contactData->singleCoords							= explode(',', $contactData->singleCoords);
			$this->Template->coordsLat							= $contactData->singleCoords[0];
			$this->Template->coordsLong							= $contactData->singleCoords[1];

			// Get database
			$companyData = Database::getInstance()->prepare("SELECT * FROM tl_companies WHERE id=?")->execute($contactData->company);

			// Add company fields
			$this->Template->companyRaw							= $companyData;
			$this->Template->company								= $companyData->company;
			$this->Template->company_phone					= $companyData->company_phone;
			$this->Template->company_fax						= $companyData->company_fax;
			$this->Template->company_mobile					= $companyData->company_mobile;
			$this->Template->company_email					= $companyData->company_email;
			$this->Template->company_facebook				= $companyData->company_facebook;
			$this->Template->company_googleplus			= $companyData->company_googleplus;
			$this->Template->company_twitter				= $companyData->company_twitter;
			$this->Template->company_xing						= $companyData->company_xing;
			$this->Template->company_linkedin				= $companyData->company_linkedin;

			// Company address ccordinates
			$companyData->geocoderAddress						= explode(',', $companyData->geocoderAddress);
			$this->Template->companyStreet					= ltrim($companyData->geocoderAddress[0]);
			$companyData->geocoderAddressLocation		= ltrim($companyData->geocoderAddress[1]);
			$companyData->geocoderAddressLocation		= explode(' ', $companyData->geocoderAddressLocation);
			$this->Template->companyZip							= $companyData->geocoderAddressLocation[0];
			$this->Template->companyLocation				= $companyData->geocoderAddressLocation[1];

			$companyData->singleCoords							= explode(',', $companyData->singleCoords);
			$this->Template->companyCoordsLat				= $companyData->singleCoords[0];
			$this->Template->companyCoordsLong			= $companyData->singleCoords[1];


			$this->addImageToTemplate($this->Template, $this->arrData);
		}
	}
}
