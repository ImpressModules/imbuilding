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
 * Edit a Module
 *
 * @param int $module_id Moduleid to be edited
*/
function editmodule($module_id = 0) {
	global $imbuilding_module_handler, $icmsAdminTpl;

	$moduleObj = $imbuilding_module_handler->get($module_id);

	if (!$moduleObj->isNew()){
        //icms::$module->displayAdminMenu(0, _AM_IMBUILDING_MODULES . " > " . _CO_ICMS_EDITING);
		$sform = $moduleObj->getForm(_AM_IMBUILDING_MODULE_EDIT, 'addmodule');
		$sform->assign($icmsAdminTpl);
	} else {
		$moduleObj->hideFieldFromForm('default_object');
        //icms::$module->displayAdminMenu(0, _AM_IMBUILDING_MODULES . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $moduleObj->getForm(_AM_IMBUILDING_MODULE_CREATE, 'addmodule');
		$sform->assign($icmsAdminTpl);

		$icmsAdminTpl->assign('imbuilding_form_header', _AM_IMBUILDING_MODULE_CREATE);
		$icmsAdminTpl->assign('imbuilding_form_header_info', _AM_IMBUILDING_MODULE_CREATE_INFO);

	}
	$icmsAdminTpl->assign('modules_breadcrumb', icms_getBreadcrumb($moduleObj->getBreadcrumb('form')));
	$icmsAdminTpl->display('db:imbuilding_admin_module.html');
}

include_once "admin_header.php";

$imbuilding_module_handler = icms_getModuleHandler('module');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = 'list';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('list', 'mod', 'addmodule', 'del', 'view', 'createmodule', 'changedField');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_module_id = isset($_GET['module_id']) ? (int)$_GET['module_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
*/
if (in_array($clean_op, $valid_op, TRUE)){
	switch ($clean_op) {
		case "changedField":
			$imbuilding_object_handler = icms_getModuleHandler('object');
			foreach ($_POST['mod_imbuilding_Object_objects'] as $k => $v){
				$obj = $imbuilding_object_handler->get($v);
				if ($obj->getVar('sort','e') != $_POST['sort'][$k]){
					$obj->setVar('sort', (int)$_POST['sort'][$k]);
					$imbuilding_object_handler->insert($obj);
				}
			}
			redirect_header('module.php?op=view&amp;module_id=' . (int)$_GET['module_id'], 2, _AM_IMBUILDING_OBJECT_MODIFIED);
			break;

		case 'createmodule':
			icms_cp_header();
			$moduleObj = $imbuilding_module_handler->get($clean_module_id);

            //icms::$module->displayAdminMenu(0, _AM_IMBUILDING_MODULE_GENERATION . ' > ' . $moduleObj->getVar('module_name'));


			$moduleObj = $imbuilding_module_handler->get($clean_module_id);
			$newModule = new mod_imbuilding_Newmodule($moduleObj);
			$newModule->create();

			$icmsAdminTpl->assign('imbuilding_new_module', TRUE);
			$icmsAdminTpl->assign('imbuilding_module_title', _AM_IMBUILDING_MODULE_GENERATED_TITLE);
			$icmsAdminTpl->assign('imbuilding_module_created_info', sprintf(_AM_IMBUILDING_MODULE_GENERATED_NOZIP, ICMS_CACHE_PATH . '/imbuilding/' . $newModule->moduleinfo['modulename']));
			$icmsAdminTpl->assign('imbuilding_new_module_log', $newModule->displayLog());
			$icmsAdminTpl->assign('imbuilding_new_module_url', $newModule->archiveUrl);
			$icmsAdminTpl->display('db:imbuilding_admin_module.html');
			break;

		case 'mod':
			icms_cp_header();
			editmodule($clean_module_id);
			break;

		case 'addmodule':
			$controller = new icms_ipf_Controller($imbuilding_module_handler);
			$controller->storeFromDefaultForm(_AM_IMBUILDING_MODULE_CREATED, _AM_IMBUILDING_MODULE_MODIFIED);
			break;

		case 'del':
			$controller = new icms_ipf_Controller($imbuilding_module_handler);
			$controller->handleObjectDeletion();
			break;

		case 'view' :
			$imbuilding_object_handler = icms_getModuleHandler('object');
			$moduleObj = $imbuilding_module_handler->get($clean_module_id);

			icms_cp_header();
            //icms::$module->displayAdminMenu(0, _AM_IMBUILDING_MODULE_VIEW . ' > ' . $moduleObj->getVar('module_name'));
			$icmsAdminTpl->assign('imbuilding_module_singleview', $moduleObj->displaySingleObject(TRUE));
			$criteria = new icms_db_criteria_Compo();
			$criteria->add(new icms_db_criteria_Item('module_id', $clean_module_id));
			$objectTable = new icms_ipf_view_Table($imbuilding_object_handler, $criteria);
			$objectTable->addColumn(new icms_ipf_view_Column('object_name', _GLOBAL_LEFT, FALSE, 'getAdminViewItemLink'));
			$objectTable->addColumn(new icms_ipf_view_Column('object_desc'));
			$objectTable->addColumn(new icms_ipf_view_Column("sort", "center", 150, "getObjectSortControl"));
			$objectTable->addIntroButton('addobject', 'object.php?op=mod&module_id=' . $clean_module_id, _AM_IMBUILDING_OBJECT_CREATE);
			$objectTable->addActionButton("changedField", FALSE, _SUBMIT);
			$objectTable->setDefaultSort("sort");
			$icmsAdminTpl->assign('imbuilding_object_table', $objectTable->fetch());
			$icmsAdminTpl->assign('modules_breadcrumb', icms_getBreadcrumb($moduleObj->getBreadcrumb('view')));
			$icmsAdminTpl->display('db:imbuilding_admin_module.html');
			break;

		default:
			icms_cp_header();

            //icms::$module->displayAdminMenu(0, _AM_IMBUILDING_MODULES);

			$objectTable = new icms_ipf_view_Table($imbuilding_module_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('module_name', _GLOBAL_LEFT, FALSE, 'getAdminViewItemLink'));
			$objectTable->addColumn(new icms_ipf_view_Column('author_name'));
			$objectTable->addIntroButton('addmodule', 'module.php?op=mod', _AM_IMBUILDING_MODULE_CREATE);
			$objectTable->addCustomAction('getCreateModuleLink');
			$icmsAdminTpl->assign('imbuilding_module_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:imbuilding_admin_module.html');
			break;
	}
	icms_cp_footer();
}
