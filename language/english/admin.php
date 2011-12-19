<?php
/**
 * English language constants used in admin section of the module
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

// Requirements
define("_AM_IMBUILDING_REQUIREMENTS", "imBuilding Requirements");
define("_AM_IMBUILDING_REQUIREMENTS_INFO", "We've reviewed your system, unfortunately it doesn't meet all the requirements needed for imBuilding to function. Below are the requirements needed.");
define("_AM_IMBUILDING_REQUIREMENTS_ICMS_BUILD", "imBuilding requires at least ImpressCMS 1.1.1 RC 1.");
define("_AM_IMBUILDING_REQUIREMENTS_SUPPORT", "Should you have any question or concerns, please visit our forums at <a href='http://community.impresscms.org'>http://community.impresscms.org</a>.");

// Commons
define("_AM_IMBUILDING_CONTINUE", "Continue");
define("_AM_IMBUILDING_STEP", "Step");
define("_AM_IMBUILDING_FIRST_USE", "This is the first time you access this module. Please update the module in order to dynamically create the database scheme.");

// module
define("_AM_IMBUILDING_MODULES", "Modules");
//define("_AM_IMBUILDING_MODULES_DSC", "All modules in the module");
define("_AM_IMBUILDING_MODULE_CREATE", "Create a module");
define("_AM_IMBUILDING_MODULE", "Module");
define("_AM_IMBUILDING_MODULE_CREATE_INFO", "This form is about the basic information of the new module you are setting up. Fill out these fields and hit the Submit button. You will then be brough to the second step where you will create your first object.");
define("_AM_IMBUILDING_MODULE_EDIT", "Edit this module");
define("_AM_IMBUILDING_MODULE_EDIT_INFO", "Fill-out the following form in order to edit this module.");
define("_AM_IMBUILDING_MODULE_MODIFIED", "The module was successfully modified.");
define("_AM_IMBUILDING_MODULE_CREATED", "The module has been successfully created.");
define("_AM_IMBUILDING_MODULE_CREATED_FINISH", "All information about the module have been configured. You can now edit elements of the module or generate it by clicking on te Generate button next to this module in the Actions column.");
define("_AM_IMBUILDING_MODULE_VIEW", "Module info");
//define("_AM_IMBUILDING_MODULE_VIEW_DSC", "Here is the info about this module.");
define("_AM_IMBUILDING_MODULE_GENERATION", "Module generation");
define("_AM_IMBUILDING_CREATE_MODULE", "Generate module");
define("_AM_IMBUILDING_SHOW_LOG", "Show Log");
define("_AM_IMBUILDING_MODULE_CLICK_TO_DOWNLOAD", "Click here to download your new module");
define("_AM_IMBUILDING_MODULE_GENERATED_TITLE", "New module generated");
define("_AM_IMBUILDING_MODULE_GENERATED_INFO", "Click on the link below to download a Zip archive of your new module.");
define("_AM_IMBUILDING_MODULE_GENERATED_NOZIP", "The new module was generated. It has been place in this folder:<br />%s");
define("_AM_IMBUILDING_CREATE_MODULE_NO_DEFAULT_OBJECT", "You need to specify the default object before generating the module.");
define("_AM_IMBUILDING_CREATE_MODULE_OBJECT_NO_DEFAULT_FIELD", "An identifier is required for all objects. Please set the identifier name for the object <em>%s</em>.");

// object
define("_AM_IMBUILDING_OBJECTS", "Objects");
//define("_AM_IMBUILDING_OBJECTS_DSC", "All objects in the object");
define("_AM_IMBUILDING_OBJECT_CREATE", "Add an object");
define("_AM_IMBUILDING_OBJECT", "Object");
define("_AM_IMBUILDING_OBJECT_CREATE_INFO", "Fill-out the following form to create a new object.");
define("_AM_IMBUILDING_OBJECT_CREATE_WIZARD", "Module created, now add your first object");
define("_AM_IMBUILDING_OBJECT_CREATE_WIZARD_INFO", "The module was created. Now you can proceed to the creation of your first object. This form will collect the basic information about the object you wish to create. Once you click on the Submit button, your new object will be saved and you will be brought to a form where you will start adding fields to this object.");
define("_AM_IMBUILDING_OBJECT_EDIT", "Edit this object");
define("_AM_IMBUILDING_OBJECT_EDIT_INFO", "Fill-out the following form in order to edit this object.");
define("_AM_IMBUILDING_OBJECT_EDIT_FINILIZE", "All fields added, now finalize Object settings");
define("_AM_IMBUILDING_OBJECT_EDIT_FINILIZE_INFO", "All fields were created, now you need to select the fields of this object which will act as the object identifier and the object description.");
define("_AM_IMBUILDING_OBJECT_MODIFIED", "The object was successfully modified.");
define("_AM_IMBUILDING_OBJECT_CREATED", "The object has been successfully created.");
define("_AM_IMBUILDING_OBJECT_VIEW", "Object info");
//define("_AM_IMBUILDING_OBJECT_VIEW_DSC", "Here is the info about this object.");
define("_AM_IMBUILDING_OBJECTS_OF_MODULE", "Objects of this module");

// field
define("_AM_IMBUILDING_FIELDS", "Fields");
//define("_AM_IMBUILDING_FIELDS_DSC", "All fields in the field");
define("_AM_IMBUILDING_FIELD_CREATE", "Add a field");
define("_AM_IMBUILDING_FIELD", "Field");
//define("_AM_IMBUILDING_FIELD_CREATE_INFO", "Fill-out the following form to create a new field in your object.");
define("_AM_IMBUILDING_FIELD_CREATE_WIZARD", "Your object was created, now start adding fields");
define("_AM_IMBUILDING_FIELD_CREATE_WIZARD_INFO", "Fill-out the following form to create a new field in your object. After clicking on the Submit button to create this field, you will automatically be brought to a form where you will be able to add a new field. When you are don adding field, set the <em>Add another field ?</em> radio button to No.");
define("_AM_IMBUILDING_FIELD_CREATE_WIZARD2", "Add another field to your object");
define("_AM_IMBUILDING_FIELD_CREATE_WIZARD2_INFO", "Fill-out the following form to create a new field in your object. After clicking on the Submit button to create this field, you will automatically be brought to a form where you will be able to add a new field. When you are don adding field, set the <em>Add another field ?</em> radio button to No.");
define("_AM_IMBUILDING_FIELD_EDIT", "Edit this field");
//define("_AM_IMBUILDING_FIELD_EDIT_INFO", "Fill-out the following form in order to edit this field.");
define("_AM_IMBUILDING_FIELD_MODIFIED", "The field was successfully modified.");
define("_AM_IMBUILDING_FIELD_CREATED", "The field has been successfully created.");
define("_AM_IMBUILDING_FIELD_VIEW", "Field info");
//define("_AM_IMBUILDING_FIELD_VIEW_DSC", "Here is the info about this field.");
define("_AM_IMBUILDING_FIELDS_OF_OBJECT", "Fields of this object");