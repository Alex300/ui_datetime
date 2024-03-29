<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
[END_COT_EXT]
==================== */

/**
 * UI date/time picker plugin for Cotonti CMF
 *
 * Header file
 *
 * @package ui_datetime
 * @author Andrey Matsovkin
 * @author Kalnov Alexey    <kalnovalexey@yandex.ru>
 * @copyright Copyright Andrey Matsovkin
 * @copyright Copyright Portal30 Studio http://portal30.ru
 *
 *
 * @note from Alex300:
 * Хук 'rc' срабатывает внутри функции cot_rc_consolidate() которая вызывается если кеш пуст.
 * Если кеш не пуст то она никогда не вызовится и все что в плагине с хуком 'rc' выполнено не будет
 */
if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL'); }

$plug_name = 'ui_datetime';

$uidt_cfg = cot::$cfg['plugin'][$plug_name];

$m = cot_import('m', 'G', 'ALP', 24);

if (cot::$cfg['jquery'] && ($uidt_cfg['enable_datepicker'] || $uidt_cfg['enable_timepicker'])){
	if ($uidt_cfg['global_mode']
		|| ( $_GET['e'] == $plug_name
			|| ( $_GET['e'] == 'page' && ($m == 'edit' || $m == 'add' ))
			|| ( $_GET['e'] == 'users' && ($m == 'edit' || $m == 'profile' ))
			|| ( $m == 'other' && $_GET['p'] == $plug_name )
			|| ( $_GET['e'] == 'search' )
		)) {

        $rc_link_func = (cot::$cfg['headrc_consolidate'] && cot::$cache) ? 'addFile' : 'linkFileFooter';

        if ($m == 'other' && isset($_GET['p'])) $admintools = true;

        Resources::$rc_link_func($uidt_cfg['jquery_ui_js'], 'js', 60);
        Resources::addFile($uidt_cfg['jquery_ui_css'], 'css', 60);

        if (cot::$usr['lang'] != 'en') {
            if ($uidt_cfg['enable_datepicker']) {
                $lang_file_path = pathinfo($uidt_cfg['jquery_ui_js'],PATHINFO_DIRNAME);
                $lang_file = $lang_file_path."/i18n/jquery.ui.datepicker-".cot::$usr['lang'].".js";
                if (!file_exists($lang_file)) {
                    $lang_file = './js/jquery_ui/i18n/jquery.ui.datepicker-'.cot::$usr['lang'].'.js';
                }
                Resources::$rc_link_func($lang_file, 'js', 60);
            }
        }

        $ui_off_code = '';
        if ($uidt_cfg['enable_timepicker']) {
            $timepicker_path = pathinfo($uidt_cfg['timepicker_js'],PATHINFO_DIRNAME);
            Resources::addFile($uidt_cfg['timepicker_css'], 'css', 70);
            Resources::$rc_link_func ($uidt_cfg['timepicker_js'], 'js', 70);
            if (cot::$usr['lang'] != 'en') {
                $lang_file = $timepicker_path . "/i18n/jquery-ui-timepicker-".cot::$usr['lang'].".js";
                Resources::$rc_link_func($lang_file, 'js', 70);
            }
            if ($uidt_cfg['support_touch']) {
                Resources::$rc_link_func($timepicker_path . "/jquery-ui-sliderAccess.js", 'js', 70);
            }
        } else {
            $ui_off_code = 'var ui_time_off = true;';
        }
        if (!$uidt_cfg['enable_datepicker']) $ui_off_code .= 'var ui_date_off = true;';

        Resources::$rc_link_func(cot::$cfg['plugins_dir']."/$plug_name/js/$plug_name.js", 'js', 70);

        if (!empty($admintools)) {
            Resources::$rc_link_func(cot::$cfg['plugins_dir']."/$plug_name/js/$plug_name.tools.js", 'js', 70);
        }

        if ($ui_off_code) Resources::embed($ui_off_code);
	}
}
