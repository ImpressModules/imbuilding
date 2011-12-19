<?php
/**
 * BaseModule version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	IMBUILDING_COPYRIGHT
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		IMBUILDING_TAG_AUTHOR_NAME <IMBUILDING_TAG_AUTHOR_EMAIL>
 * @package		basemodule
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/**  General Information  */
$modversion = array(
	"name"						=> _MI_BASEMODULE_MD_NAME,
	"version"					=> 1.0,
	"description"				=> _MI_BASEMODULE_MD_DESC,
	"author"					=> "IMBUILDING_TAG_AUTHOR_NAME",
	"credits"					=> "IMBUILDING_TAG_CREDITS",
	"help"						=> "",
	"license"					=> "GNU General Public License (GPL)",
	"official"					=> 0,
	"dirname"					=> basename(dirname(__FILE__)),
	"modname"					=> "basemodule",

/**  Images information  */
	"iconsmall"					=> "images/icon_small.png",
	"iconbig"					=> "images/icon_big.png",
	"image"						=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
	"status_version"			=> "1.0",
	"status"					=> "Beta",
	"date"						=> "Unreleased",
	"author_word"				=> "",
	"warning"					=> _CO_ICMS_WARNING_BETA,

/** Contributors */
	"developer_website_url"		=> "IMBUILDING_TAG_AUTHOR_WEBSITE_URL",
	"developer_website_name"	=> "IMBUILDING_TAG_AUTHOR_WEBSITE_NAME",
	"developer_email"			=> "IMBUILDING_TAG_AUTHOR_EMAIL",

/** Administrative information */
	"hasAdmin"					=> 1,
	"adminindex"				=> "admin/index.php",
	"adminmenu"					=> "admin/menu.php",

/** Install and update informations */
	"onInstall"					=> "include/onupdate.inc.php",
	"onUpdate"					=> "include/onupdate.inc.php",

/** Search information */
	"hasSearch"					=> 0,
	"search"					=> array("file" => "include/search.inc.php", "func" => "basemodule_search"),

/** Menu information */
	"hasMain"					=> 1,

/** Comments information */
	"hasComments"				=> 1,
	"comments"					=> array(
									"itemName" => "post_id",
									"pageName" => "post.php",
									"callbackFile" => "include/comment.inc.php",
									"callback" => array("approve" => "basemodule_com_approve",
														"update" => "basemodule_com_update")));

/** other possible types: testers, translators, documenters and other */
$modversion['people']['developers'][] = "IMBUILDING_TAG_DEVELOPER_INFO";

/** Manual */
$modversion['manual']['wiki'][] = "<a href='http://wiki.impresscms.org/index.php?title=BaseModule' target='_blank'>English</a>";

/** Database information */
/** IMBUILDING_OBJECT_ITEMS */
$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/** Templates information */
$modversion['templates'] = array(
/** IMBUILDING_OBJECT_TEMPLATES */
	array('file' => 'basemodule_header.html', 'description' => 'Module Header'),
	array('file' => 'basemodule_footer.html', 'description' => 'Module Footer'));

/** Blocks information */
/** To come soon in imBuilding... */

/** Preferences information */
/** To come soon in imBuilding... */

/** Notification information */
/** To come soon in imBuilding... */