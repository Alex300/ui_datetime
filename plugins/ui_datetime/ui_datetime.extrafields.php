<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.extrafields.add,admin.extrafields.update
[END_COT_EXT]
==================== */

/**
 * Helper for tracking datetime extrafields on add/update with UI_datetime format
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

defined('COT_CODE') || die('Wrong URL ');

if (defined('UI_DATETIME')) {
	if ($a == 'add') {
		if (!$field['field_html']) {
			$field['field_html'] = $R['input_date'];
		}
	}	elseif ($a == 'upd') {
		if (!$field['field_html'] && $field['field_type']=='datetime') {
			$field['field_html'] = $R['input_date'];
		}
	}
}