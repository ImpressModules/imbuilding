<?php
/**
 * Classes responsible for managing imBuilding field objects
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_imbuilding_FieldHandler extends icms_ipf_Handler {
	private $fieldTypesArray = FALSE;

	/**
	 * Constructor
	 */
	public function __construct(&$db) {
		parent::__construct($db, 'field', 'field_id', 'field_name', 'field_desc', 'imbuilding');
	}

	public function getFieldTypesArray() {
		if (!$this->fieldTypesArray) {
			$this->fieldTypesArray = array(
				'XOBJ_DTYPE_TXTBOX' => 'TextBox',
				'XOBJ_DTYPE_TXTAREA' => 'TextArea',
				'XOBJ_DTYPE_INT' => 'Integer',
				'XOBJ_DTYPE_URL' => 'URL',
				'XOBJ_DTYPE_EMAIL' => 'Email',
				'XOBJ_DTYPE_OTHER' => 'Other',
				'XOBJ_DTYPE_SOURCE' => 'Source',
				'XOBJ_DTYPE_STIME' => 'Date (simple)',
				'XOBJ_DTYPE_MTIME' => 'Date (medium)',
				'XOBJ_DTYPE_LTIME' => 'Date (long)',
				'XOBJ_DTYPE_CURRENCY' => 'Currency',
				'XOBJ_DTYPE_FLOAT' => 'Float',
				'XOBJ_DTYPE_TIME_ONLY' => 'Time',
				'XOBJ_DTYPE_URLLINK' => 'URL Link',
				'XOBJ_DTYPE_FILE' => 'Rich File',
				'XOBJ_DTYPE_IMAGE' => 'Image',
				'XOBJ_DTYPE_FORM_SECTION' => 'Form Section (open)',
				'XOBJ_DTYPE_FORM_SECTION_CLOSE' => 'Form Section (close)',
				//'XOBJ_DTYPE_ARRAY' => 'Array',
				//'XOBJ_DTYPE_SIMPLE_ARRAY' => 'Simple Array',
				'TOBJ_DTYPE_USER' => 'User',
				'TOBJ_DTYPE_LANGUAGE' => 'Language',
				'TOBJ_DTYPE_YESNO' => 'Yes / No'
			);
			asort($this->fieldTypesArray);
		}
		return $this->fieldTypesArray;
	}

	public function getFieldsForObject($object_id, $asObject = TRUE) {
		$criteria = new icms_db_criteria_Compo();
		$criteria->add(new icms_db_criteria_Item('object_id', $object_id));
		if ($asObject) {
			return $this->getObjects($criteria);
		} else {
			return $this->getList($criteria);
		}
	}

	protected function beforeSave(&$obj) {
		if ($obj->getVar("field_refer") > 0) $obj->setVar("field_type", "XOBJ_DTYPE_INT");
		return TRUE;
	}

	protected function afterSave(&$obj) {
		$criteria = new icms_db_criteria_Compo();
		$criteria->add(new icms_db_criteria_Item("object_id", $obj->getVar("object_id")));
		$criteria->add(new icms_db_criteria_Item("field_id", $obj->getVar("field_id"), "<>"));
		$this->updateAll("field_refer", 0,$criteria);
		if ($obj->getVar('new_module_wizard')) {
			if (!$obj->getVar('another')) {
				redirect_header('object.php?op=finishing&object_id=' . $obj->getVar('object_id', 'e'), 3, _AM_IMBUILDING_FIELD_CREATED);
			} else {
				redirect_header('field.php?op=mod&newmodule=2&object_id=' . $obj->getVar('object_id', 'e'), 3, _AM_IMBUILDING_FIELD_CREATED);
			}
		} else {
			if ($obj->getVar('another')) {
				redirect_header('field.php?op=mod&object_id=' . $obj->getVar('object_id', 'e'), 3, _AM_IMBUILDING_FIELD_CREATED);
			}
		}
		return TRUE;
	}
}