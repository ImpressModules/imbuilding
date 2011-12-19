<?php
/**
 * Admin header file
 *
 * This file is included in all pages of the admin side and being so, it proceeds to a few
 * common things.
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

$icmsOnDemandPreload[] = array("module" => "imbuilding", "filename" => "adminside");

include_once "../../../include/cp_header.php";
include_once ICMS_ROOT_PATH . "/modules/" . basename(dirname(dirname(__FILE__))) . "/include/common.php";
defined("IMBUILDING_ADMIN_URL") or define("IMBUILDING_ADMIN_URL", IMBUILDING_URL . "admin/");
include_once IMBUILDING_ROOT_PATH . "include/requirements.php";