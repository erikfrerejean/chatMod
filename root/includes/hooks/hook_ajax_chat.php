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
		$phpbb_hook->register(array('template', 'display'), 'hook_ajax_chat::_set_global_template_vars');
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
		require $phpbb_root_path . 'includes/mods/ajax_chat/ajax_chat_JSON.' . $phpEx;

		// Load all the required classes
		ajax_chat_phpbb::init();
		ajax_chat_core::get_instance();
	}

	/**
	 * Just before the page gets outputted this hook sets some required template vars
	 * @param	phpbb_hook	$phpbb_hook	The phpBB hook object
	 * @return	void
	 */
	static public function _set_global_template_vars(phpbb_hook $phpbb_hook)
	{
		$web_path = (defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? generate_board_url() . '/' : PHPBB_ROOT_PATH;

		ajax_chat_phpbb::$template->assign_vars(array(
			'T_AJAX_CHAT_SCRIPTS_PATH'	=> "{$web_path}styles/scripts",
		));
	}
}

hook_ajax_chat::register($phpbb_hook);