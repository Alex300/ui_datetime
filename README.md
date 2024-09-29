UI_datetime 
===========

Plugin for Cotonti CMF. It replaces common date/time selection controls with
unified pretty style jQueryUI controls.

Based on plugin by Andrey Matsovkin (Macik): https://github.com/macik
But this one has fixes and new versions of included scripts

Description
-----------

Current date/time selection controls are presented as several separated dropdown select box.
Separate for year, month, day for date and hour, minutes for time.
The plugin hides this controls and bring to user unified one input field for date
and one field for time respectively. In addition this fields supplied with
easy-to-use dropdown UI controls to selec date/time in one-click.

Features
--------

* Unified input field for date or time (or combined)
* User friendly pop-up UI control attached for fast selection of date time
* I18n for date and time picker control (date format, month and day of weeks names)
* ThemeRoller ready as Using jQueryUI library 
* By default working in add/edit page, edit users, user profile, search options.
* Optional mode to track standard Cotonti date/time controls and replace with new one regardless opened page or extension
* Works with datetime extrafields 

Requirements
------------

* Works with Cotonti Siena (0.9.x branch).
* Required jQuery to be updated to version 1.6 or higher
* Required jQueryUI (distributed with extension or your custom build with at least datepicker and slider wigits)  

Demo page
---------

You can see demonstration how extension works here: [Demo page on GitHub](http://macik.github.io/cot_ui_datetime/demo.html)

Version info
------------

Current version uses:
* [jQueryUI](http://www.jqueryui.com) (version 1.10.3 with Redmond theme).
* [jquery.timepicker.js](http://trentrichardson.com/examples/timepicker/) - Timepicker jQuery plugin by Trent Richardson (from 1.6.0 version of UI_datetime)


### Comments

Plugin must works out from the box. Tested on `Nemesis`, `HTML Kickstart`, `SymiSun-03` 
theme and must work on most common themes or extension that uses standard date/time controls 
that relies on `cot_selectbox_date` function and `$R['input_date*']` resource strings.

But if your use highly customized theme or your custom resource strings (`$R['input_date*']`) than
extension may work uncorrectly.


### How extension works

Old style controls simply hides with inline styles but still work as input fields for transfer 
parameters to server (while you save the data).
New fancy style UI controls use jQuery UI library and dynamically added in pages in specially 
marked DIV containers. 

Simply it maked by changing controls template in resource strings `$R['input_date']` 
and `$R['input_date_short']`.

The default __ui_date/time__ template for _'short'_ date is:

    <div class="uidt mode-date" style="display:inline;">
		<div class="common_date" style="display:none;">
			{$day} {$month} {$year}
		</div>
		<div style="display:inline;" class="date_target">
		</div>
	</div> 


Most part of magic happened after page loads. JS script searches for elements 
with `uidt` class then 
parse it and linked with new controls added in block with class `date_target` 
and `time_target` class respectively. 
   
New control input field template is located in template now. See `ui_datetime.tpl` template file, `NEWINPUT` section. 

	<!-- BEGIN: NEWINPUT -->
	<input class="ui_input_tpl form-control" type="text" value="" /></div>
	<!-- END: NEWINPUT -->

Here you can alter _classes_ for you input field or wrap it with addition HTML tags.

By default extension tracks controls only on these pages: add/edit page, edit users, user profile.
You can switch on `global mode` in settings for trace all controls on all pages, but it's not recommened because will load extension files all the time.

This plugin tracks extrafields. So if you add extrafield with `datetime` type, it creates (by default) with UI_datetime html template, for proper view in page add/edit forms.

You can set default datetime value for extrafield with adding `data-set-time` attribute to main (`.uidt`) block.

	<div class="uidt mode-datetime-combined" data-set-date="+3600">... 

Value defined by shift in seconds from now().

Install
-------

* Unpack, copy files to root folder of your site.
* Install via Admin → Extensions menu (`Administration panel → Extensions`)
* If you already use jQueryUI in your project than setup path for jQueryUI library 
in ui_datetime [settings](www.example.com/admin/config?n=edit&o=plug&p=ui_datetime) .
If you use custom downloaded bundle of jQueryUI - be sure this lib include datepicker and slider wigets required for date/time picker and its version higher than 1.8.0.

**!Note:** If you upgrade extension from version prior to 1.6.0 make full uninstall previous version 
through admin panel and install new one. Do not update it with «update» button, or be sure 
to check actual path for new timepicker library. After that you can delete old js time picker library `time_pickr`
(`./js/time_pickr` - old folder for deletion. `./js/time_picker` is new one. Do not delete).

### Comments

After install you can see and test extension on Admin → Tools page
(`Administration panel → Extensions → UI date/time picker → Administration`).
You can Enable/Disable date and time controls separately via settings.


References
----------

* [Cotonti.com](http://Cotonti.com/) -- Home of Cotonti CMF
* [Discussion](http://www.cotonti.com/forums/?m=posts&q=7105) -- Forum thread about extension (in russian)
* [Discussion](http://www.cotonti.com/forums?m=posts&q=7118) -- Forum thread about extension (in english)


