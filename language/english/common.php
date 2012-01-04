<?php
/**
 * English language constants commonly used in the module
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

// module
define("_CO_IMBUILDING_MODULE_MODULE_NAME", "Module name");
define("_CO_IMBUILDING_MODULE_MODULE_NAME_DSC", "Name you would like to use for this module");
define("_CO_IMBUILDING_MODULE_MODULE_DESC", "Module description");
define("_CO_IMBUILDING_MODULE_MODULE_DESC_DSC", "A small description of the module. Will be used in the About page.");
define("_CO_IMBUILDING_MODULE_AUTHOR_NAME", "Author name");
define("_CO_IMBUILDING_MODULE_AUTHOR_NAME_DSC", "Your name will be used as the <em>Developer Name</em> on the About page of your module as well as in the header comments block of all PHP files.");
define("_CO_IMBUILDING_MODULE_AUTHOR_PROFILE", "Public profile URL");
define("_CO_IMBUILDING_MODULE_AUTHOR_PROFILE_DSC", "If you have a public profile somewhere (on community.impressmcms.org or on your blog, etc. it will be used in the About page of your module.)");
define("_CO_IMBUILDING_MODULE_AUTHOR_WEBSITE_NAME", "Name of your Web site");
define("_CO_IMBUILDING_MODULE_AUTHOR_WEBSITE_NAME_DSC", "Your Web site will be displayed on the About page of your module.");
define("_CO_IMBUILDING_MODULE_AUTHOR_WEBSITE_URL", "URL of your Web site");
define("_CO_IMBUILDING_MODULE_AUTHOR_WEBSITE_URL_DSC", "Your Web site will be displayed on the About page of your module.");
define("_CO_IMBUILDING_MODULE_AUTHOR_EMAIL", "Your email");
define("_CO_IMBUILDING_MODULE_AUTHOR_EMAIL_DSC", "Your email will be displayed on the About page of your module.");
define("_CO_IMBUILDING_MODULE_MODULE_COPYRIGHT", "Module Copyright");
define("_CO_IMBUILDING_MODULE_MODULE_COPYRIGHT_DSC", "Copyright of your module.");
define("_CO_IMBUILDING_MODULE_MODULE_CREDITS", "Credits");
define("_CO_IMBUILDING_MODULE_MODULE_CREDITS_DSC", "Credits of the module, which will be displayed on the About page of your module.");
define("_CO_IMBUILDING_MODULE_DEFAULT_OBJECT", "Default object");
define("_CO_IMBUILDING_MODULE_DEFAULT_OBJECT_DSC", "Select the default object of your module. This is the object that will be displayed on the index page of admin and user side of the module.");

// object
define("_CO_IMBUILDING_OBJECT_OBJECT_NAME", "Object name");
define("_CO_IMBUILDING_OBJECT_OBJECT_NAME_DSC", "Name of the object you want your module to manage. Example, <em>Article</em>.");
define("_CO_IMBUILDING_OBJECT_OBJECT_DESC", "Object description");
define("_CO_IMBUILDING_OBJECT_OBJECT_DESC_DSC", "Description of the object. This is purely informative and will be used in the comment block of the PHP class created for this object.");
define("_CO_IMBUILDING_OBJECT_OBJECT_IDENTIFIER_NAME", "Object identifier field");
define("_CO_IMBUILDING_OBJECT_OBJECT_IDENTIFIER_NAME_DSC", "Field which will be used as the identifier of this object. For example, <em>title</em>.");
define("_CO_IMBUILDING_OBJECT_OBJECT_IDENTIFIER_DESC", "Object description field");
define("_CO_IMBUILDING_OBJECT_OBJECT_IDENTIFIER_DESC_DSC", "Field which will be used to identify the description of the object. For example, <em>description</em>.");
define("_CO_IMBUILDING_OBJECT_OBJECT_COUNTER", "Add a counter");
define("_CO_IMBUILDING_OBJECT_OBJECT_COUNTER_DSC", "Select yes if you wish your object to have a hits counter.");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOHTML", "Enable HTML check");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOHTML_DSC", "Select Yes to have your object enable or disable HTML.");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOBR", "Enable linebreak check");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOBR_DSC", "Select Yes to have your object enable or disable linebreaks.");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOIMAGE", "Enable images check");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOIMAGE_DSC", "Select Yes to have your object enable or disable images.");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOSMILEY", "Enable smiley check");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOSMILEY_DSC", "Select Yes to have your object enable or disable smileys.");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOXCODE", "Enable xCode check");
define("_CO_IMBUILDING_OBJECT_OBJECT_DOXCODE_DSC", "Select Yes to have your object enable or siable xCodes.");
define("_CO_IMBUILDING_OBJECT_ENABLE_SEO", "Enable SEO");
define("_CO_IMBUILDING_OBJECT_ENABLE_SEO_DSC", "Enable SEO feature for this object. This will automatically add the following fields: short_url, meta_keywords and meta_description");
define("_CO_IMBUILDING_OBJECT_SORT", "Sort");
define("_CO_IMBUILDING_OBJECT_SORT_DSC", "");

// field
define("_CO_IMBUILDING_FIELD_FIELD_NAME", "Field name");
define("_CO_IMBUILDING_FIELD_FIELD_NAME_DSC", "Name of the field. Example, <em>title</em>.");
define("_CO_IMBUILDING_FIELD_FIELD_CAPTION", "Field caption");
define("_CO_IMBUILDING_FIELD_FIELD_CAPTION_DSC", "The caption of the field will be used in the add and edit form, as well as the column headers.");
define("_CO_IMBUILDING_FIELD_FIELD_DESC", "Field description");
define("_CO_IMBUILDING_FIELD_FIELD_DESC_DSC", "Description of the field is used in the add and edit form.");
define("_CO_IMBUILDING_FIELD_FIELD_TYPE", "Field type");
define("_CO_IMBUILDING_FIELD_FIELD_TYPE_DSC", "Type of the field");
define("_CO_IMBUILDING_FIELD_FIELD_REFER", "Refer other object");
define("_CO_IMBUILDING_FIELD_FIELD_REFER_DSC", "If selected, a link is created for this object to the selected object type. For example if you want to link an article to a category.");
define("_CO_IMBUILDING_FIELD_FIELD_EXTRA", "Field extra");
define("_CO_IMBUILDING_FIELD_FIELD_REQUIRED", "Required ?");
define("_CO_IMBUILDING_FIELD_FIELD_REQUIRED_DESC", "Select Yes to set this field as required.");
define("_CO_IMBUILDING_FIELD_ANOTHER", "Add another field ?");
define("_CO_IMBUILDING_FIELD_ANOTHER_DSC", "Set to yes to be add another new field after saving this one.");