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
				// Build the container
				var $_id = 'c' + json.chat_id;
				var $_container = $('#chatProtoType').clone().attr('id', $_id);
				$('#chat_box').prepend($_container);

				// Add the chat
				$('.chat-content', $('#' + $_id)).html(json.chat);
				$('.chatter', $('#' + $_id)).html(json.poster);

				// Make it visable
				$('#' + $_id).css('display', 'inline');
			},
		});

		// Don't follow the form

		return false;
	});
});