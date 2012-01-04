<?php
/**
 * Classes representing the imBuilding field object
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_imbuilding_Field extends icms_ipf_Object {
	/**
	 * Constructor
	 *
	 * @param mod_imbuilding_FieldHandler $handler Object handler
	 */
	public function __construct(&$handler) {
		parent::__construct($handler);

		$this->quickInitVar('field_id', XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar('object_id', XOBJ_DTYPE_INT);
		$this->quickInitVar('field_name', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('field_caption', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('field_desc', XOBJ_DTYPE_TXTAREA);
		$this->quickInitVar('field_type', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('field_refer', XOBJ_DTYPE_INT);
		$this->quickInitVar('field_extra', XOBJ_DTYPE_TXTAREA);
		$this->quickInitVar('field_required', XOBJ_DTYPE_INT);
		$this->initNonPersistableVar('another', 'field', XOBJ_DTYPE_INT);
		$this->initNonPersistableVar('new_module_wizard', XOBJ_DTYPE_INT);

		$this->hideFieldFromForm(array('object_id', 'field_extra'));
		$this->hideFieldFromSingleView('object_id');
		$this->showFieldOnForm('another');

		$this->setControl('field_desc', 'textarea');
		$this->setControl('field_type', array(
			'itemHandler' => 'field',
			'method' => 'getFieldTypesArray',
			'module' => 'imbuilding'));
		$this->setControl('field_required', 'yesno');
		$this->setControl('another', 'yesno');
	}

	/**
	 * Overriding the icms_ipf_Object::getVar method to assign a custom method on some
	 * specific fields to handle the value before returning it
	 *
	 * @param str $key key of the field
	 * @param str $format format that is requested
	 * @return mixed value of the field that is requested
	 */
	public function getVar($key, $format = 's') {
		if ($format == 's' && in_array($key, array('field_type', 'field_required'))) {
			return call_user_func(array($this, $key));
		}
		return parent::getVar($key, $format);
	}

	public function field_type() {
		$ret = $this->getVar('field_type', 'e');
		$imbuilding_field_handler = icms_getModuleHandler('field');
		$fieldTypesArray = $imbuilding_field_handler->getFieldTypesArray();
		if (isset($fieldTypesArray[$ret])) {
			return $fieldTypesArray[$ret];
		} else {
			return $ret;
		}
	}

	public function field_required() {
		$ret = $this->getVar('field_required', 'e');
		if ($ret) {
			return 'TRUE';
		} else {
			return 'FALSE';
		}
	}

	/**
	 * Build the breadcrumb given a specific situation
	 *
	 * @param string $situation
	 * @return array of items
	 */
	public function getBreadcrumb($situation) {
		$icms_ipf_registry_Handler = icms_ipf_registry_Handler::getInstance();
		$objectObj = $icms_ipf_registry_Handler->getSingleObject('object', $this->getVar('object_id'));
		$moduleObj = $icms_ipf_registry_Handler->getSingleObject('module', $objectObj->getVar('module_id'));

		$items = array ();
		$items[0]['link'] = IMBUILDING_ADMIN_URL . 'module.php';
		$items[0]['caption'] = _AM_IMBUILDING_MODULES;

		switch ($situation) {
			case 'view':
				$items[1]['link'] = $moduleObj->getAdminViewItemLink(TRUE);
				$items[1]['caption'] = $moduleObj->title();

				$items[2]['link'] = $objectObj->getAdminViewItemLink(TRUE);
				$items[2]['caption'] = $objectObj->title();

				$items[3]['caption'] = $this->title();
			break;
			case 'form':
				$items[1]['link'] = $moduleObj->getAdminViewItemLink(TRUE);
				$items[1]['caption'] = $moduleObj->title();

				$items[2]['link'] = $objectObj->getAdminViewItemLink(TRUE);
				$items[2]['caption'] = $objectObj->title();

				if ($this->isNew()) {
					$items[3]['caption'] = _AM_IMBUILDING_FIELD_CREATE;
				} else {
					$items[3]['caption'] = $this->title();
					$items[3]['link'] = $this->getAdminViewItemLink(TRUE);
					$items[4]['caption'] = _AM_IMBUILDING_FIELD_EDIT;
				}
			break;
		}
		return $items;
	}
}