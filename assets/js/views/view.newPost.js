$(document).ready(function(){
     $('.combobox').combobox();
	 
	 if($(".num").length > 0 ){
		 $(".num").numeric();
	 }
	 
	 $('#delivery_dt').datetimepicker({
		language: 'en',
		pick12HourFormat: false,
		use24hours: true,
		showMeridian: false,
		icons: {
		                    time: "fa fa-clock-o",
		                    date: "fa fa-calendar",
		                    up: "fa fa-chevron-up",
		                    down: "fa fa-chevron-down"
		                }
	});
	$.fn.editable.defaults.mode = 'popup';
	$('#unit').editable();
    $('#unit').on('save', function(e, params) {
   	 $('#post_unit').val(params.newValue);
    });

});