$(function() {
	$('a.admin_notes_add').click(function() {
		var note = prompt('<?php echo elgg_echo('admin_notes:add_note'); ?>', '');

		if (!note) {
			return false;
		}

		var href = $(this).attr('href');

		// construct a form to submit.
		// a bit cleaner (?) than submitting via ajax then reloading the page.
		var form = document.createElement('form');
		form.action = href;
		form.method = 'POST';

		var note_element = document.createElement('input')
		note_element.name = 'note';
		note_element.value = note;
		form.appendChild(note_element);

		form.submit();

		return false;
	});
});
