<?php
/**
 * Common file of the module included on all pages of the module
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

if (!defined("IMBUILDING_DIRNAME")) define("IMBUILDING_DIRNAME", $modversion["dirname"] = basename(dirname(__FILE__, 2)));
if (!defined("IMBUILDING_URL")) define("IMBUILDING_URL", ICMS_URL . "/modules/" . IMBUILDING_DIRNAME . "/");
if (!defined("IMBUILDING_ROOT_PATH")) define("IMBUILDING_ROOT_PATH", ICMS_ROOT_PATH . "/modules/" . IMBUILDING_DIRNAME . "/");
if (!defined("IMBUILDING_IMAGES_URL")) define("IMBUILDING_IMAGES_URL", IMBUILDING_URL . "images/");
if (!defined("IMBUILDING_ADMIN_URL")) define("IMBUILDING_ADMIN_URL", IMBUILDING_URL . "admin/");

// Include the common language file of the module
icms_loadLanguageFile("imbuilding", "common");