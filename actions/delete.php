<?php
/**
 * Removes an admin note
 */

$note_guid = get_input('note_guid', 0);
$note = get_entity($note_guid);

if ($note instanceof ElggAdminNote && $note->delete()) {
	system_message(elgg_echo('admin_notes:messages:deleted'));
} else {
	register_error(elgg_echo('admin_notes:errors:could_not_delete'));
}

forward(REFERER);