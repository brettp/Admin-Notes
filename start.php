<?php
/**
 * Enter quick notes about a user.
 */

elgg_register_event_handler('init', 'system', 'admin_notes_init');

/**
 * Init
 */
function admin_notes_init() {
	global $CONFIG;

	// user hover menu links, js, and css extensions
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'admin_notes_hover_menu');
	elgg_extend_view('js/elgg', 'admin_notes/js');
	elgg_extend_view('css/elgg', 'admin_notes/css');

	// actions
	$action_path = dirname(__FILE__) . '/actions/';
	elgg_register_action('admin_notes/add', $action_path . 'add.php', 'admin');
	elgg_register_action('admin_notes/delete', $action_path . 'delete.php', 'admin');

	// list notes page handler
	elgg_register_page_handler('admin_notes', 'admin_notes_pagehandler');

	// admin menu for all notices
	if (elgg_is_admin_logged_in()) {
		$item = new ElggMenuItem('admin_notes', elgg_echo('admin_notes:admin_notes'), 'admin_notes');
		elgg_register_menu_item('site', $item);
	}

	// optionally remove notes about entities when they're deleted
	$delete = elgg_get_plugin_setting('delete_notes_with_entity', 'admin_notes');
	if ($delete) {
		elgg_register_event_handler('delete', 'all', 'admin_notes_delete_entity_handler');
	}
}

/**
 * Shows notes on users.
 *
 * @param array $page URL segments
 * @return bool
 */
function admin_notes_pagehandler($page) {
	admin_gatekeeper();

	$username = (isset($page[0])) ? $page[0] : NULL;

	if ($username && !($user = get_user_by_username($username))) {
		// invalid username passed. emit error and forward to all.
		register_error(elgg_echo('admin_notes:unknown_user'));
		forward('admin_notes');
	}

	// for owner blocks
	if ($user) {
		elgg_set_page_owner_guid($user->getGUID());
	} else {
		elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
	}

	include dirname(__FILE__) . '/pages/list_notes.php';
	return true;
}

/**
 * Add a menu item to user hover menu
 *
 * @param string $hook   Plugin hook name
 * @param string $type   Hook type
 * @param array  $menu   Array of ElggMenuItem objects
 * @param array  $params Array of parameters related to menu
 * @return array
 */
function admin_notes_hover_menu($hook, $type, $menu, $params) {
	$user = $params['entity'];

	$url = "action/admin_notes/add?user_guid=$user->guid";
	$menu[] = ElggMenuItem::factory(array(
		'name' => 'admin_notes_add',
		'text' => elgg_echo('admin_notes:add_note'),
		'href' => $url,
		'is_action' => true,
		'section' => 'admin',
	));

	$menu[] = ElggMenuItem::factory(array(
		'name' => 'admin_notes_view',
		'text' => elgg_echo('admin_notes:view_notes'),
		'href' => 'admin_notes/' . $user->username,
		'section' => 'admin',
	));

	return $menu;
}

/**
 * Remove notes for an entity when that entity is deleted.
 *
 * @param string     $event  Event name
 * @param string     $type   Event type
 * @param ElggEntity $object Entity being deleted
 * @return void
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
}
