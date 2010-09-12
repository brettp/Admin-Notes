<?php
/**
 * User hover menu entry
 */

$add = elgg_view('output/url', array(
	'href' => "{$vars['url']}action/admin_notes/add?user_guid={$vars['entity']->guid}",
	'text' => elgg_echo('admin_notes:add_note'),
	'is_action' => TRUE,
	'class' => 'admin_notes_add'
));


echo $add;

$view = elgg_view('output/url', array(
	'href' => "{$vars['url']}pg/admin_notes/{$vars['entity']->username}/",
	'text' => elgg_echo('admin_notes:view_notes')
));

echo $view;