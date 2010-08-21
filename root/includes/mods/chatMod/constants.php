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

//-- Tables
global $table_prefix;
define('CHAT_TABLE',				$table_prefix . 'chat');