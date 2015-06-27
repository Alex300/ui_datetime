<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

/**
 * Administration panel for UI date/time picker
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }
//require_once cot_incfile('ui_datetime', 'plug');

$plug_name = 'ui_datetime';

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('plug', $plug_name);
cot_block($usr['isadmin']);

$adminhelp = $adminhelp1;

require_once cot_incfile('forms');

$tt = new XTemplate(cot_tplfile($plug_name.'.tools', 'plug'));
$std_date = cot_selectbox_date(time(),'short','testdate');
$std_time = cot_selectbox_date(time(),'time','testtime');
$std_datetime = cot_selectbox_date(time(),'','testdatetime');
$std_datetime_combined = cot_selectbox_date(time(),'combined','testdatetimecmb');

$tt->parse();
$plugin_body .= $tt->text();

