<?php

/**
 * SEO_Icons_SiteTree_DataExtension
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

class SEO_Icons_SiteTree_DataExtension extends DataExtension {


	/* Overload Variable
	------------------------------------------------------------------------------*/

	// none


	/* Overload Methods
	------------------------------------------------------------------------------*/

	// CMS Fields
// 	public function updateCMSFields(FieldList $fields) {}


	/* Template Methods
	------------------------------------------------------------------------------*/

	/**
	 * @name updateMetadata
	 */
	public function updateMetadata(&$metadata, $owner, $config) {

		// variables
// 		$config = SiteConfig::current_site_config();
// 		$owner = $this->owner;

		//// Favicon

		$ico = Director::fileExists('favicon.ico');

		// PNG + ICO
		if ($config->FaviconPNG()->exists()) {

			//
			$pngURL = $config->FaviconPNG()->SetSize(152, 152)->getAbsoluteURL();
			$pngBG = ($config->FaviconBG) ? $config->FaviconBG : $config->faviconBGDefault();

			//
			$metadata .= $owner->MarkupHeader('Favicon');

			// 1. favicon.png
			$metadata .= $owner->MarkupRel('icon', $pngURL);

			// 2. favicon.ico
			if ($ico) {
				// IE all-but-10
				$metadata .= '<!--[if IE]><link rel="shortcut icon" href="/favicon.ico" /><![endif]-->' . PHP_EOL;
			}

			// IE 10
			$metadata .= $owner->Markup('msapplication-TileColor', $pngBG, false);
			$metadata .= $owner->Markup('msapplication-TileImage', $pngURL, false);

		}

		// ICO only
		else {
			if ($ico) {
				$metadata .= $owner->MarkupHeader('Favicon');
				$metadata .= $owner->MarkupRel('shortcut icon', '/favicon.ico');
			}
		}

		//// Touch Icon

		$image = $config->TouchIcon();

		if ($image->exists()) {

			// variables
			$metadata .= $owner->MarkupHeader('Touch Icon');

			// 192 x 192
// 			$metadata .= '<!-- For Chrome for Android: -->';
			$metadata .= '<link rel="icon" sizes="192x192" href="' . $image->SetSize(192, 192)->getAbsoluteURL() . '">' . PHP_EOL;

			// 180 x 180
// 			$metadata .= '<!-- For iPhone 6 Plus with @3× display: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="180x180" href="' . $image->SetSize(180, 180)->getAbsoluteURL() . '">' . PHP_EOL;

			// 152 x 152
// 			$metadata .= '<!-- For iPad with @2× display running iOS ≥ 7: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="152x152" href="' . $image->SetSize(152, 152)->getAbsoluteURL() . '">' . PHP_EOL;

			// 144 x 144
// 			$metadata .= '<!-- For iPad with @2× display running iOS ≤ 6: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . $image->SetSize(144, 144)->getAbsoluteURL() . '">' . PHP_EOL;

			// 120 x 120
// 			$metadata .= '<!-- For iPhone with @2× display running iOS ≥ 7: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="120x120" href="' . $image->SetSize(120, 120)->getAbsoluteURL() . '">' . PHP_EOL;

			// 114 x 114
// 			$metadata .= '<!-- For iPhone with @2× display running iOS ≤ 6: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . $image->SetSize(114, 114)->getAbsoluteURL() . '">' . PHP_EOL;

			// 76 x 76
// 			$metadata .= '<!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="76x76" href="' . $image->SetSize(76, 76)->getAbsoluteURL() . '">' . PHP_EOL;

			// 72 x 72
// 			$metadata .= '<!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . $image->SetSize(72, 72)->getAbsoluteURL() . '">' . PHP_EOL;

			// 57 x 57
// 			$metadata .= '<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->';
			$metadata .= '<link rel="apple-touch-icon-precomposed" href="' . $image->SetSize(57, 57)->getAbsoluteURL() . '"><!-- 57×57px -->' . PHP_EOL;

		}

		// return
		return $metadata;

	}

}