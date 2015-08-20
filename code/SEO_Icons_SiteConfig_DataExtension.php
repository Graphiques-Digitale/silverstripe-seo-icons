<?php

/**
 * SEO_Icons_SiteConfig_DataExtension
 *
 * @todo add description
 *
 * @package silverstripe-seo
 * @subpackage icons
 * @author Andrew Gerber <atari@graphiquesdigitale.net>
 * @version 1.0.0
 *
 * @todo lots
 *
 */

class SEO_Icons_SiteConfig_DataExtension extends DataExtension {


	/* Overload Model
	------------------------------------------------------------------------------*/

	private static $db = array(
		// Favicon background for M$-IE
		'FaviconBG' => 'Varchar(6)',
	);
	private static $has_one = array(
		// Favicon
		'FaviconPNG' => 'Image',
		// Touch Icon
		'TouchIcon' => 'Image',
	);


	/* Overload Methods
	------------------------------------------------------------------------------*/

	// CMS Fields
	public function updateCMSFields(FieldList $fields) {

		// owner
		$owner = $this->owner;

		// SSSEO Tabset
// 		$fields->addFieldToTab('Root', new TabSet('SEO'));

		//// Favicon

		$tab = 'Root.SEO.Favicon';

		// ICO
		if (Director::fileExists('favicon.ico')) {
			$fields->addFieldsToTab($tab, array(
				ReadonlyField::create('ReadonlyFaviconICO', 'Favicon ICO', 'favicon.ico found')
					->addExtraClass('success')
			));
		} else {
			$fields->addFieldsToTab($tab, array(
				ReadonlyField::create('ReadonlyFaviconICO', 'Favicon ICO', 'favicon.ico not found')
					->addExtraClass('error')
			));
		}

		// PNG
		$fields->addFieldsToTab($tab, array(
			UploadField::create('FaviconPNG', 'Favicon PNG')
				->setAllowedExtensions(array('png'))
				->setFolderName('SiteConfig/seo-icons/')
				->setDescription('file format: PNG' . '<br />' . 'pixel dimensions: 152 x 152'),
			TextField::create('FaviconBG', 'IE10 Tile Background')
				->setAttribute('placeholder', $owner->faviconBGDefault())
				->setAttribute('size', 6)
				->setMaxLength(6)
				->setDescription('format: hexadecimal triplet<br />character limit: 6')
		));

		//// Touch Icon

		$tab = 'Root.SEO.TouchIcon';

		$fields->addFieldsToTab($tab, array(
			ReadonlyField::create('AppleTouchIconPrecomposed', 'apple-touch-icon-precomposed', 'on'),
			UploadField::create('TouchIcon', 'Touch Icon')
				->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'))
				->setFolderName('SiteConfig/seo-icons/')
				->setDescription('file format: JPG, PNG, GIF<br />pixel dimensions: 400 x 400 (recommended, minimum 192)<br />pixel ratio: 1:1')
		));

	}

}