jQuery(document).ready(function($) {
    
    $("body").on("generate_hide_sections", function() {
        // Show sidebar metabox
		$('#generate_layout_meta_box').show();
		$('#generate_layout_meta_box-hide').prop('checked', true);
    });
    
    $("body").on("generate_show_sections", function() {
        // Hide sidebar metabox
		$('#generate_layout_meta_box').hide();
		$('#generate_layout_meta_box-hide').prop('checked', false);
    });

});