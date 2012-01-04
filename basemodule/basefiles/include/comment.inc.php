<?php
/**
 * Comment include file
 *
 * File holding functions used by the module to hook with the comment system of ImpressCMS
 *
 * @copyright	IMBUILDING_COPYRIGHT
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		IMBUILDING_TAG_AUTHOR_NAME <IMBUILDING_TAG_AUTHOR_EMAIL>
 * @package		basemodule
 * @version		$Id$
 */

function basemodule_com_update($item_id, $total_num) {
    $basemodule_post_handler = icms_getModuleHandler("post", basename(dirname(dirname(__FILE__))), "basemodule");
    $basemodule_post_handler->updateComments($item_id, $total_num);
}

function basemodule_com_approve(&$comment) {
    // notification mail here
}