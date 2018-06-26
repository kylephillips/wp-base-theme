function acfTinyMCEclasses() {
	if (jQuery('.acf-field-wysiwyg').length) {
		var checkEditors = setInterval(function(){
			var editorfelder = jQuery('.acf-field-wysiwyg').length;
			var iframefelder = jQuery('.acf-field-wysiwyg iframe').length;
			if (editorfelder == iframefelder) {
				clearInterval(checkEditors);
				parseEditors();
			}
		},2500);
	}
}	
function parseEditors() {
	jQuery('.acf-field-wysiwyg').each(function() {
		var fieldname = jQuery(this).attr('data-name');
		jQuery('iframe',this).contents().find('body').addClass('acf_'+fieldname);
	});
}
jQuery(document).ready(function(){
    acfTinyMCEclasses(); 
});