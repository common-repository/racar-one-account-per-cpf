=== RaCar One Account Per CPF ===
Contributors: rafacarvalhido
Donate link: https://www.paypal.me/RafaCarvalhido
Tags: cpf, account, racar, woo commerce, woocommerce
Requires at least: 4.9.8
Tested up to: 6.5.5
Stable tag: 1.0.0
WC tested up to: 9.0.2
WC requires at least: 7.2.0
Requires PHP: 7.4
Requires Plugins: woocommerce, woocommerce-extra-checkout-fields-for-brazil
License: GPLv2
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html

RaCar One Account Per CPF makes sure that only one account may have a CPF number during registration. Requires the plugin 'Brazilian Market on WooCommerce' (aka Extra Checkout Fields for Brazil).

== Description ==

The free version of the plugin makes sure that only one account may have a CPF number during registration. I won't allow account creation with a used CPF. Requires the plugins 'WooCommerce' and 'Brazilian Market on WooCommerce' (aka Extra Checkout Fields for Brazil).

There is a premium version of this plugin you [can buy](http://wa.me/5521982130264) to be able to search for existing duplicates.

= DISCLAIMER =
The plugin 'Brazilian Market on WooCommerce' extends 'WooCommerce' by adding brazilian fields to the checkout form such as CPF. 'RaCar One Account Per CPF' extends the first aforementioned plugin by limiting only one CPF number registered in the system, like many othere large stores do in Brazil. This plugin does not create the CPF field, only enforces that no CPF number is duplicated. 
'Brazilian Market on WooCommerce' can be found at https://wordpress.org/plugins/woocommerce-extra-checkout-fields-for-brazil/.
'WooCommerce' can be found at https://wordpress.org/plugins/woocommerce/.

= AFTER INSTALL =

After installation and activation, on the plugins page, find RaCar One Account Per CPF on the list and click 'settings' right under the title. It'll take you to the plugin's settings page. Another way of getting there is through the left admin menu. Find the RaCar Plugins handle and click it.

= HOW TO USE IT =

Once activated, the plugin is already working and will not allow new WooCommerce account registrations with a CPF that has been already registered before.

= RESET SETTINGS =
It is not necessary, for the plugin won't save any settings, but anyhow, the only way to reset your settings is unistalling the plugin and installing it back on.

= Languages =

This plugin was written in English and has Brazilian Portuguese transalations. Este plugin est&aacute; traduzido em Portugu&ecirc;s do Brasil.

= Screenshots Caption =

Below, you'll find the screenshots. Follow these captions:
1. Plugin installed showing requirements
2. Plugin settings page showing plugin is already working (nothing to do here)
3. Button to search for CPF duplicates on premium version of plugin
4. Screen showing CPF duplicates with user ID and name


== Installation ==

= Minimum Requirements =

* PHP version 7.4 or greater
* MySQL version 5.6 or greater 


= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install of RaCar One Account Per CPF, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "RaCar One Account Per CPF" and click Search Plugins. Once you've found our plugin you can view details about it such as the point release, rating and description. Most importantly of course, you can install it by simply clicking "Install Now".

= Manual installation =

After you donwload it here (and only here), you can do it in 2 ways:

1. WordPress Admin Dashboard

* On the left menu, click Plugins / Add New.
* Upload the file `racar-one-account-per-cpf.zip`.
* Activate it.
* Go to settings page.
* Enable it.

2. FTP

* Unzip the file `racar-one-account-per-cpf.zip`.
* Upload the unziped folder `racar-one-account-per-cpf` to the `/wp-content/plugins/` directory.
* Activate the plugin through the 'Plugins' menu in WordPress


= Updating =

Automatic updates should work like a charm; as always though, ensure you backup your site just in case.


== Frequently Asked Questions ==

= Where can I find documentation for this plugin? =

There is not one yet. As the plugin is passively working, there's no need for documentation.

= Where can I get support or talk to other users? =

If you get stuck, you can ask for help in the [Plugin Forum](https://wordpress.org/support/plugin/racar-one-account-per-cpf/).


= Who created this plugin? =
Rafa Carvalhido is a Brazilian WordPress Specialist Developer.
[Profissional WordPress](https://profissionalwp.dev.br/blog/contato/rafa-carvalhido/)
[Donate](https://paypal.me/RafaCarvalhido)
[Hire him at Workana](https://www.workana.com/freelancer/rafa-carvalhido)


== Screenshots ==
1. Plugin Enabled


== Changelog ==
= 1.0.0 - 2024-06-26 =
* First public release
* Readme description ajusted
* Tested on latest and greatest versions of WP and WC

= 0.3.6 - 2024-05-21 =
* Removed shortcode dummy code that wasn't being used

= 0.3.5 - 2024-05-20 =
* Added a second nonce check when saving the data, even though a nonce check would already have happened on registration because wp.org told me to do so.
* Almost giving up in making this free plugin. May the Lord give me strengh and patience.

= 0.3.4 - 2024-05-16 =
* Corrected nonce verification to registration form on my account and checkout with sanitize and unslash
* Added 'Requires Plugins' to plugin header as per WP Core 6.5 API

= 0.3.3 - 2024-04-29 =
* Added nonce verification to registration form data

= 0.3.2 - 2024-02-17 =
* More adjustments to abide by wp.org rules

= 0.3.1 - 2024-02-01 =
* Adjustments to abide by wp.org rules

= 0.3.0 - 2024-01-01 =
* Release Version