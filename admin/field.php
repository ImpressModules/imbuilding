<?php
/**
 * Admin page to manage modules
 *
 * List, add, edit and delete module objects
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

/**
 * Edit a Field
 *
 * @param int $field_id Fieldid to be edited
*/
function editfield($fieldObj) {
	global $icmsModule, $icmsAdminTpl, $clean_object_id;

	$new_module = isset($_GET['newmodule']) ? (int)$_GET['newmodule'] : FALSE;

	$module_id = $object_id = FALSE;
	$imbuilding_object_handler = icms_getModuleHandler("object", basename(dirname(dirname(__FILE__))), "imbuilding");
	$objectObj = $imbuilding_object_handler->get($clean_object_id);
	if (!$objectObj->isNew()) {
		$module_id = $objectObj->getVar("module_id");
		$object_id = $objectObj->getVar("object_id");
	}

	$fieldObj->setControl('field_refer', array(
		'itemHandler' => 'object',
		'method' => 'getObjectsReferList',
		'module' => 'imbuilding',
		'params' => array($module_id, $object_id)));

	if (!$fieldObj->isNew()) {
		$icmsModule->displayAdminMenu(0, _AM_IMBUILDING_FIELDS . " > " . _CO_ICMS_EDITING);
		$sform = $fieldObj->getForm(_AM_IMBUILDING_FIELD_EDIT, 'addfield');
		$sform->assign($icmsAdminTpl);
	} else {
		if ($new_module == 1) {
			$fieldObj->setVar('new_module_wizard', TRUE);
			$fieldObj->setVar('another', TRUE);
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_FIELD_CREATE_WIZARD);
			$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_FIELD_CREATE_WIZARD_INFO);
		} elseif ($new_module == 2) {
			$fieldObj->setVar('new_module_wizard', TRUE);
			$fieldObj->setVar('another', TRUE);
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_FIELD_CREATE_WIZARD2);
			$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_FIELD_CREATE_WIZARD2_INFO);
		} else {
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_FIELD_CREATE);
		}

		$fieldObj->setVar('object_id', $clean_object_id);
		$icmsModule->displayAdminMenu(0, _AM_IMBUILDING_FIELDS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $fieldObj->getForm(_AM_IMBUILDING_FIELD_CREATE, 'addfield');
		$sform->assign($icmsAdminTpl);
	}
	$icmsAdminTpl->assign('modules_breadcrumb', icms_getBreadcrumb($fieldObj->getBreadcrumb('form')));
	$icmsAdminTpl->display('db:imbuilding_admin_field.html');
}

include_once "admin_header.php";

$imbuilding_field_handler = icms_getModuleHandler('field', basename(dirname(dirname(__FILE__))));
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array('mod', 'changedField', 'addfield', 'del', 'view', '');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_field_id = isset($_GET['field_id']) ? (int)$_GET['field_id'] : 0 ;
$clean_object_id = isset($_GET['object_id']) ? (int)$_GET['object_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
*/
if (in_array($clean_op, $valid_op, TRUE)){
	switch ($clean_op) {
		case "mod":
		case "changedField":
			icms_cp_header();
			$fieldObj = $imbuilding_field_handler->get($clean_field_id);
			editfield($fieldObj);
			break;

		case "addfield":
			$controller = new icms_ipf_Controller($imbuilding_field_handler);
			$controller->storeFromDefaultForm(_AM_IMBUILDING_FIELD_CREATED, _AM_IMBUILDING_FIELD_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($imbuilding_field_handler);
			$controller->handleObjectDeletion();
			break;

		case "view" :
			$imbuilding_object_handler = icms_getModuleHandler('object');
			$fieldObj = $imbuilding_field_handler->get($clean_field_id);

			icms_cp_header();
			$icmsModule->displayAdminMenu(0, _AM_IMBUILDING_FIELD_VIEW . ' > ' . $fieldObj->getVar('field_name'));
			$icmsAdminTpl->assign('imbuilding_field_singleview', $fieldObj->displaySingleObject(TRUE));
			$criteria = new icms_db_criteria_Compo();
			$criteria->add(new icms_db_criteria_Item('field_id', $clean_field_id));
			$objectTable = new icms_ipf_view_Table($imbuilding_object_handler, $criteria);
			$objectTable->addColumn(new icms_ipf_view_Column('object_name', _GLOBAL_LEFT, FALSE, 'getAdminViewItemLink'));
			$objectTable->addColumn(new icms_ipf_view_Column('object_desc'));
			$objectTable->addIntroButton('addobject', 'object.php?op=mod&field_id=' . $clean_field_id, _AM_IMBUILDING_OBJECT_CREATE);
			$icmsAdminTpl->assign('imbuilding_object_table', $objectTable->fetch());
			$icmsAdminTpl->assign('modules_breadcrumb', icms_getBreadcrumb($fieldObj->getBreadcrumb('view')));
			$icmsAdminTpl->display('db:imbuilding_admin_field.html');
			break;

		default:
			icms_cp_header();
			$icmsModule->displayAdminMenu(0, _AM_IMBUILDING_FIELDS);
			$objectTable = new icms_ipf_view_Table($imbuilding_field_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('field_name', _GLOBAL_LEFT, FALSE, 'getAdminViewItemLink'));
			$objectTable->addColumn(new icms_ipf_view_Column('author_name'));
			$objectTable->addIntroButton('addfield', 'field.php?op=mod', _AM_IMBUILDING_FIELD_CREATE);
			$icmsAdminTpl->assign('imbuilding_field_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:imbuilding_admin_field.html');
			break;
	}
	icms_cp_footer();
}