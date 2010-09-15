$(function() {
	$('a.admin_notes_add').click(function() {
		var note = prompt('<?php echo elgg_echo('admin_notes:add_note'); ?>', '');

		if (!note) {
			return false;
		}

		// click the body to clear out any context menus.
		$('body').click();

		var href = $(this).attr('href');

		$.post(href, {'note': note}, function(data, status, xhr) {
			if (status == 'success') {
				// popup and fade a status message at the top of the viewport
				var top = $().scrollTop() + 5;
				var messages_class = (data.result == 'success') ? 'messages' : 'messages_error';
				var message = '<div style="top: ' + top + 'px;" class="admin_notes_status ' + data.result + '">'
					+ '<div style="opacity: 1;" class="admin_note_message ' + messages_class + '"><p></p>'
					+ '<p>' + data.message + '</p><p></p></div></div>';

				$('body').append(message);

				setTimeout("$('.admin_notes_status').fadeOut('slow')", 1500);
			}
		}, 'json');

		return false;
	});
});