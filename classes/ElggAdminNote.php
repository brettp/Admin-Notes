<?php
/**
 * Admin note object
 */

class ElggAdminNote extends ElggObject {
	protected function initializeAttributes() {
		parent::initializeAttributes();

		// override the default file subtype.
		$this->attributes['subtype'] = 'admin_note';
	}
}