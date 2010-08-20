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
if (!defined('IN_PHPBB') || !defined('IN_CHAT'))
{
	exit;
}

/**
 * The main Chat class
 * @package ChatMod
 */
class chatMod_core
{
	/**
	 * Holding an object of itself
	 */
	private static $chatMOD_core = null;

	/**
	 * Private class constructor.
	 */
	private function __construct()
	{
		// Include the main language file
		chatMod_phpbb::$user->add_lang('mods/chatMod/common');

		// Load the constants
		require PHPBB_ROOT_PATH . 'includes/mods/chatMod/constants.' . PHP_EXT;
	}

	/**
	 * Get an instance of this class. Acts as a singleton loader
	 */
	public static function get_instance()
	{
		if ((self::$chatMOD_core instanceof chatMod_core) === false)
		{
			self::$chatMOD_core = new chatMod_core();
		}

		return self::$chatMOD_core;
	}
}