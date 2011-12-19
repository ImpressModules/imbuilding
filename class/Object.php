<?php
/**
 * Classes representing the imBuilding object object
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_imbuilding_Object extends icms_ipf_Object {
	/**
	 * Constructor
	 *
	 * @param mod_imbuilding_ObjectHandler $handler handler object
	 */
	public function __construct(&$handler) {
		parent::__construct($handler);

		$this->quickInitVar('object_id', XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar('module_id', XOBJ_DTYPE_INT);
		$this->quickInitVar('object_name', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('object_desc', XOBJ_DTYPE_TXTAREA);
		$this->quickInitVar('object_identifier_name', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('object_identifier_desc', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('object_counter', XOBJ_DTYPE_INT);
		$this->quickInitVar('object_dohtml', XOBJ_DTYPE_INT);
		$this->quickInitVar('object_dobr', XOBJ_DTYPE_INT);
		$this->quickInitVar('object_doimage', XOBJ_DTYPE_INT);
		$this->quickInitVar('object_dosmiley', XOBJ_DTYPE_INT);
		$this->quickInitVar('object_doxcode', XOBJ_DTYPE_INT);
		$this->quickInitVar('enable_seo', XOBJ_DTYPE_INT);
		$this->quickInitVar('sort', XOBJ_DTYPE_INT, TRUE, FALSE, FALSE, 0);
		$this->initNonPersistableVar('new_module_wizard', XOBJ_DTYPE_INT);
		$this->initNonPersistableVar('enable_upload', XOBJ_DTYPE_INT);

		$this->setControl('object_desc', 'textarea');
		$this->setControl('object_identifier_name', array (
			'method' => 'getObjectFieldsList',
			'object' => &$this
		));
		$this->setControl('object_identifier_desc', array (
			'method' => 'getObjectFieldsList',
			'object' => &$this
		));
		$this->setControl('object_counter', 'yesno');
		$this->setControl('object_dohtml', 'yesno');
		$this->setControl('object_dobr', 'yesno');
		$this->setControl('object_doimage', 'yesno');
		$this->setControl('object_dosmiley', 'yesno');
		$this->setControl('object_doxcode', 'yesno');
		$this->setControl('enable_seo', 'yesno');
		$this->hideFieldFromForm('module_id');
		$this->hideFieldFromSingleView('module_id');
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
		if ($format == 's' && in_array($key, array ('object_identifier_name', 'object_identifier_desc'))) {
			return call_user_func(array ($this, $key));
		}
		return parent::getVar($key, $format);
	}

	public function getFields() {
		$imbuilding_fields_handler = icms_getModuleHandler('field');
		$ret = $imbuilding_fields_handler->getFieldsForObject($this->id());
		return $ret;
	}

	public function getObjectFieldsList() {
		$imbuilding_fields_handler = icms_getModuleHandler('field');
		$ret = $imbuilding_fields_handler->getFieldsForObject($this->id(), FALSE);
		return $ret;
	}

	public function object_identifier_name() {
		$icms_ipf_registry_Handler = icms_ipf_registry_Handler::getInstance();
		$ret = $this->getVar('object_identifier_name', 'e');
		$obj = $icms_ipf_registry_Handler->getSingleObject('field', $ret);
		if ($obj) $ret = $obj->getVar('field_name');
		return $ret;
	}

	public function object_identifier_desc() {
		$icms_ipf_registry_Handler = icms_ipf_registry_Handler::getInstance();
		$ret = $this->getVar('object_identifier_desc', 'e');
		$obj = $icms_ipf_registry_Handler->getSingleObject('field', $ret);
		if ($obj) $ret = $obj->getVar('field_name');
		return $ret;
	}

	/**
	 * Build the breadcrumb given a specific situation
	 *
	 * @param string $situation
	 * @return array of items
	 */
	public function getBreadcrumb($situation) {
		$icms_ipf_registry_Handler = icms_ipf_registry_Handler::getInstance();
		$moduleObj = $icms_ipf_registry_Handler->getSingleObject('module', $this->getVar('module_id'));

		$items = array ();
		$items[0]['link'] = IMBUILDING_ADMIN_URL . 'module.php';
		$items[0]['caption'] = _AM_IMBUILDING_MODULES;

		switch ($situation) {
			case 'view':
				$items[1]['link'] = $moduleObj->getAdminViewItemLink(TRUE);
				$items[1]['caption'] = $moduleObj->title();

				$items[2]['caption'] = $this->title();
			break;
			case 'form':
				$items[1]['link'] = $moduleObj->getAdminViewItemLink(TRUE);
				$items[1]['caption'] = $moduleObj->title();

				if ($this->isNew()) {
					$items[2]['caption'] = _AM_IMBUILDING_OBJECT_CREATE;
				} else {
					$items[2]['caption'] = $this->title();
					$items[2]['link'] = $this->getAdminViewItemLink(TRUE);
					$items[3]['caption'] = _AM_IMBUILDING_OBJECT_EDIT;
				}
			break;
		}
		return $items;
	}

	public function getObjectSortControl() {
		$control = new icms_form_elements_Text('', 'sort[]', 3, 3, $this->getVar("sort", "e"));
		return $control->render();
	}
}