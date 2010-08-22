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
	 * The current timestamp
	 */
	public $now = 0;

	/**
	 * Private class constructor.
	 */
	private function __construct()
	{
		// Include the main language file
		chatMod_phpbb::$user->add_lang('mods/chatMod/common');

		// Load the constants
		require PHPBB_ROOT_PATH . 'includes/mods/chatMod/constants.' . PHP_EXT;

		// Set now
		$this->now = getdate(time() + chatMod_phpbb::$user->timezone + chatMod_phpbb::$user->dst - date('Z'));
	}

	/**
	 * Get an instance of this class. Acts as a singleton loader
	 */
	static public function get_instance()
	{
		if ((self::$chatMOD_core instanceof chatMod_core) === false)
		{
			self::$chatMOD_core = new chatMod_core();
		}

		return self::$chatMOD_core;
	}

	/**
	 * A user submitted a chat message, handle and store the message
	 * @return String JSON element with all required data
	 */
	public function handle_submit()
	{
		if (!class_exists('parse_message'))
		{
			// Bit hacky but else the message parser breaks :/
			$phpbb_root_path = PHPBB_ROOT_PATH;
			$phpEx = PHP_EXT;

			require PHPBB_ROOT_PATH . 'includes/message_parser.' . PHP_EXT;
		}
		$chat_parser = new parse_message();

		// Get the message
		$chat_parser->message = utf8_normalize_nfc(request_var('message', '', true));

		// Parse it
		$chat_parser->parse(true, true, true);

		// Post the chat
		$sql_data = array(
			'id'					=> NULL,
			'poster_id'				=> chatMod_phpbb::$user->data['user_id'],
			'poster_ip'				=> chatMod_phpbb::$user->ip,
			'chat_time'				=> $this->now[0],
			'chat_username'			=> chatMod_phpbb::$user->data['username'],
			'chat_username_colour'	=> chatMod_phpbb::$user->data['user_colour'],
			'message'				=> $chat_parser->message,
			'bbcode_bitfield'		=> $chat_parser->bbcode_bitfield,
			'bbcode_uid'			=> $chat_parser->bbcode_uid,
			// @todo make ACP configurable
			'bbcode_options'		=> 7,
		);
		$sql = 'INSERT INTO ' . CHAT_TABLE . ' ' . chatMod_phpbb::$db->sql_build_array('INSERT', $sql_data);
		chatMod_phpbb::$db->sql_query($sql);

		// Now second pass it
		$chat_parser->message = censor_text($chat_parser->message);
		$chat_parser->bbcode_second_pass($chat_parser->message, $chat_parser->bbcode_uid, $chat_parser->bbcode_bitfield);

		// Create the JSON data set
		$JSON = array(
			'chat_id'	=> chatMod_phpbb::$db->sql_nextid(),
			'chat'		=> $chat_parser->message,
			'poster'	=> get_username_string('full', chatMod_phpbb::$user->data['user_id'], chatMod_phpbb::$user->data['username'], chatMod_phpbb::$user->data['user_colour']),
		);

		return chatMod_JSON::_encode($JSON);
	}
}