<?php
/**
 * Classes representing the imBuilding module object
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die ("ICMS root path not defined");

class mod_imbuilding_Module extends icms_ipf_Object {
	/**
	 * Constructor
	 *
	 * @param mod_imbuilding_ModuleHandler $handler handler object
	 */
	public function __construct(& $handler) {
		parent::__construct($handler);

		$this->quickInitVar('module_id', XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar('module_name', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('module_desc', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('author_name', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('author_email', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('author_profile', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('author_website_url', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('author_website_name', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('author_email', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('module_copyright', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('module_credits', XOBJ_DTYPE_TXTBOX);
		$this->quickInitVar('default_object', XOBJ_DTYPE_INT);

		$this->setControl('default_object', array('method' => 'getObjectsList', 'object' => &$this));
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
		if ($format == 's' && in_array($key, array('default_object'))) {
			return call_user_func(array($this, $key));
		}
		return parent::getVar($key, $format);
	}

	public function getCreateModuleLink() {
		$ret = '<a href="' . IMBUILDING_URL . 'admin/module.php?op=createmodule&module_id=' . $this->id() . '">';
		$ret .= '<img src="' . ICMS_IMAGES_SET_URL . '/actions/down.png" style="vertical-align: middle;" ';
		$ret .= 'alt="' . _AM_IMBUILDING_CREATE_MODULE . '" title="' . _AM_IMBUILDING_CREATE_MODULE . '" /></a>';
		return $ret;
	}

	public function getObjects($asObject = TRUE) {
		$imbuilding_object_handler = icms_getModuleHandler('object');
		$ret = $imbuilding_object_handler->getObjectsForModule($this->id(), $asObject);
		return $ret;
	}

	public function getObjectsList() {
		return $this->getObjects(FALSE);
	}

	public function default_object() {
		$ret = $this->getVar('default_object', 'e');

		if ($ret == 0) {
			$objs = $this->getObjects(TRUE);
			if (count($objs) > 0) {
				$ret = strtolower($objs[0]->getVar('object_name'));
			}
		} else {
			$icms_persistable_registry = icms_ipf_registry_Handler::getInstance();
			$obj = $icms_persistable_registry->getSingleObject('object', $ret);
			if ($obj) {
				$ret = strtolower($obj->getVar('object_name'));
			}
		}

		return $ret;
	}

	/**
	 * Build the breadcrumb given a specific situation
	 *
	 * @param string $situation
	 * @return array of items
	 */
	public function getBreadcrumb($situation) {
		$items = array ();
		$items[0]['link'] = IMBUILDING_ADMIN_URL . 'module.php';
		$items[0]['caption'] = _AM_IMBUILDING_MODULES;

		switch ($situation) {
			case 'view':
				$items[1]['caption'] = $this->title();
			break;
			case 'form':
				if ($this->isNew()) {
					$items[1]['caption'] = _AM_IMBUILDING_MODULE_CREATE;
				} else {
					$items[1]['caption'] = $this->title();
					$items[1]['link'] = $this->getAdminViewItemLink(TRUE);
					$items[2]['caption'] = _AM_IMBUILDING_MODULE_EDIT;
				}
			break;
		}
		return $items;
	}
}
