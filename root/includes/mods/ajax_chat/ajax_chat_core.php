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
if (!defined('IN_PHPBB') || !defined('IN_CHAT'))
{
	exit;
}

/**
 * The main Ajax Chat class
 * @package Ajax Chat
 */
class ajax_chat_core
{
	/**
	 * Holding an object of itself
	 */
	private static $ajax_chat_core = null;

	/**
	 * Private class constructor.
	 */
	private function __construct()
	{
		// Include the main language file
		ajax_chat_phpbb::$user->add_lang('mods/ajax_chat/common');

		// Load the constants
		require PHPBB_ROOT_PATH . 'includes/mods/ajax_chat/constants.' . PHP_EXT;
	}

	/**
	 * Get an instance of this class. Acts as a singleton loader
	 */
	public static function get_instance()
	{
		if ((self::$ajax_chat_core instanceof ajax_chat_core) === false)
		{
			self::$ajax_chat_core = new ajax_chat_core();
		}

		return self::$ajax_chat_core;
	}
}