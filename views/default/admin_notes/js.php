//<script>

elgg.provide('elgg.admin_notes');

/**
 * Register the hover menu item JS
 */
elgg.admin_notes.init = function() {
	$('.elgg-menu-item-admin-notes-add > a').click(elgg.admin_notes.addNote);
}

/**
 * Pop up the add note dialogue
 */
elgg.admin_notes.addNote = function(e) {
	e.preventDefault();
	
	var note = prompt(elgg.echo('admin_notes:add_note'));

	if (!note) {
		return false;
	}

	// click the body to clear out any context menus.
	$('body').click();

	var href = $(this).attr('href');

	$.post(href, {'note': note}, function(data, status, xhr) {
		if (status == 'success') {
			if (data.result == 'success') {
				elgg.system_message(data.message);
			} else {
				elgg.register_error(data.message);
			}
		} else {
			elgg.register_error(elgg.echo('admin_notes:errors:could_not_add_note'))
		}
	}, 'json');
}

elgg.register_hook_handler('init', 'system', elgg.admin_notes.init);