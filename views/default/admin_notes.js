define(function (require) {
	var $ = require('jquery');
	var elgg = require('elgg');
	var Ajax = require('elgg/Ajax');

	var ajax = new Ajax();

	/**
	 * Pop up the add note dialogue
	 */
	function add_note(e) {
		e.preventDefault();

		var note = prompt(elgg.echo('admin_notes:add_note'));

		if (!note) {
			return false;
		}

		// click the body to clear out any context menus.
		$('body').click();

		ajax.action('admin_notes/add', {
			data: {
				note: note,
				user_guid: $(this).data().userGuid
			}
		});
	}

	$(document).on('click', '.elgg-menu-item-admin-notes-add > a', add_note);
});
