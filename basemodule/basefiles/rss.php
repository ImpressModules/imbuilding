<?php
/**
 * Generating an RSS feed
 *
 * @copyright	IMBUILDING_COPYRIGHT
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		IMBUILDING_TAG_AUTHOR_NAME <IMBUILDING_TAG_AUTHOR_EMAIL>
 * @package		basemodule
 * @version		$Id$
 */

/** Include the module's header for all pages */
include_once 'header.php';
include_once ICMS_ROOT_PATH . '/header.php';

/** To come soon in imBuilding...

$clean_post_uid = isset($_GET['uid']) ? intval($_GET['uid']) : FALSE;

$basemodule_feed = new icms_feeds_Rss();

$basemodule_feed->title = $icmsConfig['sitename'] . ' - ' . icms::$module->name();
$basemodule_feed->url = XOOPS_URL;
$basemodule_feed->description = $icmsConfig['slogan'];
$basemodule_feed->language = _LANGCODE;
$basemodule_feed->charset = _CHARSET;
$basemodule_feed->category = icms::$module->name();

$basemodule_post_handler = icms_getModuleHandler("post", basename(dirname(__FILE__)), "basemodule");
//BasemodulePostHandler::getPosts($start = 0, $limit = 0, $post_uid = FALSE, $year = FALSE, $month = FALSE
$postsArray = $basemodule_post_handler->getPosts(0, 10, $clean_post_uid);

foreach($postsArray as $postArray) {
	$basemodule_feed->feeds[] = array (
	  'title' => $postArray['post_title'],
	  'link' => str_replace('&', '&amp;', $postArray['itemUrl']),
	  'description' => htmlspecialchars(str_replace('&', '&amp;', $postArray['post_lead']), ENT_QUOTES),
	  'pubdate' => $postArray['post_published_date_int'],
	  'guid' => str_replace('&', '&amp;', $postArray['itemUrl']),
	);
}

$basemodule_feed->render();
*/