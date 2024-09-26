<!-- BEGIN: NEWRESOURCE -->
<div class="uidt mode-{MODE}" style="display: inline;">{INPUT_RESOURCE}</div>
<!-- END: NEWRESOURCE -->

<!-- BEGIN: NEWDATE -->
<div class="common_date" {ATTRIBUTES}>{STANDARD_DATE_CONTROL}</div><div style="display:inline;" class="date_target"></div>
<!-- END: NEWDATE -->

<!-- BEGIN: NEWTIME -->
<div class="common_time" {ATTRIBUTES}>{STANDARD_TIME_CONTROL}</div><div style="display:inline;" class="time_target"></div>
<!-- END: NEWTIME -->

<!-- BEGIN: ATTR --><!-- BEGIN: TOOLSMODE -->data-target="{TARGET}" data-show="source" <!-- BEGIN: DATE -->data-showformat="{SHOW_DATEFORMAT}" <!-- END: DATE--><!-- END: TOOLSMODE --><!-- BEGIN: HIDDENSOURCE -->style="display:none;"<!-- END: HIDDENSOURCE --><!-- BEGIN: SUPPORTTOUCH -->data-touch="true"<!-- END: SUPPORTTOUCH --><!-- END: ATTR -->

# In NEWINPUT you can alter template that should be used for new datetime input field
# Note! You can wrap it with addition tags, add more classes but class `ui_input_tpl` should be present in input field anyway.
<!-- BEGIN: NEWINPUT -->
<input class="ui_input_tpl form-control" type="text" value="" autocomplete="off" /></div>
<!-- END: NEWINPUT -->
