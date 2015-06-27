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
 */

var def_input_tpl = '<input type="text" class="ui_input_tpl">';
if (typeof ui_input === "undefined") ui_input = def_input_tpl;
if (typeof ui_date_off === "undefined") ui_date_off = false;
if (typeof ui_time_off === "undefined") ui_time_off = false;
if (typeof formatStr === "undefined") formatStr = 'Input format: ';


/**
 * Use template to generate input with specified Id and returns jQuery object.
 * @param template - plain html template for input field
 * @param id - id of new generated object
 * @returns jQuery object
 */

function makeInput(template,id,title){
	if (!template || template === null || typeof ui_input === "undefined") return null;
	var $template = $(template),
		$wrapped = $template.find('.ui_input_tpl'),
		$plain = $template.closest('.ui_input_tpl');
	if ($wrapped.length) { // inpupt field in template is wrapped with another block
		$template.find('.ui_input_tpl').attr('id',id);
	} else if ($plain.length) { // just input field
		$template.closest('.ui_input_tpl').attr('id',id);
	} else { // use default format
		$template = $(def_input_tpl);
	}
	if (title) $template.attr('title',title);
	return $template;
}

/**
 * Parses name of input elements and return its base name
 * (actual for arrays)
 * Examples:
 * 		param[value] -> param
 * 		param[value][value2] -> param[value]
 * @param input element name
 * @returns string
 */
function getInputName(name){
	var splited = name.split('[');
	if (splited.length > 1) {
		splited.pop();
		return splited.join('[');
	} else {
		return splited[0];
	}
}

/**
 * Parse string in HH:MM or HH-MM format and if time string is valid
 * return array of hours and minutes with leading zeroes.
 * If string is invalid or values exceed time format returns NULL
 * If empty string passed returns it.
 * @param time_str
 * @returns array || null || ''
 */
function parse_time(time_str) {
	if (time_str == '' ) return '';
	if (typeof time_str !== "string") return null;
	re = /\s*(\d+)[\s\.:-](\d{1,2})\s*/;
	timeArr = time_str.match(re);
	if (timeArr)
		if (timeArr[1] && timeArr[2] && timeArr[1] >= 0 && timeArr[1] <= 23
				&& timeArr[2] >= 0 && timeArr[2] <= 59) {
			timeArr[1] = ('0' + timeArr[1]).slice(-2);
			timeArr[2] = ('0' + timeArr[2]).slice(-2);
			timeArr['hour'] = timeArr[1];
			timeArr['minute'] = timeArr[2];
			return timeArr;
		} else return null;
}

function getDateFromCot(valYear,valMonth,valDay,valHour,valMinute){
	if (!valYear) valYear = 0;
	if (!valMonth) valMonth = 0;
	if (!valDay) valDay = 0;
	if (!valHour) valHour = 0;
	if (!valMinute) valMinute = 0;
	return new Date(valYear,valMonth-1,valDay,valHour,valMinute);
}

/**
 * Checks element for date/time controls, hides standard ones
 * adds new style picker and link its data with hidden inputs.
 * @param dt_block - jQuery object for datetime block element
 */
function enable_datetime_picker($dt_block){
	var classes = $dt_block.attr('class').split(' '),
		mode = 0;
		valDay = 0, valMonth = 0, valYear = 0, valHour = 0, valMinute = 0;
	if (classes.indexOf('mode-date')>-1 && !ui_date_off) mode = 1;
	if (classes.indexOf('mode-time')>-1 && !ui_time_off) mode = 2;
	if (classes.indexOf('mode-datetime')>-1) mode = 3;
	if (classes.indexOf('mode-datetime-combined')>-1) {
		if (ui_date_off || ui_time_off) mode = 3;
		else mode = 4;
	}
	if (!mode) {
		$dt_block.find('.common_date').show();
		$dt_block.find('.common_time').show();
		return;
	}
	if (mode != 2) { // for all date modes
		var date_control = $dt_block.find("div.common_date"),
			dateToSet = $dt_block.data('setDate'),
			elDay = date_control.find('select').filter("[name*='day']"),
			elMonth = date_control.find('select').filter("[name*='month']"),
			elYear = date_control.find('select').filter("[name*='year']");

		if (date_control.data('show') == 'off') {
			date_control.show();
			return;
		}
		if (elDay.length && elMonth.length && elYear.length) {
			var
				date_target = date_control.data('target'),
				name_for_date= getInputName(date_control.find('select').prop('name')).replace(/[^\w+]/g,''),
				date_input_id = 'rdpick_'+name_for_date,
				date_class_name = '.'+date_target+'_'+name_for_date,
				date_input = makeInput(ui_input,date_input_id); // input id="rdpick_'+name_for_date+'" type="text">';
			if (date_target && $(date_class_name).length) {
				var $date_target = $(date_class_name);
			} else {
				var $date_target = $dt_block.find('.date_target');
			}
			if (!ui_date_off) $date_target.append(date_input);
			var $datepicker = $('#'+date_input_id);
			((date_control.data('show') == 'source') || ui_date_off) ? date_control.show() : date_control.hide();
			var valDay   = elDay.val(),
				valMonth = elMonth.val(),
				valYear  = elYear.val(),
				minYear = 9999,
				maxYear = 1000;

			elYear.find("option").each(function(i,e){
				val = $(e).prop('value');
				if (val) {
					if (val < minYear) minYear = val;
					if (val > maxYear) maxYear = val;
				}
			});
			var maxDate = new Date(maxYear,11,31),
				minDate = new Date(minYear,0,1);
		}
	}
	if (mode!=1){ // for all modes with timepicker
		var time_control = $dt_block.find("div.common_time"),
			elHour = time_control.find('select').filter("[name*='hour']"),
			elMinute = time_control.find('select').filter("[name*='minute']");
		if (time_control.data('show') == 'off') {
			time_control.show();
			return;
		}
		if (elHour.length && elMinute.length) {
			var time_target = time_control.data('target'),
				name_for_time = getInputName(time_control.find('select').prop('name')).replace(/[^\w+]/g,''),
				time_input_id = 'rtpick_' + name_for_time,
				time_class_name = '.' + time_target + '_' + name_for_time,
				time_input = makeInput(ui_input, time_input_id);
			if (time_target && $(time_class_name).length) {
				var $time_target = $(time_class_name);
			} else {
				var $time_target = $dt_block.find('.time_target');
			}
			if (mode!=4 && !ui_time_off) $time_target.append(time_input);
			var $timepicker = $('#'+time_input_id);
			(time_control.data('show') == 'source' || ui_time_off) ? time_control.show() : time_control.hide();
			var valHour = elHour.val(),
				valMinute = elMinute.val();
			if (valHour && valMinute) {
				var timeStr = valHour + ':' + valMinute;
			} else {
				var timeStr = '';
			}
		}
	}

	if (valDay && valMonth && valYear) {
		var dateObj = new Date(valYear,valMonth-1,valDay,valHour,valMinute);
	} else {
		var dateObj = '';
	}
	// seting up default value if specified by control template and not defined by field value
	if (!dateObj && /^[\+\-]?([0-9]+)$/.test(dateToSet)) { // is Integer
		dateObj = new Date(Date.now() + dateToSet * 1000);
	}
	// initializing datepicker, timepicker or combined input
	if (mode==4 && !(ui_date_off || ui_time_off)){ // combined mode datetime picker
			function syncDateTime(dateText, inst, $this){
				if (!dateText){
					$this.val('');
					elYear.val('');
					elMonth.val('');
					elDay.val('');
					elHour.val('');
					elMinute.val('');
				} else {
//					$this.val(dateText);
					curDate = $this.datetimepicker('getDate');
					$this.datetimepicker('setDate',curDate);
					newDay   = curDate.getDate();
					newMonth = curDate.getMonth()+1;
					newYear  = curDate.getFullYear();
					timeStr = $datepicker.val().split(' ')[1];
					var newtime = parse_time(timeStr);
					yearExists  = elYear.find('option[value='+newYear+']').length;
					monthExists = elMonth.find('option[value='+newMonth+']').length;
					dayExists   = elDay.find('option[value='+newDay+']').length;
					if (monthExists && dayExists && yearExists) {
						elYear.val(newYear);
						elMonth.val(newMonth);
						elDay.val(newDay);
						if (newtime && newtime.length == 3) {
							elHour.val(newtime.hour);
							elMinute.val(newtime.minute);
						}
						dateObj = $this.datetimepicker('getDate');
					} else if (dateObj) {
						$this.datetimepicker('setDate',dateObj);
					}
				}
			}
			$datepicker.datetimepicker({
				changeYear: true,
				maxDate: maxDate,
				minDate: minDate,
				yearRange: minYear + ':' + maxYear,
				onClose: function(dateText, inst) {
					syncDateTime(dateText, inst, $(this));
				}
			});
			if (!$datepicker.attr('title')) $datepicker.attr('title',formatStr+$datepicker.datepicker( "option", "dateFormat" )+' '+$datepicker.datepicker( "option", "timeFormat" ));
			if ( dateObj ) {
				$datepicker.datetimepicker("option", "defaultDate", dateObj);
				$datepicker.datetimepicker('setDate',dateObj);
				syncDateTime($datepicker.val(), null, $datepicker);
			}
			if (date_control && date_control.data('showformat')) {
				$fmt = $('<span>').attr('class','uidt_format').html(' (' + $datepicker.datepicker( "option", "dateFormat" )+' '+$datepicker.datepicker( "option", "timeFormat" )+')');
				$date_target.append($fmt );
			}
		}
	if ((mode==2 || mode==3) && !ui_time_off) { // time picker
		function syncTime($this){
			var newtime = parse_time($this.val());
			if (newtime && newtime.length == 3 ) {
				elHour.val(newtime.hour);
				elMinute.val(newtime.minute);
				timeStr = $this.val();
			} else if ($this.val()=='') {
				elHour.val('');
				elMinute.val('');
			} else {
				$this.val(timeStr);
			}
		}
		$timepicker.val(timeStr);
		$timepicker.timepicker({
			addSliderAccess: time_control.data('touch'),
			sliderAccessArgs: { touchonly: false },
			onClose: function(dateText, inst) {
				syncTime($(this));
			}
		});
		$timepicker.change(function(){
			syncTime($(this));
		});
		if (!$timepicker.attr('title')) $timepicker.attr('title',formatStr+$timepicker.timepicker( "option", "timeFormat" ));
		if (dateObj) {
			$timepicker.timepicker('setTime',dateObj);
		}
		if (time_control && time_control.data('showformat')) {
			$fmt = $('<span>').attr('class','uidt_format').html(' ('+$timepicker.datepicker( "option", "timeFormat" )+')');
			$time_target.append($fmt);
		}
	}
	if ((mode==1 || mode==3) && !(ui_date_off)) { // date picker
		function validDate(dateStr){
			defDate = new Date(-100800000); //'12/31/1969');
			$testDP = $('<input>').val(dateStr).datepicker({defaultDate:defDate});
			return ($testDP.datepicker('getDate').getTime() != defDate.getTime());
		}
		function syncDate(dateText, inst, $this){
			if (!dateText || !(validDate(dateText))) {
				$this.val('');
				elYear.val('');
				elMonth.val('');
				elDay.val('');
			} else {
				curDate = $this.datepicker('getDate');
				$this.datepicker('setDate',curDate);
				newDay   = curDate.getDate();
				newMonth = curDate.getMonth()+1;
				newYear  = curDate.getFullYear();
				yearExists  = elYear.find('option[value='+newYear+']').length;
				monthExists = elMonth.find('option[value='+newMonth+']').length;
				dayExists   = elDay.find('option[value='+newDay+']').length;
				if (monthExists && dayExists && yearExists) {
					elYear.val(newYear);
					elMonth.val(newMonth);
					elDay.val(newDay);
					dateObj = $this.datepicker('getDate');
				} else if (dateObj) {
					$this.datepicker('setDate',dateObj);
				}
			}
		}
		$datepicker.datepicker({
			changeYear: true,
			maxDate: maxDate,
			minDate: minDate,
			yearRange: minYear + ':' + maxYear,
			onClose: function(dateText, inst) {
				syncDate(dateText, inst, $(this));
			}
		});
		$datepicker.change(function(){
			syncDate($datepicker.val(), null, $(this));
		});
		if (!$datepicker.attr('title')) $datepicker.attr('title',formatStr+$datepicker.datepicker( "option", "dateFormat" ));
		if (dateObj) {
			$datepicker.datepicker('setDate',dateObj);
			$datepicker.datepicker( "option", "defaultDate", dateObj );
			syncDate($datepicker.val(), null, $datepicker);
		}
		if (date_control && date_control.data('showformat')) {
			$fmt = $('<span>').attr('class','uidt_format').html(' (' + $datepicker.datepicker( "option", "dateFormat" )+')');
			$date_target.append($fmt);
		}
	}
	function updateNewUI(dateObj){
		if (dateObj) {
			if (mode==1 || mode==3) $datepicker.datepicker('setDate',dateObj);
			if (mode==2 || mode==3) $timepicker.timepicker('setDate',dateObj);
			if (mode==4) $datepicker.datetimepicker('setDate',dateObj);
		}
	}

	if (date_control) {
		date_control.find('select').change(function(){
			valDay   = elDay.val();
			valMonth = elMonth.val();
			valYear  = elYear.val();
			dateObj = getDateFromCot(valYear,valMonth,valDay,valHour,valMinute);
			updateNewUI(dateObj);
		});
	}
	if (time_control) {
		time_control.find('select').change(function(){
			valHour = elHour.val();
			valMinute = elMinute.val();
			dateObj = getDateFromCot(valYear,valMonth,valDay,valHour,valMinute);
			updateNewUI(dateObj);
		});
	}
}

$(function() {
	$('div[class~=uidt]').each(function(i,e){
		enable_datetime_picker($(this));
	});
});