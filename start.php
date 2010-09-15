<?php
/**
 * Enter quick notes about a user.
 */

register_elgg_event_handler('init', 'system', 'admin_notes_init');

/**
 * Init
 */
function admin_notes_init() {
	global $CONFIG;

	require dirname(__FILE__) . '/lib/ElggAdminNote.php';

	// register the subtype class
	run_function_once('admin_notes_runonce');

	// user hover menu links, js, and css extensions
	elgg_extend_view('profile/menu/adminlinks', 'admin_notes/user_menu_entry');
	elgg_extend_view('js/initialise_elgg', 'admin_notes/js');
	elgg_extend_view('css', 'admin_notes/css');

	// actions
	$action_path = dirname(__FILE__) . '/actions/';
	register_action('admin_notes/add', FALSE, $action_path . 'add.php', TRUE);
	register_action('admin_notes/delete', FALSE, $action_path . 'delete.php', TRUE);

	// list notes page handler
	register_page_handler('admin_notes', 'admin_notes_pagehandler');

	// admin menu for all notices
	if (isadminloggedin()) {
		add_menu(elgg_echo('admin_notes:admin_notes'), "{$CONFIG->url}pg/admin_notes/");
	}

	// optionally remove notes about entities when they're deleted
	$delete = get_plugin_setting('delete_notes_with_entity', 'admin_notes');
	if ($delete) {
		register_elgg_event_handler('delete', 'all', 'admin_notes_delete_entity_handler');
	}
}

/**
 * Shows notes on users.
 *
 * @param unknown_type $page
 */
function admin_notes_pagehandler($page) {
	admin_gatekeeper();

	$username = (isset($page[0])) ? $page[0] : NULL;

	if ($username && !($user = get_user_by_username($username))) {
		// invalid username passed. emit error and forward to all.
		register_error(elgg_echo('admin_notes:unknown_user'));
		forward('/pg/admin_notes/');
	}

	// for owner blocks
	if ($user) {
		set_page_owner($user->guid);
	} else {
		set_page_owner(get_loggedin_userid());
	}

	include dirname(__FILE__) . '/pages/list_notes.php';

	return TRUE;
}

/**
 * Register the subtype class.
 */
function admin_notes_runonce() {
	add_subtype('object', 'admin_note', 'ElggAdminNote');

	return TRUE;
}

/*
 * Remove notes for entities when that entity is deleted.
 */
function admin_notes_delete_entity_handler($event, $type, $object) {
	if ($object instanceof ElggAdminNote || !($object instanceof ElggEntity)) {
		return TRUE;
	}

	$old_ia = elgg_set_ignore_access(TRUE);
	$options = array(
		'type' => 'object',
		'subtype' => 'admin_note',
		'metadata_name_value_pair' => array('name' => 'entity_guid', 'value' => $object->guid)
	);

	$entities = elgg_get_entities_from_metadata($options);

	if ($entities) {
		foreach ($entities as $entity) {
			$entity->delete();
		}
	}

	elgg_set_ignore_access($old_ia);
	return TRUE;
}