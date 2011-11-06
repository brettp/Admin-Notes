<?php
/**
 * Admin note object
 */

class ElggAdminNote extends ElggObject {
	protected function initialise_attributes() {
		parent::initialise_attributes();

		// override the default file subtype.
		$this->attributes['subtype'] = 'admin_note';
	}
}