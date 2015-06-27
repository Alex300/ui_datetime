$(function() {
	$('.togglelink').show();
	$('.uisource').click(function(e){
		$('.uidt').toggle();
		return false;
	});
	$('.uioff').click(function(e){
		$('div[class^=newui_]').toggle();
		return false;
	});
	$('.uiformat').click(function(e){
		$('.uidt_format').toggle();
		return false;
	});
});