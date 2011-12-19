<?php
/**
 * Classes responsible for managing imBuilding module objects
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_imbuilding_ModuleHandler extends icms_ipf_Handler {
	/**
	 * Constructor
	 */
	public function __construct(&$db) {
		parent::__construct($db, 'module', 'module_id', 'module_name', '', 'imbuilding');
	}

	protected function beforeDelete(&$obj) {
		$imbuilding_object_handler = icms_getModuleHandler('object', basename(dirname(dirname(__FILE__))), "imbuilding");
		$objectsObj = $obj->getObjects();
		foreach ($objectsObj as $objectObj) {
			$imbuilding_object_handler->delete($objectObj);
		}
		return TRUE;
	}

	protected function afterInsert(&$obj) {
		redirect_header('object.php?op=mod&newmodule=1&module_id=' . $obj->id(), 3, _AM_IMBUILDING_MODULE_CREATED);
	}
}