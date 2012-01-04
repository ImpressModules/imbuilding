<?php
/**
 * File containing onUpdate and onInstall functions for the module
 *
 * This file is included by the core in order to trigger onInstall or onUpdate functions when needed.
 * Of course, onUpdate function will be triggered when the module is updated, and onInstall when
 * the module is originally installed. The name of this file needs to be defined in the
 * icms_version.php
 *
 * <code>
 * $modversion["onInstall"] = "include/onupdate.inc.php";
 * $modversion["onUpdate"] = "include/onupdate.inc.php";
 * </code>
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

// this needs to be the latest db version
define("IMBUILDING_DB_VERSION", 1);

function icms_module_update_imbuilding($module) {
    return TRUE;
}

function icms_module_install_imbuilding($module) {
	icms_core_Filesystem::mkdir(ICMS_UPLOAD_PATH . "/imbuilding/packages/");

	return TRUE;
}