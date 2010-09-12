<?php
/**
 * Show a merged icon of the commenter and the noted entity
 */

$owner = $vars['owner'];
$entity = $vars['entity'];

$owner_icon = elgg_view('graphics/icon', array(
	'entity' => $owner,
	'size' => 'small',
	'js' => 'class="admin_notes_owner_icon"'
));

$owner_icon_url = $owner->getIcon('small');

$entity_icon = elgg_view('graphics/icon', array(
	'entity' => $entity,
	'size' => 'small',
	'js' => 'class="admin_notes_entity_icon"'

));

$entity_icon_url = $entity->getIcon('small');
$icon_text = sprintf(elgg_echo('admin_notes:icon_text'), $owner->name, $entity->name);

/*
<div class="admin_notes_merged_icon" style="width: 40px; height: 40px; background: url(<?php echo $entity_icon_url; ?>);">
<?php echo $owner_icon; ?>
</div>
*/
?>
<div class="admin_notes_merged_icon">
<a title="<?php echo $owner->name; ?>"><img alt="<?php echo $owner->name; ?>" src="<?php echo $owner_icon_url?>" /></a>
<span class="admin_notes_arrow">&rarr;</span>
<a title="<?php echo $entity->name; ?>" href="<?php echo $vars['url'] . 'pg/admin_notes/' . $entity->username; ?>"><img alt="<?php echo $entity->name; ?>" src="<?php echo $entity_icon_url?>" /></a>
<br />
</div>