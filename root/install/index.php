<?php
/**
 *
 * @package Ajax Chat Installation
 * @copyright (c) 2010 Erik Frèrejean ( erikfrerejean@phpbb.com ) http://www.erikfrerejean.nl
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
<?php
/**
 *
 * @author Erik Frèrejean (erikfrerejean@phpbb.com) http://www.erikfrerejean.nl
 *
 * @package phpBB3
 * @copyright (c) 2010 Erik Frèrejean
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
define('IN_INSTALL', true);
PHPBB_ROOT_PATH = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
PHP_EXT = substr(strrchr(__FILE__, '.'), 1);
include(PHPBB_ROOT_PATH . 'common.' . PHP_EXT);

// Its possible the hook isn't loaded at this point. If that is the case do it manually
if (!class_exists('hook_ajax_chat'))
{
	require PHPBB_ROOT_PATH . 'includes/hooks/hook_ajax_chat.' . PHP_EXT;
}

ajax_chat_phpbb::$user->session_begin();
ajax_chat_phpbb::$auth->acl(ajax_chat_phpbb::$user->data);
ajax_chat_phpbb::$user->setup();

if (!file_exists(PHPBB_ROOT_PATH . 'umil/umil_auto.' . PHP_EXT))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'AJAX_CHAT';

/**
 * The name of the config variable which will hold the currently installed version
 * You do not need to set this yourself, UMIL will handle setting and updating the version itself.
 */
$version_config_name = 'ajax_chat_version';

/**
 * The language file which will be included when installing
 */
$language_file = 'mods/ajax_chat/install';

// Get version info
include(PHPBB_ROOT_PATH . 'install/versions.' . PHP_EXT);

// Include the UMIF Auto file and everything else will be handled automatically.
include(PHPBB_ROOT_PATH . 'umil/umil_auto.' . PHP_EXT);

// clear cache
$umil->cache_purge(array(
	array(''),
	array('auth'),
	array('template'),
	array('theme'),
));