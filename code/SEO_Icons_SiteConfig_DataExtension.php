<?php

/**
 * @todo Description
 *
 * I called them Pinicons & Tabicons in keeping with the absolutely pointless name: Favicons.
 *
 * @package silverstripe-seo
 * @subpackage icons
 * @author Andrew Gerber <atari@graphiquesdigitale.net>
 * @version 1.0.0
 *
 */
class SEO_Icons_SiteConfig_DataExtension extends DataExtension
{


    /* Static Variables
    ------------------------------------------------------------------------------*/

    //
    private static $SEOIconsUpload = 'SEO/SiteConfig/Icons/';

    //
    const APPLE_ICON_DEFAULT_BACKGROUND = '000000';


    /* Overload Model
    ------------------------------------------------------------------------------*/

    private static $db = array(
        // Pinned Icon Title
        'PiniconTitle' => 'Varchar(128)',
        // Android Pinned Icon
        'AndroidPiniconThemeColor' => 'Varchar(6)',
        // MS Tile
        'WindowsPiniconBackgroundColor' => 'Varchar(6)',
        // Safari Pinned Tab
//		'SafariTabiconThemeColor' => 'Varchar(6)', // @todo maybe implement
    );
    private static $has_one = array(
        // Favicon
//		'HTML4Favicon' => 'Image', // @todo maybe implement
        'HTML5Favicon' => 'Image',
        // Apple Pinned Icon
        'IOSPinicon' => 'Image',
        // Android Pinned Icon
        'AndroidPinicon' => 'Image',
        // Windows Pinned Icon
        'WindowsPinicon' => 'Image',
        // Safari Pinned Tab
//		'SafariTabiconDefault' => 'Image', // @todo maybe implement
//		'SafariTabiconWide' => 'Image', // @todo maybe implement
//		'SafariTabiconLarge' => 'Image', // @todo maybe implement
    );


    /* Overload Methods
    ------------------------------------------------------------------------------*/

    /**
     * Adds tabs & fields to the CMS.
     *
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {

        //// Favicons Tab

        $tab = 'Root.Metadata.Favicons';

        //// Favicon

        $fields->addFieldsToTab($tab, array(
            LabelField::create('FaviconDescription', 'Favicons are `favourite icons` used by browsers in a number of ways whenever an icon is necessary e.g. tabs, history, bookmarks, dashboards.<br />@ <a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">Favicon - Wikipedia, the free encyclopedia</a>')
                ->addExtraClass('information')
        ));

        //// HTML4 Favicon

        // check favicon.ico & set status
        $icoStatus = ReadonlyField::create('HTML4FaviconStatus', 'Favicon ICO<pre>type: ico</pre><pre>size: (multiple)<br />16x16 & 32x32 & 64x64 px</pre>', 'favicon.ico error');
        if (Director::fileExists('favicon.ico')) {
            $icoStatus
                ->setValue('favicon.ico found')
                ->addExtraClass('success favicon');
        } else {
            $icoStatus
                ->setValue('favicon.ico not found')
                ->addExtraClass('error');
        }

        // header & fields
        $fields->addFieldsToTab($tab, array(
            HeaderField::create('HTML4FaviconHeader', 'HTML4 <span class="aka">( favicon.ico )</span>'),
            LabelField::create('HTML4FaviconDescription', 'It is recommended you simply have a `favicon.ico` file in the webroot.')
                ->addExtraClass('information'),
            $icoStatus
        ));

        //// HTML5 Favicon

        // header & fields
        $fields->addFieldsToTab($tab, array(
            HeaderField::create('HTML5FaviconHeader', 'HTML5 <span class="aka">( favicon.png )</span>'),
            LabelField::create('HTML5FaviconDescription', '@todo Description')
                ->addExtraClass('information'),
            UploadField::create('HTML5Favicon', 'Favicon PNG<pre>type: png</pre><pre>size: 192x192 px</pre>')
                ->setAllowedExtensions(array('png'))
                ->setFolderName(self::$SEOIconsUpload)
        ));

        //// Pinned Icons Tab

        $tab = 'Root.Metadata.PinnedIcons';

        //// Pinned Icons Information

        $fields->addFieldsToTab($tab, array(
            LabelField::create('PiniconDescription', 'Pinned icons are OS-specific desktop shortcuts to pages on your website, they allow you to configure additional theming options to make pages appear more `native` / `web-app-y` within the OS.<br />Given they are OS-specific, they (obviously!) have a different format for each one :(')
                ->addExtraClass('information')
        ));

        //// Pinned Icon Title

        // CMS fields
        $fields->addFieldsToTab($tab, array(
            // header
            HeaderField::create('PiniconTitleHeader', 'Pinned Icon Title <span class="aka">( a.k.a. App Name )</span>'),
            // description
            LabelField::create('PiniconTitleDescription', 'When adding a link to the home screen, the user can choose a caption. By default, this is the bookmarked page title, which is usually fine. However, iOS and Windows 8 let you override this default value.')
                ->addExtraClass('information'),
            TextField::create('PiniconTitle', 'Application Title')
                ->setAttribute('placeholder', 'default: page title')
        ));

        //// iOS Pinned Icon

        // CMS fields
        $fields->addFieldsToTab($tab, array(
            // header
            HeaderField::create('IOSPiniconHeader', 'iOS Pinned Icon <span class="aka">( a.k.a. Touch Icons, Web Clips )</span>'),
            // information
            LabelField::create('IOSPiniconDescription', 'iPhone and iPad users can pin your web site on their home screen. The link looks like a native app.<br />@ <a href="https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html" target="_blank">Configuring Web Applications - iOS Developer Library</a>')
                ->addExtraClass('information'),
            // icon
            UploadField::create('IOSPinicon', 'iOS Icon<pre>type: png</pre><pre>size: 192x192 px</pre>')
                ->setAllowedExtensions(array('png'))
                ->setFolderName(self::$SEOIconsUpload)
                ->setDescription('iOS will fill the transparent regions with black by default, so put your own background in!')
        ));

        //// Android Pinned Icon

        // CMS fields
        $fields->addFieldsToTab($tab, array(
            // header
            HeaderField::create('AndroidPiniconHeader', 'Android Pinned Icon <span class="aka">( a.k.a. Android Chrome Icons, Launcher Icons )</span>'),
            // information
            LabelField::create('AndroidPiniconDescription', 'Add to Homescreen is a also a feature of Android Chrome. Your visitors can mix their natives apps and web bookmarks.<br />@ <a href="https://developer.chrome.com/multidevice/android/installtohomescreen" target="_blank">Add to Homescreen - Google Chrome</a>')
                ->addExtraClass('information'),
            // icon
            UploadField::create('AndroidPinicon', 'Android Icon<pre>type: png</pre><pre>size: 192x192 px</pre>')
                ->setAllowedExtensions(array('png'))
                ->setFolderName(self::$SEOIconsUpload),
            // background
            TextField::create('AndroidPiniconThemeColor', 'Theme Color<pre>type: hex triplet</pre>')
                ->setAttribute('placeholder', 'none')
                ->setAttribute('size', 6)
                ->setMaxLength(6)
                ->setDescription('Starting with Android Lollipop, you can customize the color of the task bar in the switcher.')
        ));

        //// Windows Pinned Icon

        // CMS fields
        $fields->addFieldsToTab($tab, array(
            // header
            HeaderField::create('WindowsShortcutHeader', 'Windows Pinned Icon <span class="aka">( a.k.a. Windows 8 / Metro Tiles )</span>'),
            // information
            LabelField::create('WindowsShortcutDescription', 'Windows 8 users can pin your web site on their desktop. Your site appears as a tile, just like a native Windows 8 app.<br />@ <a href="https://msdn.microsoft.com/en-us/library/dn455106" target="_blank">Creating custom tiles for IE11 websites (Windows)</a>')
                ->addExtraClass('information'),
            // icon
            UploadField::create('WindowsPinicon', 'Windows Icon<pre>type: png</pre><pre>size: 192x192 px</pre>')
                ->setAllowedExtensions(array('png'))
                ->setFolderName(self::$SEOIconsUpload),
            // background
            TextField::create('WindowsPiniconBackgroundColor', 'Background ( Tile ) Color<pre>type: hex triplet</pre>')
                ->setAttribute('placeholder', 'none')
                ->setAttribute('size', 6)
                ->setMaxLength(6)
        ));

        // @todo Safari Pinned Tab ~ maybe ??

    }

    /**
     * Generates the Android manifest.json file.
     *
     * @todo Information about permissions
     *
     * @return void
     */
    public function onAfterWrite()
    {

        // parent
        parent::onAfterWrite();

        // @todo Add success & error states + messages
        $this->generateAndroidManifest();

    }


    /* Custom Methods
    ------------------------------------------------------------------------------*/

    //// Fetch functions

    /**
     * Fetches the pinicon title.
     *
     * @return bool|string
     */
    public function fetchPiniconTitle()
    {

        if ($this->owner->PiniconTitle) {
            // return pinicon title
            return $this->owner->PiniconTitle;
        } else {
            // default
            return false;
        }

    }

    /**
     * Fetches the Android pinicon theme color.
     *
     * @return string|false
     */
    public function fetchAndroidPiniconThemeColor()
    {

        if ($this->owner->AndroidPiniconThemeColor) {
            return '#' . $this->owner->AndroidPiniconThemeColor;
        } else {
            return false;
        }

    }

    /**
     * Fetches the Windows pinicon background color.
     *
     * @return string|false
     */
    public function fetchWindowsPiniconBackgroundColor()
    {

        if ($this->owner->WindowsPiniconBackgroundColor) {
            return '#' . $this->owner->WindowsPiniconBackgroundColor;
        } else {
            return false;
        }

    }

    //// Generate functions

    /**
     * Generates the android manifest
     *
     * @todo check this is working 100%
     *
     * @return bool
     */
    public function generateAndroidManifest()
    {

        //// Android Pinicon Manifest

        $pinicon = $this->owner->AndroidPinicon();

        if ($pinicon->exists()) {

            //
            $manifest = new stdClass();

            //
            $manifest->name = $this->owner->PiniconTitle;
//			$manifest->start_url = null; @todo Maybe implement
//			$manifest->display = null; @todo Maybe implement
//			$manifest->orientation = null; @todo Maybe implement
            $manifest->icons = array();

            // 0.75x density icon
            array_push($manifest->icons, array(
                'src' => $pinicon->Fill(36, 36)->getAbsoluteURL(),
                'sizes' => '36x36',
                'type' => 'image/png',
                'density' => 0.75
            ));

            // 1x density icon
            array_push($manifest->icons, array(
                'src' => $pinicon->Fill(48, 48)->getAbsoluteURL(),
                'sizes' => '48x48',
                'type' => 'image/png',
                'density' => 1
            ));

            // 1.5x density icon
            array_push($manifest->icons, array(
                'src' => $pinicon->Fill(72, 72)->getAbsoluteURL(),
                'sizes' => '72x72',
                'type' => 'image/png',
                'density' => 1.5
            ));

            // 2x density icon
            array_push($manifest->icons, array(
                'src' => $pinicon->Fill(96, 96)->getAbsoluteURL(),
                'sizes' => '96x96',
                'type' => 'image/png',
                'density' => 2
            ));

            // 3x density icon
            array_push($manifest->icons, array(
                'src' => $pinicon->Fill(144, 144)->getAbsoluteURL(),
                'sizes' => '144x144',
                'type' => 'image/png',
                'density' => 3
            ));

            // 4x density icon
            array_push($manifest->icons, array(
                'src' => $pinicon->Fill(192, 192)->getAbsoluteURL(),
                'sizes' => '192x192',
                'type' => 'image/png',
                'density' => 4
            ));

            // create file
            $bytes = file_put_contents(Director::baseFolder() . '/manifest.json', json_encode($manifest));

            //
            if ($bytes !== false) {
                // success
                return true;
            }

        }

        // default return
        return false;

    }

}
