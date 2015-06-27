<?php
/**
 * Localization file for UI date/time picker
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

$L['plu_title'] = 'Замена стандартного меню выбора дат и времени'; // для заголовка страницы

$L['info_desc'] ='Замена стандартных элементов выбора дат и времени на более удобные';

$L['uidt_jqueryrequired'] = 'Этот плагин работает только при включенной библиотеке jQuery.';
$L['uidt_testpage'] = 'Тестовая страница для элементов выбора даты/времени';
$L['uidt_Date'] = 'Тестовый элемент выбора даты';
$L['uidt_Time'] = 'Тестовый элемент выбора времени';
$L['uidt_DateTime'] = 'Тест выбора даты и времени';
$L['uidt_Combined'] = ' (объединенный диалог)';
$L['uidt_oldstyle'] = 'Обычный для Cotonti элемент выбора';
$L['uidt_newstyle'] = 'Новый UI элемент (используемый в плагине)';
$L['uidt_switchedoff'] = 'Элемент управления выключен';

$L['cfg_global_mode'] = array('Включить `global` режим','Когда `global` режим включен расширение загружается на всех страницах сайта
				и обрабатывает все стандартные элементы дата/время. <br />
				Когда режим `global` выключен (по умолчанию) расширение загружается только при добавлении/редактировании страниц и при редактировании профиля пользователей.');
$L['cfg_jquery_ui_js'] = array('Полный путь к JS библиотеке jQuery UI','изменяйте только в том случае, когда вы перенесли файлы в другой каталог или когда библиотека уже подключена.');
$L['cfg_jquery_ui_css'] = array('Полный путь к CSS файлу jQuery UI','');
$L['cfg_support_touch'] = array('Включить поддержку слайдера на сенсорных устройствах','будут добавлены дополнительные кнопки для изменения значения параметров');
$L['cfg_enable_datepicker'] = array('Включить элемент выбора даты','Если выключить на страницах будет стандартный элемент.');
$L['cfg_enable_timepicker'] = array('Включить элемент выбора времени','Если выключить на страницах будет стандартный элемент.');
$L['cfg_timepicker_js'] = array('Полный путь к jQuery плагину TimePicker','');
$L['cfg_timepicker_css'] = array('Полный путь к файлу CSS для TimePicker','');
$L['cfg_hidden_source'] = array('Прятать стандартные поля ввода с помощью атрибута style','Если выбрано «Да» все стандартные поля будут по умолчанию спрятаны с помощью атрибута style. В противном случае они будут прятаться после загрузки страницы с помощью jQuery.');
$L['cfg_combined'] = array('Включить совмещенный режим','если включен, то будет отображаться единый (совмещенный) диалог для выбора даты и времени');


$adminhelp1 = '
<p>В таблице показаны стандартные для Cotonti элементы выбора даты/времени (в первой колонке) и
новые элементы (во второй колонке), которые будут использоваться в Cotonti, когда установлено расширение <strong>ui_datetime</strong>.</p>
<p>Новый и старый элементы выбора даты/времени синхронизированы между собой, вы можете протестировать их.</p>
<p>По умолчанию стандартные элементы прячутся, а вместо них выводятся «новые» объединенные элементы ввода времени и даты. <br />
Если необходимо предотвратить сокрытие стандартных элементов используйте атрибут данных «show» со значением «source» в шаблонах $R[\'input_date\'].</p>
<p>Другие управляющие значения: <br />
<dl class="">
  <dt>data-show="source"</dt>
  <dd>Отобразить исходный (стандартный) элемент ввода даты <span class="togglelink" style="display:none;">(<a href="#source" class="uisource">вкючить/отключить опцию</a>)</span></dd>
  <dt>data-show="off"</dt>
  <dd>Выключить преобразование стандартных элементов ввода даты/времени <span class="togglelink" style="display:none;">(<a href="#off" class="uioff">вкючить/отключить опцию</a>)</span></dd>
  <dt>data-showformat="true"</dt>
  <dd>Отображать формат ввода даты в виде текстовой подсказки после поля ввода <span class="togglelink" style="display:none;">(<a href="#showformat" class="uiformat">вкючить/отключить опцию</a>)</span></dd>
  <dt>data-target="TargetValue"</dt>

  <dd>При необходимости вывести новый элемент в произвольный блок, определяет имя класса элемента используемого как контейнер для вставки поля ввода.
	Имя целевого класса формируется в виде «TargetValue_NameOfInput», где «NameOfInput»
		это значение имени стандартного элемента ввода, и «TargetValue» значение указанное в поле data-target.</dd>
	</dl>
</p>

<br />
<p>Вы можете использовать следующие сочетания клавиш для управления элементом выбора даты: <br />
<ul>
	<li><span class="key">page up/down</span> - <span class="text">previous/next month</span></li>
	<li><span class="key">ctrl+page up/down</span> - <span class="text">previous/next year</span></li>
	<li><span class="key">ctrl+home</span> - <span class="text">current month or open when closed</span></li>
	<li><span class="key">ctrl+left/right</span> - <span class="text">previous/next day</span></li>
	<li><span class="key">ctrl+up/down</span> - <span class="text">previous/next week</span></li>
	<li><span class="key">enter</span> - <span class="text">accept the selected date</span></li>
	<li><span class="key">ctrl+end</span> - <span class="text">close and erase the date</span></li>
	<li><span class="key">escape</span> - <span class="text">close the datepicker without selection</span></li>
</ul>
<p>';

$adminhelp2 = 'Этот плагин предназначен для замены стандартных элементов выбора даты и времени. <br />
Вместо нескольких выпадающих меню будут отображаться единые поля ввода даты и времени с удобным
всплывающим диалогом выбора.';

