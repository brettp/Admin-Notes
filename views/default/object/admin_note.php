<?php
/**
 * Display a note
 */

$note = $vars['entity'];
$owner = $note->getOwnerEntity();
$entity = get_entity($note->entity_guid);

$delete_link = elgg_view('output/confirmlink', array(
	'href' => $vars['url'] . 'action/admin_notes/delete/?note_guid=' . $note->guid,
	'text' => elgg_echo('delete'),
	'confirm' => elgg_echo('admin_notes:delete_confirm')
));

$icon = elgg_view('admin_notes/merged_icon', array('entity' => $entity, 'owner' => $owner));
?>

<div class="contentWrapper admin_note">
	<span class="admin_note_delete"><?php echo $delete_link; ?></span>
	<div class="admin_note_metadata">
		<span class="admin_note_icon"><?php echo $icon; ?></span>
		<span class="admin_note_timestamp"><?php echo friendly_time($note->time_created)?></span>
	</div>
	<span class="admin_note_body"><?php echo $note->description; ?></span>
</div>