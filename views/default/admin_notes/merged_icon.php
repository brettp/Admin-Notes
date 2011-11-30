<?php
/**
 * Show a merged icon of the commenter and the noted entity
 *
 * @uses $vars['note']   The note entity
 * @uses $vars['owner']  ElggUser that created the note
 * @uses $vars['entity'] Note is about this ElggEntity
 */

$owner = $vars['owner'];
$entity = $vars['entity'];
$note = $vars['note'];

$owner_icon = elgg_view_entity_icon($owner, 'small');

$timestamp = elgg_view_friendly_time($note->time_created);

// handle deleted entities
if ($entity) {
	$entity_icon = elgg_view_entity_icon($entity, 'small', array(
		'href' => "admin_notes/$entity->username",
	));
} else {
	$deleted = elgg_echo('admin_notes:deleted_entity', array(
		$note->original_username,
		$note->original_email
	));
	$entity_icon = "<a class=\"admin-notes-deleted-user\" title=\"$deleted\">X</a>";
}

$arrow = elgg_view_icon('arrow-right');

$html = <<<HTML
<div class="admin-notes-icons clearfix">
	$owner_icon $arrow $entity_icon
</div>
<div>
	$timestamp
</div>
HTML;

echo $html;
