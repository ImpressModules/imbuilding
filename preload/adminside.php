<?php
/**
 * Adding a few things in admin
 *
 * @copyright	The ImpressCMS Project http://www.impresscms.org/
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @package		libraries
 * @since		1.1
 * @author		marcan <marcan@impresscms.org>
 * @version		$Id$
 */

class IcmsPreloadAdminside extends icms_preload_Item {
	public function eventAdminHeader() {
		global $xoTheme;
		$xoTheme->addStylesheet(IMBUILDING_ADMIN_URL . "/admin.css", array("media" => "screen"));
	}
}