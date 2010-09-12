<?php
/**
 * Add a note on a user
 *
 * Don't use annotations because they're meh.
 */

$user_guid = get_input('user_guid', 0);
$user = get_user($user_guid);
$note_text = get_input('note');

if (!$user || !$note_text) {
	register_error(elgg_echo('user_notes:errors:could_not_add_note'));
	forward(REFERER);
}

$note = new ElggAdminNote();
$note->entity_guid = $user_guid;
$note->description = $note_text;

if ($note->save()) {
	system_message(elgg_echo('user_notes:messages:added_note'));
} else {
	register_error(elgg_echo('user_notes:errors:could_not_add_note'));
}

forward(REFERER);