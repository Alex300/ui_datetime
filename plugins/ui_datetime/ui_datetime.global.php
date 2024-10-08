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

$tmp = explode("\\",__FILE__);
if (!defined('COT_CODE') && !defined('COT_PLUG')) {
    die('Wrong URL (' . array_pop($tmp) . ').');
}

$plug_name = 'ui_datetime';
//global $uidt_cfg;
$uidt_cfg = cot::$cfg['plugin'][$plug_name];
$m = cot_import('m', 'G', 'ALP', 24);
$admintools = false;
// TODO: проверить в админке Bootstrap
if (cot::$cfg['jquery'] && ($uidt_cfg['enable_datepicker'] || $uidt_cfg['enable_timepicker'])){
	if ($uidt_cfg['global_mode']
		|| ( $_GET['e'] == $plug_name
			|| ( $_GET['e'] == 'page' && ($m == 'edit' || $m == 'add' )) // page edit
			|| ( $_GET['e'] == 'users' && ($m == 'edit' || $m == 'profile' )) // prifile edit
			|| ( $m == 'other' && $_GET['p'] == $plug_name ) // admin tools (test page)
			|| ( $_GET['e'] == 'search' ) // search plugin
		))
	{
        define('UI_DATETIME',true);

        $r_date = cot::$R['input_date_short'];
        $r_time = str_replace($r_date, '', cot::$R['input_date']);
        $orig_date = cot::$R['input_date'];
        $orig_date_short = cot::$R['input_date_short'];

        if ($m == 'other' && isset($_GET['p'])) {
            $admintools = true;
        }
        $ui_date = $uidt_cfg['enable_datepicker'];
        $ui_time = $uidt_cfg['enable_timepicker'];

        $tt = new XTemplate(cot_tplfile($plug_name, 'plug'));
        if ($uidt_cfg['hidden_source']) {
            $tt->parse('ATTR.HIDDENSOURCE');
        }
        if ($uidt_cfg['support_touch']) {
            $tt->parse('ATTR.SUPPORTTOUCH');
        }
        if ($admintools) {
            $tt->assign('TARGET','newui');
            $tt->assign('SHOW_DATEFORMAT','true');
            $tt->parse('ATTR.TOOLSMODE.DATE');
            $tt->parse('ATTR.TOOLSMODE');
        }
        $tt->parse('ATTR');
        $tt->assign('ATTRIBUTES', $tt->text('ATTR'));

        $tt->assign('STANDARD_DATE_CONTROL',$r_date);
        $tt->parse('NEWDATE');
        $new_ui_date = $tt->text('NEWDATE');

        $tt->assign('STANDARD_TIME_CONTROL',$r_time);
        $tt->parse('NEWTIME');
        $new_ui_time = $tt->text('NEWTIME');

        //new template for date
        $tt->assign('INPUT_RESOURCE',$new_ui_date);
        $tt->assign('MODE','date');
        $tt->parse('NEWRESOURCE');
        Cot::$R['input_date_short'] = $tt->text('NEWRESOURCE');

        // new template for datetime
        $tt->assign('INPUT_RESOURCE',$new_ui_date.$new_ui_time);
        $defmode = ($uidt_cfg['combined'] && !$admintools) ? 'datetime-combined' : 'datetime';
        $tt->assign('MODE',$defmode);
        $tt->parse('NEWRESOURCE');
        Cot::$R['input_date'] = $tt->text('NEWRESOURCE');

        // new template for combined datetime element (used for demopage in admin tools)
        $tt->assign('MODE','datetime-combined');
        $tt->parse('NEWRESOURCE');
        if ($ui_date && $ui_time) {
            Cot::$R['input_date_combined'] = $tt->text('NEWRESOURCE');
        }

        // template for new input field
        $tt->parse('NEWINPUT');
        $ui_input_tpl = 'var ui_input = \'' . str_replace(["'","\n","\r"], ["\'",'',''], $tt->text('NEWINPUT'))
            . '\';';
        if ($ui_input_tpl) {
            Resources::embed($ui_input_tpl);
        }
	}
}

