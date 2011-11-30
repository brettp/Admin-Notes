<?php
/**
 * Register the ElggAdminNote class for the object/admin_note subtype
 */

if (get_subtype_id('object', 'admin_note')) {
	update_subtype('object', 'admin_note', 'ElggAdminNote');
} else {
	add_subtype('object', 'admin_note', 'ElggAdminNote');
}
