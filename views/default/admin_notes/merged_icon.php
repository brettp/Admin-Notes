<?php
/**
 * Show a merged icon of the commenter and the noted entity
 */

$owner = $vars['owner'];
$entity = $vars['entity'];

$owner_icon_url = $owner->getIcon('small');
$owner_icon_html = "<a title=\"$owner->name\"><img alt=\"$owner->name\" src=\"$owner_icon_url\" /></a>";

// handle deleted entities
if ($entity) {
	$entity_icon_url = $entity->getIcon('small');
	$entity_icon_html = "<a title=\"$entity->name\" href=\"{$vars['url']}pg/admin_notes/$entity->username\">"
		. "<img alt=\"$entity->name\" src=\"$entity_icon_url\" /></a>";
} else {
	$deleted = elgg_echo('admin_notes:deleted_entity');
	$entity_icon_html = "<a class=\"admin_notes_deleted\" title=\"$deleted\">X</a>";
}

?>
<div class="admin_notes_merged_icon">
<?php echo $owner_icon_html; ?>
<span class="admin_notes_arrow">&rarr;</span>
<?php echo $entity_icon_html; ?>
<br />
</div>