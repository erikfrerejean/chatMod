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
//				alert(json.chat_id);
//				$.each(json, function(key, value) {
					// Generate all parts
					var $_container	= $('<div></div>').attr('id', 'c' + json.chat_id).attr('class', 'post');
					var $_body		= $('<div></div>').attr('class', 'postbody');
					var $_post_box	= $('<p></p>').attr('class', 'content');

					// Create the whole element
					$_post_box.text(json.chat);
					$_body.append($_post_box);
					$_container.append($_body);

					// Attach to the chat
					$('#chat_box').prepend($_container);
//	<div id="p{chatrow.MESSAGE_ID}" class="post bg{chatrow.CLASS}">

//					alert(key + "\t" + value);
//				});
			},
		});

		// Don't follow the form

		return false;
	});
});