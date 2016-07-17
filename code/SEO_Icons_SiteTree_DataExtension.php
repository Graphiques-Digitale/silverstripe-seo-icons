<?php

/**
 * @todo Description
 *
 * @package silverstripe-seo
 * @subpackage icons
 * @author Andrew Gerber <atari@graphiquesdigitale.net>
 * @version 1.0.0
 *
 */
class SEO_Icons_SiteTree_DataExtension extends DataExtension
{


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
     * Updates metadata with icons.
     *
     * @param SiteConfig $config
     * @param SiteTree $owner
     * @param $metadata
     *
     * @return void
     */
    public function updateMetadata(SiteConfig $config, SiteTree $owner, &$metadata)
    {

        //// HTML4 Favicon

        // @todo Perhaps create dynamic image, but just use favicon.ico for now

        //// Create Favicons

        $HTML5Favicon = $config->HTML5Favicon();
        $IOSPinicon = $config->IOSPinicon();
        $AndroidPinicon = $config->AndroidPinicon();
        $WindowsPinicon = $config->WindowsPinicon();

        //// iOS Pinicon

        if ($IOSPinicon->exists()) {
            $this->GenerateIOSPinicon($config, $owner, $metadata, $IOSPinicon);
        }

        //// HTML5 Favicon

        if ($HTML5Favicon->exists()) {
            $this->GenerateHTML5Favicon($owner, $metadata, $HTML5Favicon);
        }

        //// Android Pinicon Manifest

        if ($AndroidPinicon->exists()) {
            $this->GenerateAndroidPinicon($config, $owner, $metadata);
        }

        //// Windows Pinicon Manifest

        if ($WindowsPinicon->exists()) {
            $this->GenerateWindowsPinicon($config, $owner, $metadata, $WindowsPinicon);
        }

    }

    /**
     * Generates markup for the iOS pinicon
     *
     * @param SiteConfig $config
     * @param SiteTree $owner
     * @param string $metadata
     * @param Image $IOSPinicon
     *
     * @return void
     */
    protected function GenerateIOSPinicon(SiteConfig $config, SiteTree $owner, &$metadata, Image $IOSPinicon) {

        // header
        $metadata .= $this->owner->MarkupComment('iOS Pinned Icon');

        //// iOS Pinicon Title
        if ($config->fetchPiniconTitle()) {
            $metadata .= $owner->MarkupMeta('apple-mobile-web-app-title', $config->fetchPiniconTitle());
        }

        //// iOS Pinned Icon

        // For non-Retina (@1× display) iPhone, iPod Touch, and Android 2.1+ devices
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(57, 57)->getAbsoluteURL(), 'image/png'); // 57×57

        // @todo: What is this for ??
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(60, 60)->getAbsoluteURL(), 'image/png', '60x60');

        // For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(72, 72)->getAbsoluteURL(), 'image/png', '72x72');

        // For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(76, 76)->getAbsoluteURL(), 'image/png', '76x76');

        // For iPhone with @2× display running iOS ≤ 6
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(114, 114)->getAbsoluteURL(), 'image/png', '114x114');

        // For iPhone with @2× display running iOS ≥ 7
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(120, 120)->getAbsoluteURL(), 'image/png', '120x120');

        // For iPad with @2× display running iOS ≤ 6
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(144, 144)->getAbsoluteURL(), 'image/png', '144x144');

        // For iPad with @2× display running iOS ≥ 7
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(152, 152)->getAbsoluteURL(), 'image/png', '152x152');

        // For iPhone 6 Plus with @3× display
        $metadata .= $owner->MarkupLink('apple-touch-icon', $IOSPinicon->Fill(180, 180)->getAbsoluteURL(), 'image/png', '180x180');

    }

    /**
     * Generates markup for the HTML5 favicon
     *
     * @param SiteTree $owner
     * @param string $metadata
     * @param Image $HTML5Favicon
     *
     * @return void
     */
    protected function GenerateHTML5Favicon(SiteTree $owner, &$metadata, Image $HTML5Favicon) {

        // header
        $metadata .= $owner->MarkupComment('HTML5 Favicon');

//			// Android Chrome 32
        // @todo: Is the Android Chrome 32 196x196 px icon fully redundant ??
//			$metadata .= $owner->MarkupLink('icon', $HTML5Favicon->Fill(196,196)->getAbsoluteURL(), 'image/png', '196x196');

        // Android Chrome 37+ / HTML5 spec
        $metadata .= $owner->MarkupLink('icon', $HTML5Favicon->Fill(192, 192)->getAbsoluteURL(), 'image/png', '192x192');

        // Android Chrome 37+ / HTML5 spec
        $metadata .= $owner->MarkupLink('icon', $HTML5Favicon->Fill(128, 128)->getAbsoluteURL(), 'image/png', '128x128');

        // For Google TV
        $metadata .= $owner->MarkupLink('icon', $HTML5Favicon->Fill(96, 96)->getAbsoluteURL(), 'image/png', '96x96');

        // For Safari on Mac OS
        $metadata .= $owner->MarkupLink('icon', $HTML5Favicon->Fill(32, 32)->getAbsoluteURL(), 'image/png', '32x32');

        // The classic favicon, displayed in the tabs
        $metadata .= $owner->MarkupLink('icon', $HTML5Favicon->Fill(16, 16)->getAbsoluteURL(), 'image/png', '16x16');

    }

    /**
     * Generates markup for the Android pinicon
     *
     * @param SiteConfig $config
     * @param SiteTree $owner
     * @param $metadata
     *
     * @return void
     */
    protected function GenerateAndroidPinicon(SiteConfig $config, SiteTree $owner, &$metadata) {

        // header
        $metadata .= $owner->MarkupComment('Android Pinned Icon');

        //
        if ($config->fetchAndroidPiniconThemeColor()) {
            $metadata .= $owner->MarkupMeta('theme-color', $config->fetchAndroidPiniconThemeColor());
        }

        //
        $metadata .= $owner->MarkupLink('manifest', '/manifest.json');

    }

    /**
     * Generates markup for the Windows pinicon
     *
     * @param SiteConfig $config
     * @param SiteTree $owner
     * @param $metadata
     * @param Image $WindowsPinicon
     *
     * @return void
     */
    protected function GenerateWindowsPinicon(SiteConfig $config, SiteTree $owner, &$metadata, Image $WindowsPinicon) {

        // header
        $metadata .= $owner->MarkupComment('Windows Pinned Icon');

        // application name
        $appName = $config->fetchPiniconTitle();
        if (!$appName) {
            $appName = $config->Title;
        }
        $metadata .= $owner->MarkupMeta('application-name', $appName);

        // tile background color
        if ($config->fetchWindowsPiniconBackgroundColor()) {
            $metadata .= $owner->MarkupMeta('msapplication-TileColor', $config->fetchWindowsPiniconBackgroundColor());
        }

        // small tile
        $metadata .= $owner->MarkupMeta('msapplication-square70x70logo', $WindowsPinicon->Fill(70, 70)->getAbsoluteURL());

        // medium tile
        $metadata .= $owner->MarkupMeta('msapplication-square150x150logo', $WindowsPinicon->Fill(150, 150)->getAbsoluteURL());

        // @todo: Implement wide & tall tiles

        // wide tile
//			$metadata .= $owner->MarkupMeta('msapplication-square310x150logo', $WindowsPinicon->Fill(310,150)->getAbsoluteURL());

        // large tile
//			$metadata .= $owner->MarkupMeta('msapplication-square310x310logo', $WindowsPinicon->Fill(310,310)->getAbsoluteURL());

    }

}
