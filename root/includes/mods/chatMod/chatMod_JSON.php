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
 * A class to handle JSON data
 * @package ChatMod
 */
abstract class chatMod_JSON
{
	/**
	 * Build JSON string
	 * @param	mixed	$data	The data that will be converted
	 * @return	String	The JSON string
	 */
	static public function _encode($data)
	{
		return json_encode($data);
	}
}