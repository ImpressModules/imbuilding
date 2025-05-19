<?php
/**
 * Admin page to manage objects
 *
 * List, add, edit and delete object objects
 *
 * @copyright	http://smartfactory.ca The SmartFactory
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		marcan aka Marc-André Lanciault <marcan@smartfactory.ca>
 * @version		$Id$
 */

/**
 * Edit a Module
 *
 * @param int $object_id Moduleid to be edited
*/
function editobject($object_id = 0, $finishing = FALSE) {
	global $imbuilding_object_handler, $icmsAdminTpl, $clean_module_id;

	$new_module = isset($_GET['newmodule']) && (int)$_GET['newmodule'] == 1;

	$objectObj = $imbuilding_object_handler->get($object_id);

	if (!$objectObj->isNew()){
		icms::$module->displayAdminMenu(0, _AM_IMBUILDING_OBJECTS . " > " . _CO_ICMS_EDITING);
		if ($finishing) {
			$objectObj->hideFieldFromForm(array('module_id', 'object_name', 'object_desc', 'object_counter', 'object_dohtml', 'object_dobr', 'object_doimage', 'object_dosmiley', 'object_doxcode', 'enable_seo'));
			$objectObj->setVar('new_module_wizard', TRUE);
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_OBJECT_EDIT_FINILIZE);
			$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_OBJECT_EDIT_FINILIZE_INFO);
		} else  {
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_OBJECT_EDIT);
			$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_OBJECT_EDIT_INFO);
		}
		$sform = $objectObj->getForm(_AM_IMBUILDING_OBJECT_EDIT, 'addobject');
		$sform->assign($icmsAdminTpl);

	} else {
		if ($new_module) {
			$objectObj->setVar('new_module_wizard', TRUE);
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_OBJECT_CREATE_WIZARD);
			$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_OBJECT_CREATE_WIZARD_INFO);
		} else {
			$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_OBJECT_CREATE);
			$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_OBJECT_CREATE_INFO);
		}
		$objectObj->hideFieldFromForm(array('object_identifier_name', 'object_identifier_desc'));
		$objectObj->setVar('module_id', $clean_module_id);
		icms::$module->displayAdminMenu(0, _AM_IMBUILDING_OBJECTS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $objectObj->getForm(_AM_IMBUILDING_OBJECT_CREATE, 'addobject');
		$sform->assign($icmsAdminTpl);
	}
	$icmsAdminTpl->assign('modules_breadcrumb', icms_getBreadcrumb($objectObj->getBreadcrumb('form')));
	$icmsAdminTpl->display('db:imbuilding_admin_object.html');
}

include_once "admin_header.php";

$imbuilding_object_handler = icms_getModuleHandler('object');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod', 'finishing', 'addobject', 'del', 'view', '');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_object_id = isset($_GET['object_id']) ? (int)$_GET['object_id'] : 0 ;
$clean_module_id = isset($_GET['module_id']) ? (int)$_GET['module_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
*/
if (in_array($clean_op, $valid_op, TRUE)){
	switch ($clean_op) {
		case "mod":
		case "finishing":
			icms_cp_header();
			editobject($clean_object_id, $clean_op=='finishing');
			break;

		case "addobject":
			$controller = new icms_ipf_Controller($imbuilding_object_handler);
			$controller->storeFromDefaultForm(_AM_IMBUILDING_OBJECT_CREATED, _AM_IMBUILDING_OBJECT_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($imbuilding_object_handler);
			$controller->handleObjectDeletion();
			break;

		case "view" :
			$imbuilding_field_handler = icms_getModuleHandler('field');
			$objectObj = $imbuilding_object_handler->get($clean_object_id);

			icms_cp_header();
			icms::$module->displayAdminMenu(0, _AM_IMBUILDING_OBJECT_VIEW . ' > ' . $objectObj->getVar('object_name'));
			$icmsAdminTpl->assign('imbuilding_object_singleview', $objectObj->displaySingleObject(TRUE));
			$criteria = new icms_db_criteria_Compo();
			$criteria->add(new icms_db_criteria_Item('object_id', $clean_object_id));
			$objectTable = new icms_ipf_view_Table($imbuilding_field_handler, $criteria);
			$objectTable->addColumn(new icms_ipf_view_Column('field_name', _GLOBAL_LEFT, FALSE, 'getAdminViewItemLink'));
			$objectTable->addColumn(new icms_ipf_view_Column('field_caption'));
			$objectTable->addColumn(new icms_ipf_view_Column('field_type'));
			$objectTable->addIntroButton('addfield', 'field.php?op=mod&object_id=' . $clean_object_id, _AM_IMBUILDING_FIELD_CREATE);
			$icmsAdminTpl->assign('imbuilding_field_table', $objectTable->fetch());
			$icmsAdminTpl->assign('modules_breadcrumb', icms_getBreadcrumb($objectObj->getBreadcrumb('view')));
			$icmsAdminTpl->display('db:imbuilding_admin_object.html');
			break;

		default:
			icms_cp_header();
			icms::$module->displayAdminMenu(0, _AM_IMBUILDING_OBJECTS);
			$objectTable = new icms_ipf_view_Table($imbuilding_object_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('object_name', _GLOBAL_LEFT, FALSE, 'getAdminViewItemLink'));
			$objectTable->addColumn(new icms_ipf_view_Column('author_name'));
			$objectTable->addIntroButton('addobject', 'object.php?op=mod', _AM_IMBUILDING_OBJECT_CREATE);
			$icmsAdminTpl->assign('imbuilding_object_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:imbuilding_admin_object.html');
			break;
	}
	icms_cp_footer();
}