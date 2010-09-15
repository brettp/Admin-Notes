<?php
/**
 * Settings to optionally delete notes about entities when deleting entities.
 */

$delete = get_plugin_setting('delete_notes_with_entity', 'admin_notes');
$checked = ($delete) ? 'checked = "checked"' : '';

?>
<p>
	<input type="hidden" name="params[delete_notes_with_entity]" value="0" />
	<input id="admin_notes_delete" type="checkbox" name="params[delete_notes_with_entity]" value="1" <?php echo $checked; ?>/>
	<label for="admin_notes_delete"><?php echo elgg_echo('admin_notes:settings:delete_notes_with_entity'); ?></label>
</p>