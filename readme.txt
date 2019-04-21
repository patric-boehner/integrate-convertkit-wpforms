=== Integrate Tave and WPForms ===
Contributors: billerickson, patrickboehner
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZHXHYVWJCTZ94
Tags: form, wpforms, tave, email, marketing
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create Tave lead forms using WPForms

== Description ==

"Integrate Tave and WPForms" easily connects forms on your website to your [Tave](https://tave.com) business managment account, enabling you to capture more leads effectively.

[WPForms] simple drag-and-drop form builder allows you to create new forms with ease and its clean, modern code makes customizations a snap. This integration also works with the free version, [WPForms Lite](https://wordpress.org/plugins/wpforms-lite/), but I highly recommend purchasing the full WPForms for the valuable premium features and support.

Please support the development of this free plugin by using the affiliate links above.

== Installation ==

 1. Install this plugin, along with [WPForms](https://wpforms.com/).
 2. In the WordPress Dashboard, go to WPForms > Add New and create a form. You can add whatever fields you like, but at a minimum you must include an Email and Name field. (See screenshot 1)
 3. Click “Settings” in the left column, then select “Tave Studio Manager”. From the dropdowns, select the from fields you created to assign them to value in Tave. (See screenshot 2)
 4. In a separate browser tab, go to Tave, log in, and click [Settings > New Leads API](https://tave.com/app/settings/new-lead-api). Copy the Secret Key, go back to the WPForms Tave settings page, and paste it in the field titled “Tave Secret Key”. Copy the Studio ID, go back to WPForms Tave settings page, and past it in the filed Titiled "Tave Studio ID".
 5. Click “Save” in the top right corner, and exit out of the form builder.
 7. Insert the form somewhere on your site and test it out! Go to Pages, select a page, and above the content editor click “Add Form”. Select your form and click “Insert” to add it to the page.

== Screenshots ==

1. Creating a form with a Name and Email field.
2. Tave Settings panel while editing form.

== Changelog ==

= 1.1.1 =
- Convert Bill Erickson's ConvertKit plugin into one that works for Tave.

= 1.1.0 =
- Added filter to conditionally limit ConvertKit integration, [see example](https://www.billerickson.net/code/integrate-convertkit-wpforms-conditional-processing/)

= 1.0.3 =
- Remove ConvertKit link once API key has been provided

= 1.0.2 =
- Updated documentation

= 1.0.1 =
* Added translation file for localization

= 1.0.0 =
* Initial release
