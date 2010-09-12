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
	$title = sprintf(elgg_echo('admin_notes:user_admin_notes'), $user->name);
}

$content = elgg_view_title($title);

if ($notes = elgg_list_entities_from_metadata($options)) {
	$content .= $notes;
} else {
	$content .= '<div class="contentWrapper">' . elgg_echo('admin_notes:no_notes') . '</div>';
}
$body = elgg_view_layout('two_column_left_sidebar', '', $content);

page_draw($title, $body);