$(document).ready(function()
{
	// Bind handler to the button
	$('#chat-submit').click(function(){
		var handler = $('#chat_box_form').attr('action');

		// Post this
		$.ajax({
			type:		'POST',
			url:		handler,
			data:		$('#chat_box_form').serialize(),
			dataType:	'json',
			success:	function(json) {
//				// Determine the bg colour for this row.
//				var $_bg = $('#chat_box > li:first').hasClass('bg1') ? 'bg2' : 'bg1';
//
				// Build the container
				var $_id = 'c' + json.chat_id;
				var $_container = $('#chatProtoType').clone().attr('id', $_id);
				$('#chat_box').prepend($_container);
//
//				// Set the background colour
//				$('#' + $_id).addClass($_bg);
//
				// Add the chat
				$('.chat-content', $('#' + $_id)).html(json.chat);
				$('.chatter', $('#' + $_id)).html(json.poster + '<br />' + json.time);

				// Make it visable
				$('#' + $_id).css('display', 'block');

			},
		});

		// Don't follow the form

		return false;
	});
});