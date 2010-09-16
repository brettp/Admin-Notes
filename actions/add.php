<?php
/**
 * Add a note on a user
 *
 * Don't use annotations because they're meh.
 */

$user_guid = get_input('user_guid', 0);
$user = get_user($user_guid);
$note_text = get_input('note');
$error = $message = NULL;

if (!$user || !$note_text) {
	$error = elgg_echo('user_notes:errors:could_not_add_note');

	echo json_encode(array(
		'result' => 'error',
		'message' => $error
	));
	exit;
}

$note = new ElggAdminNote();
$note->entity_guid = $user_guid;
$note->description = $note_text;
$note->original_username = $user->name;
$note->original_email = $user->email;
$note->original_name = $user->name;

if ($note->save()) {
	$message = elgg_echo('user_notes:messages:added_note');
	$json = array(
		'result' => 'success',
		'message' => $message
	);
} else {
	$error = elgg_echo('user_notes:errors:could_not_add_note');
	$json = array(
		'result' => 'error',
		'message' => $error
	);
}

echo json_encode($json);
exit;