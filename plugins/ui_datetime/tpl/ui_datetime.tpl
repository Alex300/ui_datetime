<!-- BEGIN: NEWRESOURCE -->
<div class="uidt mode-{mode}" style="display:inline;">{input_resource}</div>
<!-- END: NEWRESOURCE -->

<!-- BEGIN: NEWDATE -->
<div class="common_date" {attributes}>{standard_date_control}</div><div style="display:inline;" class="date_target">{new_date_control}</div>
<!-- END: NEWDATE -->

<!-- BEGIN: NEWTIME -->
<div class="common_time" {attributes}>{standard_time_control}</div><div style="display:inline;" class="time_target">{new_time_control}</div>
<!-- END: NEWTIME -->

<!-- BEGIN: ATTR --><!-- BEGIN: TOOLSMODE -->data-target="{target}" data-show="source" <!-- BEGIN: DATE -->data-showformat="{show_dateformat}" <!-- END: DATE--><!-- END: TOOLSMODE --><!-- BEGIN: HIDDENSOURCE -->style="display:none;"<!-- END: HIDDENSOURCE --><!-- BEGIN: SUPPORTTOUCH -->data-touch="true"<!-- END: SUPPORTTOUCH --><!-- END: ATTR -->

# In NEWINPUT you can alter template that should be used for new datetime input field
# Note! You can wrap it with addition tags, add more classes but class `ui_input_tpl` should be present in input field anyway.
<!-- BEGIN: NEWINPUT -->
<input class="ui_input_tpl form-control" type="text" value="" /></div>
<!-- END: NEWINPUT -->
