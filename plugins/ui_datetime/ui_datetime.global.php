<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=global
[END_COT_EXT]
==================== */

/**
 * Global hook file for UI date/time picker plugin
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

$plug_name = 'ui_datetime';
//global $uidt_cfg;
$uidt_cfg = $cfg['plugin'][$plug_name];
// TODO: проверить в админке Bootstrap
if ($cfg['jquery'] && ($uidt_cfg['enable_datepicker'] || $uidt_cfg['enable_timepicker'])){
	if ($uidt_cfg['global_mode']
		|| ( $_GET['e'] == $plug_name
			|| ( $_GET['e'] == 'page' && ($_GET['m'] == 'edit' || $_GET['m'] == 'add' )) // page edit
			|| ( $_GET['e'] == 'users' && ($_GET['m'] == 'edit' || $_GET['m'] == 'profile' )) // prifile edit
			|| ( $_GET['m'] == 'other' && $_GET['p'] == $plug_name ) // admin tools (test page)
			|| ( $_GET['e'] == 'search' ) // search plugin
		)) {
			define('UI_DATETIME',true);

			$r_date = $R['input_date_short'];
			$r_time = str_replace($r_date, '', $R['input_date']);
			$orig_date = $R['input_date'];
			$orig_date_short = $R['input_date_short'];

			if ($_GET['m'] == 'other' && $_GET['p']) $admintools = true;
			$ui_date = $uidt_cfg['enable_datepicker'];
			$ui_time = $uidt_cfg['enable_timepicker'];

			$tt = new XTemplate(cot_tplfile($plug_name, 'plug'));
			if ($uidt_cfg['hidden_source']) $tt->parse('ATTR.HIDDENSOURCE');
			if ($uidt_cfg['support_touch']) $tt->parse('ATTR.SUPPORTTOUCH');
			if ($admintools) {
				$tt->assign('target','newui');
				$tt->assign('show_dateformat','true');
				$tt->parse('ATTR.TOOLSMODE.DATE');
				$tt->parse('ATTR.TOOLSMODE');
			}
			$tt->parse('ATTR');
			$tt->assign('attributes',$tt->text('ATTR'));

			$tt->assign('standard_date_control',$r_date);
			$tt->parse('NEWDATE');
			$new_ui_date = $tt->text('NEWDATE');

			$tt->assign('standard_time_control',$r_time);
			$tt->parse('NEWTIME');
			$new_ui_time = $tt->text('NEWTIME');

			//new template for date
			$tt->assign('input_resource',$new_ui_date);
			$tt->assign('mode','date');
			$tt->parse('NEWRESOURCE');
			$R['input_date_short'] = $tt->text('NEWRESOURCE');

			// new template for datetime
			$tt->assign('input_resource',$new_ui_date.$new_ui_time);
			$defmode = ($uidt_cfg['combined'] && !$admintools) ? 'datetime-combined' : 'datetime';
			$tt->assign('mode',$defmode);
			$tt->parse('NEWRESOURCE');
			$R['input_date'] = $tt->text('NEWRESOURCE');

			// new template for combined datetime element (used for demopage in admin tools)
			$tt->assign('mode','datetime-combined');
			$tt->parse('NEWRESOURCE');
			if ($ui_date && $ui_time) $R['input_date_combined'] = $tt->text('NEWRESOURCE');
				
			// template for new input field
			$tt->parse('NEWINPUT');
			$ui_input_tpl = 'var ui_input = \''.str_replace(array("'","\n","\r"), array("\'",'',''), $tt->text('NEWINPUT')).'\';';
			if ($ui_input_tpl) cot_rc_embed( $ui_input_tpl);
	}
}

