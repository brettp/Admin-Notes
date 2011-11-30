<?php
/**
 * Lists notes.
 */

$options = array(
	'type' => 'object',
	'subtype' => 'admin_note',
	'order_by' => 'e.time_created DESC'
);

$title = elgg_echo('admin_notes:all_admin_notes');

if ($user) {
	$options['metadata_name_value_pair'] = array('name' => 'entity_guid', 'value' => $user->guid);
	$title = elgg_echo('admin_notes:user_admin_notes', array($user->name));
}

$content = elgg_view_title($title);

if ($notes = elgg_list_entities_from_metadata($options)) {
	$content .= $notes;
} else {
	$content .= '<p>' . elgg_echo('admin_notes:no_notes') . '</p>';
}
$body = elgg_view_layout('one_sidebar', array('content' => $content));

echo elgg_view_page($title, $body);
