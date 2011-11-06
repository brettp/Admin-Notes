<?php
/**
 * Display a note
 */

$note = $vars['entity'];
$owner = $note->getOwnerEntity();
$entity = get_entity($note->entity_guid);

$delete_link = elgg_view('output/confirmlink', array(
	'href' => 'action/admin_notes/delete/?note_guid=' . $note->guid,
	'text' => elgg_echo('delete'),
	'confirm' => elgg_echo('admin_notes:delete_confirm')
));

$icon = elgg_view('admin_notes/merged_icon', array(
	'entity' => $entity,
	'owner' => $owner,
	'note' => $note,
));

$body = "<span class=\"phm\">$note->description</span>";

echo elgg_view_image_block($icon, $body, array('image_alt' => $delete_link));
