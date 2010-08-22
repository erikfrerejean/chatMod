<?php
/**
 *
 * @package ChatMod
 * @copyright (c) 2010 Erik Frèrejean ( erikfrerejean@phpbb.com ) http://www.erikfrerejean.nl
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

// Variable used to output data back to the controller
$_responce = '';

$chat = chatMod_core::get_instance();

// Handle
switch ($_REQUEST['mode'])
{
	case 'submit' :
		$_responce = $chat->handle_submit();
	break;
}

// Output
header('Cache-Control: no-cache, must-revalidate');
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time()));
header('Content-type: application/json');
print($_responce);