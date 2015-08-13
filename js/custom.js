// JavaScript Document
jQuery(document).ready(function(){
	jQuery("#save_settings").click(function(){
		var gwidth = jQuery("#google_width").val();							
		if(gwidth<120 || gwidth >450)
		{
			alert(msg1);
			jQuery("#google_width").val('');
			jQuery("#google_width").focus()
			return false;
		}
		if(! jQuery.isNumeric(gwidth))
		{
			alert(msg2);
			jQuery("#google_width").val('');
			jQuery("#google_width").focus();
			return false;
		}
		return true;
	});						
});