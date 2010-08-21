<?php
/**
 *
 * @package ChatMod installation
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
 * The array of versions and actions within each.
 * You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
 *
 * You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
 * The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
 */
$versions = array(
	'0.0.1' => array(
		// Add the main chat table
		'table_add' => array(
			// The main Subject Prefix table
			array(CHAT_TABLE, array(
				'COLUMNS'	=> array(
					'id'					=> array('UINT', NULL, 'auto_increment'),
					'poster_id'				=> array('UINT', 0),
					'poster_ip'				=> array('VCHAR:40', ''),
					'chat_time'				=> array('UINT:11', 0),
					'chat_username'			=> array('VCHAR', ''),
					'chat_username_colour'	=> array('VCHAR:6', ''),
					'message'				=> array('MTEXT', NULL),
					'bbcode_bitfield'		=> array('VCHAR', ''),
					'bbcode_uid'			=> array('VCHAR', ''),
					'bbcode_options'		=> array('USINT', 7),
				),
				'PRIMARY_KEY'	=> 'id',
				'KEYS'			=> array(
					'time'		=> array('INDEX', 'chat_time'),
				),
			)),
		),
	),
);