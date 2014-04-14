// JavaScript Document
jQuery(document).ready(function(){
	jQuery("#save_settings").click(function(){
		var gwidth = jQuery("#google_width").val();							
		if(gwidth<120 || gwidth >450)
		{
			alert('The width should be in between 120 to 450');
			jQuery("#google_width").val('');
			jQuery("#google_width").focus()
			return false;
		}
		if(! jQuery.isNumeric(gwidth))
		{
			alert('Width should be a number');
			jQuery("#google_width").val('');
			jQuery("#google_width").focus();
			return false;
		}
		return true;
	});						
});