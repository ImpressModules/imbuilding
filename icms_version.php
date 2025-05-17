<?php
/**
 * imBuilding version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @package		imbuilding
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");
$composer_json = json_decode(file_get_contents(__DIR__ . "/composer.json"), true);

$modversion = array(
/**  General Information  */
	"name"						=> $composer_json["name"],
	"version"					=> '2.2',
	"description"				=> $composer_json['description'],
	"author"					=> "The SmartFactory",
	"credits"					=> "INBOX International inc.",
	"help"						=> "",
	"license"					=> $composer_json['license'],
	"official"					=> 1,
	"dirname"					=> basename(__DIR__),
	"modname"					=> "imbuilding",

/**  Images information  */
	"iconsmall"					=> "images/icon_small.png",
	"iconbig"					=> "images/icon_big.png",
	"image"						=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
	"status"					=> "Beta",
    "status_version"			=> $modversion['version'] . " " . $modversion['status'],
	"date"						=> date('Y-m-d', filemtime(__FILE__)),
	"author_word"				=> "",
	"warning"					=> _CO_ICMS_WARNING_BETA,

/** Contributors */
	"developer_website_url"		=> "http://inboxinternational.com",
	"developer_website_name"	=> "INBOX International inc.",
	"developer_email"			=> "info@inboxintl.com",

/** Administrative information */
	"hasAdmin"					=> 1,
	"adminindex"				=> "admin/index.php",
	"adminmenu"					=> "admin/menu.php",

	/** Install and update informations */
	"onInstall"					=> "include/onupdate.inc.php",
	"onUpdate"					=> "include/onupdate.inc.php",

/** Search information */
	"hasSearch"					=> 0,

/** Menu information */
	"hasMain"					=> 0,

/** IPF object information */
	"object_items"				=> array("module", "object", "field"));

$modversion["people"]["developers"][] = "[url=http://community.impresscms.org/userinfo.php?uid=168]marcan[/url] (Marc-Andr&eacute; Lanciault)";
$modversion["people"]["developers"][] = "[url=http://community.impresscms.org/userinfo.php?uid=1168]phoenyx[/url]";

/** Manual */
//$modversion["manual"]["wiki"][] = "<a href="http://wiki.impresscms.org/index.php?title=ImBlogging" target="_blank">English</a>";

$modversion["tables"] = icms_getTablesArray($modversion["dirname"], $modversion["object_items"]);

/** Templates information */
$modversion["templates"] = array(
	array("file" => "imbuilding_admin_index.html", "description" => "Admin Index template"),
	array("file" => "imbuilding_admin_module.html", "description" => "Module admin template"),
	array("file" => "imbuilding_admin_object.html", "description" => "Object Admin template"),
	array("file" => "imbuilding_admin_field.html", "description" => "Field Admin template"),
	array("file" => "imbuilding_requirements.html", "description" => "Requirements")
);
