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
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Class that control all used hooks
 * @package ChatMod
 */
abstract class hook_chatMod
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
		$phpbb_hook->register('phpbb_user_session_handler', 'hook_chatMod::_init');
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
		require $phpbb_root_path . 'includes/mods/chatMod/chatMod_core.'. $phpEx;
		require $phpbb_root_path . 'includes/mods/chatMod/chatMod_phpBB.' . $phpEx;

		// Load all the required classes
		chatMod_phpbb::init();
		chatMod_core::get_instance();
	}
}

hook_chatMod::register($phpbb_hook);