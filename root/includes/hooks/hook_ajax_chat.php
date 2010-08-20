<?php
/**
 *
 * @package Ajax Chat
 * @copyright (c) 2010 Erik Frèrejean ( erikfrerejean@phpbb.com ) http://www.erikfrerejean.nl
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Class that control all used hooks
 * @package Ajax Chat
 */
abstract class hook_ajax_chat
{
	/**
	 * Method that registers all hooks
	 * @param	phpbb_hook	$phpbb_hook	The phpBB hook object
	 * @return	void
	 */
	static public function register(phpbb_hook &$phpbb_hook)
	{
		// Hooks are being loaded, chat can be used
		define ('IN_CHAT', true);

		// Register all the hooks
		$phpbb_hook->register('phpbb_user_session_handler', 'hook_ajax_chat::_init');
	}

	/**
	 * The main loader
	 * @param	phpbb_hook	$phpbb_hook	The phpBB hook object.
	 * @return	void
	 */
	static public function _init(phpbb_hook $phpbb_hook)
	{
		global $phpbb_root_path, $phpEx;

		// Include all files we need no matter what
		require $phpbb_root_path . 'includes/mods/ajax_chat/ajax_chat_core.' . $phpEx;
		require $phpbb_root_path . 'includes/mods/ajax_chat/ajax_chat_phpbb.' . $phpEx;

		// Load all the required classes
		ajax_chat_phpbb::init();
		ajax_chat_core::get_instance();
	}
}

hook_ajax_chat::register($phpbb_hook);