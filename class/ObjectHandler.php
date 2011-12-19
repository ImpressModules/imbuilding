<?php
/**
 * Classes responsible for managing imBuilding object objects
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_imbuilding_ObjectHandler extends icms_ipf_Handler {
	/**
	 * Constructor
	 */
	public function __construct(&$db) {
		parent::__construct($db, 'object', 'object_id', 'object_name', 'object_desc', 'imbuilding');
	}

	public function getObjectsForModule($module_id, $asObject = TRUE) {
		$criteria = new icms_db_criteria_Compo();
		$criteria->add(new icms_db_criteria_Item('module_id', $module_id));
		if ($asObject) {
			return $this->getObjects($criteria);
		} else {
			return $this->getList($criteria);
		}
	}

	public function getObjectsReferList($module_id = FALSE, $object_id = FALSE) {
		$criteria = new icms_db_criteria_Compo();
		if ($module_id !== FALSE) $criteria->add(new icms_db_criteria_Item('module_id', $module_id));
		if ($object_id !== FALSE) $criteria->add(new icms_db_criteria_Item('object_id', $object_id, '<>'));
		return array_merge(array(0 => "---"), $this->getList($criteria));
	}

	protected function beforeDelete(&$obj) {
		$imbuilding_field_handler = icms_getModuleHandler('field');
		$fields = $obj->getFields();
		foreach($fields as $fieldObj) {
			$imbuilding_field_handler->delete($fieldObj);
		}
		$imbuilding_field_handler->updateAll("field_refer", 0, icms_buildCriteria(array("field_refer" => $obj->getVar("object_id"))), TRUE);
		return TRUE;
	}

	protected function afterInsert(&$obj) {
		if ($obj->getVar('new_module_wizard')) {
			redirect_header('field.php?op=mod&newmodule=1&object_id=' . $obj->id(), 3, _AM_IMBUILDING_OBJECT_CREATED);
		} else {
			return TRUE;
		}
	}

	protected function afterUpdate(&$obj) {
		if ($obj->getVar('new_module_wizard')) {
			redirect_header('module.php', 5, _AM_IMBUILDING_MODULE_CREATED_FINISH);
		} else {
			return TRUE;
		}
	}
}