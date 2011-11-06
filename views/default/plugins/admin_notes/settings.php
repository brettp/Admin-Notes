<?php
/**
 * Settings to optionally delete notes about entities when deleting entities.
 */

$delete = elgg_get_plugin_setting('delete_notes_with_entity', 'admin_notes');

$label = elgg_echo('admin_notes:settings:delete_notes_with_entity');
$checkbox = elgg_view('input/checkbox', array(
	'name' => 'params[delete_notes_with_entity]',
	'value' => 1,
	'checked' => $delete ? 'checked' : false,
	'id' => 'admin_notes_delete',
));

$html = <<<HTML
<div>
	$checkbox<label for="admin_notes_delete">$label</label>
</div>
HTML;

echo $html;
