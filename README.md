![Screenshot](screenshot-1.png)
![Screenshot](screenshot-2.png)
![Screenshot](screenshot-3.png)

## Overview ##

This is a modular extension for [graphiques-digitale/silverstripe-seo-metadata](https://github.com/Graphiques-Digitale/silverstripe-seo-metadata)

It enables enhanced **_favicon_** and **_touch icon_** features.

Favicon inspired by: [audreyr/favicon-cheat-sheet][4], [Jonathan T. Neal - Understand the Favicon][5] and [High Quality Visuals for Pinned Sites in Windows 8][6]

It requires:
* [`Metadata`](https://github.com/Graphiques-Digitale/silverstripe-seo-metadata)

It is intended to be used alongside it's siblings:
* [`Facebook Insights`](https://github.com/Graphiques-Digitale/silverstripe-seo-facebook-insights)
* [`Open Graph`](https://github.com/Graphiques-Digitale/silverstripe-seo-open-graph)
* [`Twitter Cards`](https://github.com/Graphiques-Digitale/silverstripe-seo-twitter-cards)
* [`Schema.org`](https://github.com/Graphiques-Digitale/silverstripe-seo-schema-dot-org)

These are all optional and fragmented from the alpha version [`SSSEO`](https://github.com/Graphiques-Digitale/SSSEO), which is now redundant.

The whole module bunch is based largely on [18 Meta Tags Every Webpage Should Have in 2013][1].

Touch icons inspired by: [Everything you always wanted to know about touch icons][11]

Also, a good overview: [5 tips for SEO with Silverstripe 3][2].

## Installation ##

### Composer ###

* `composer require graphiques-digitale/silverstripe-seo-icons`
* run `~/dev/build/?flush`

### From ZIP ###

* Place the extracted folder `silverstripe-seo-icons-{version}` into `silverstripe-seo-icons` in the SilverStripe webroot
* run `~/dev/build/?flush`

## Template Usage ##

Depending on your configuration, the general idea is to replace all header content relating to metadata with `$Metadata()` just below the opening `<head>` tag and `$BaseHref()` function, e.g.:

```html
<head>
<% base_tag %>
$Metadata()
<!-- further includes ~ viewport, etc. -->
<!-- however, really don't include CSS & JS here ~ do it in the *_Controller of this class -->
</head>
```

This will output something along the lines of:

```html
<!-- SEO -->
<!-- Metadata -->
<meta charset="UTF-8" />
<link rel="canonical" href="http://dev.seo.silverstripe.org/" />
<title>Your Site Name | Home - your tagline here</title>
<meta name="description" content="Welcome to SilverStripe! This is the default home page. You can edit this page by opening the CMS. You can now access the developer documentation, or begin the tutorials." />
<!-- Favicon -->
<link rel="icon" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/logo.png" />
<!--[if IE]><link rel="shortcut icon" href="/favicon.ico" /><![endif]-->
<meta name="msapplication-TileColor" content="FFFFFF" />
<meta name="msapplication-TileImage" content="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/logo.png" />
<!-- Touch Icon -->
<link rel="icon" sizes="192x192" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize192192-logo.png">
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize180180-logo.png">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/logo.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize144144-logo.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize120120-logo.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize114114-logo.png">
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize7676-logo.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize7272-logo.png">
<link rel="apple-touch-icon-precomposed" href="http://dev.seo.silverstripe.org/assets/SiteConfig/seo-icons/_resampled/SetSize5757-logo.png"><!-- 57×57px -->
<!-- END SEO -->
```

## Issue Tracker ##

Issues are tracked on GitHub @ [Issue Tracker](https://github.com/Graphiques-Digitale/silverstripe-seo-icons/issues)

## Development and Contribution ##

Please get in touch @ [`hello@graphiquesdigitale.net`](mailto:hello@graphiquesdigitale.net) if you have any extertise in any of these SEO module's areas and would like to help ~ they're a lot to maintain.



[1]: https://www.iacquire.com/blog/18-meta-tags-every-webpage-should-have-in-2013
[2]: http://www.silverstripe.org/blog/5-tips-for-seo-with-silverstripe-3-/
[3]: http://moz.com/learn/seo/title-tag
[4]: https://github.com/audreyr/favicon-cheat-sheet
[5]: http://www.jonathantneal.com/blog/understand-the-favicon/
[6]: http://blogs.msdn.com/b/ie/archive/2012/06/08/high-quality-visuals-for-pinned-sites-in-windows-8.aspx
[7]: https://developers.facebook.com/docs/platforminsights/domains
[8]: http://ogp.me
[9]: https://dev.twitter.com/cards/overview
[10]: https://developers.google.com/+/web/snippet/
[11]: https://mathiasbynens.be/notes/touch-icons