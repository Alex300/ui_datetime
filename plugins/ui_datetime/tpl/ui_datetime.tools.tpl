<!-- BEGIN: MAIN -->
<h2>{PHP.L.uidt_testpage}</h2>
<!-- IF {PHP.cfg.jquery} -->
<div class="block datetime_test container-fluid maxwidth" style="padding-top:15px;">
<table class="cells table table-striped table-bordered">
	<thead>
	<tr>
		<th class="coltop"></th>
		<th class="coltop">{PHP.L.uidt_oldstyle}</th>
		<th class="coltop">{PHP.L.uidt_newstyle}</th>
	</tr>
	</thead>
	<tbody>
		<tr>
			<td>{PHP.L.uidt_Date}</td>
			<td>{PHP.std_date}</td>
			<td><!-- IF {PHP.cfg.plugin.ui_datetime.enable_datepicker} -->
				<div class="newui_testdate"></div>
				<!-- ELSE -->
				{PHP.L.uidt_switchedoff}
				<!-- ENDIF -->
			</td>
		</tr>
		<tr>
			<td>{PHP.L.uidt_Time}</td>
			<td>{PHP.std_time}</td>
			<td><!-- IF {PHP.cfg.plugin.ui_datetime.enable_timepicker} -->
				<div class="newui_testtime"></div>
				<!-- ELSE -->
				{PHP.L.uidt_switchedoff}
				<!-- ENDIF -->
			</td>
		</tr>
		<tr>
			<td>{PHP.L.uidt_DateTime}</td>
			<td>{PHP.std_datetime}</td>
			<td><!-- IF {PHP.cfg.plugin.ui_datetime.enable_timepicker} OR {PHP.cfg.plugin.ui_datetime.enable_datepicker} -->
				<div class="newui_testdatetime"></div>
				<!-- ELSE -->
				{PHP.L.uidt_switchedoff}
				<!-- ENDIF -->
			</td>
		</tr>
		<tr>
			<td>{PHP.L.uidt_DateTime}{PHP.L.uidt_Combined}</td>
			<td>{PHP.std_datetime_combined}</td>
			<td><!-- IF {PHP.cfg.plugin.ui_datetime.enable_timepicker} OR {PHP.cfg.plugin.ui_datetime.enable_datepicker} -->
				<div class="newui_testdatetimecmb"></div>
				<!-- ELSE -->
				{PHP.L.uidt_switchedoff}
				<!-- ENDIF -->
			</td>
		</tr>

	</tbody>
</table>
</div>
<!-- ELSE -->
<div class="demo">
	<p>{PHP.L.uidt_jqueryrequired}</p>
</div>
<!-- ENDIF -->
<!-- END: MAIN -->