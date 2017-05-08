<?php
/**
 * Add a note on a user
 *
 * Don't use annotations because they're meh.
 */

$user = get_user(get_input('user_guid', 0));
$note_text = get_input('note');

if (!$user || !$note_text) {
	register_error(elgg_echo('admin_notes:errors:could_not_add_note'));
	return;
}

$note = new ElggAdminNote();
$note->entity_guid = $user->guid;
$note->description = $note_text;
$note->original_username = $user->name;
$note->original_email = $user->email;
$note->original_name = $user->name;

if ($note->save()) {
	system_message(elgg_echo('admin_notes:messages:added_note'));
} else {
	register_error(elgg_echo('admin_notes:errors:could_not_add_note'));
}
