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
 * Class that is used to replace/mimic phpBB specific functions. This class
 * also contains static instances of the main phpBB objects/variables so they
 * don't have to be globalised everywhere
 * @package ChatMod
 */
abstract class chatMod_phpbb
{
	/**@#+
	 * @var mixed all the phpBB common used objects
	 */
	static public $auth		= null;
	static public $cache	= null;
	static public $config	= array();
	static public $db		= null;
	static public $template	= null;
	static public $user		= null;
	/**@#-*/

	/**
	 * Initialise this object
	 * @return void
	 */
	static public function init()
	{
		// Run only once
		if (self::$cache instanceof acm)
		{
			return;
		}

		// Set the phpBB objects
		global $auth, $config, $cache, $db, $template, $user;
		self::$auth		= &$auth;
		self::$cache	= &$cache;
		self::$config	= &$config;
		self::$db		= &$db;
		self::$template	= &$template;
		self::$user		= &$user;

		// Create constants out of $phpbb_root_path and $phpEx
		global $phpbb_root_path, $phpEx;
		if (!defined('PHPBB_ROOT_PATH'))
		{
			define('PHPBB_ROOT_PATH', $phpbb_root_path);
		}

		if (!defined('PHP_EXT'))
		{
			define('PHP_EXT', $phpEx);
		}

		if (!defined('WEB_ROOT'))
		{
			// Used for links
			define('WEB_ROOT', './');
		}
	}

	/**
	 * Wrapper to switch phpBB variables between their different forms that are
	 * used by this MOD.
	 * @param	String	$var	The variable to switch
	 * @return	void
	 */
	static public function switch_phpbb_var($var)
	{
		switch ($var)
		{
			// Switch $phpbb_root_path between PHPBB_ROOT_PATH and WEB_ROOT
			case 'phpbb_root_path' :
				global $phpbb_root_path;

				// Switch it
				if ($phpbb_root_path == PHPBB_ROOT_PATH)
				{
					$phpbb_root_path = WEB_ROOT;
				}
				else if ($phpbb_root_path == WEB_ROOT)
				{
					$phpbb_root_path = PHPBB_ROOT_PATH;
				}
			break;
		}
	}
}