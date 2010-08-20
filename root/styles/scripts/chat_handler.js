$(document).ready(function()
{
	// Bind handler to the button
	$('#chat-submit').click(function(){
		var handler = $('#chat_box').attr('action');

		// Post this
		$.ajax({
			type:		'POST',
			url:		handler,
			data:		$('#chat_box').serialize(),
			success:	function(html) {
				alert(html);
			},
			dataType:	'JSON',
		});

		// Don't follow the form
		return false;
	});
});