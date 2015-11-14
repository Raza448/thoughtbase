$(document).ready(function(){
	$.fn.editable.defaults.mode = 'inline';

	 $('#eventType').editable({
	           value: 1,    
	           source: [
	                 {value: 1, text: 'Personal Event'},
	                 {value: 2, text: 'Coperate Event'},
	              ]
	       });
	  $('#eventSubType').editable({
	  	           value: 1,    
	  	           source: [
	  	                 {value: 1, text: 'Birthday Party'},
	  	                 {value: 2, text: 'Wedding'},
	  	              ]
	});
  	$('#category').editable({
  	           value: 1,    
  	           source: [
  	                 {value: 1, text: 'Catering'},
  	                 {value: 2, text: 'Photo Both'},
  	              ]
			  });
	
	$('#delivery_dt').editable({  
		        combodate: {
		                minYear: 2000,
		                maxYear: 2015,
		                minuteStep: 1
		           }
	});
	$('#address').editable({
	        url: '',
	        title: 'Enter address',
	        rows: 4
	 });
	 $('#budget').editable({
	        url: '',
	        title: 'Enter budget'
	  });
	  $('#quantity').editable({
	         url: '',
	         title: 'Enter quantity'
	     });
		 $('#unit').editable({
		        url: '',
		        title: 'Enter unit'
		    });
   	 $('#contact').editable({
   		        url: '',
   		        title: 'Enter contact'
     });
   	$('#contactTime').editable({
   	           value: 4,    
   	           source: [
   	                 {value: 1, text: 'No Preperence'},
   	                 {value: 2, text: 'Morning (9am - 12pm)'},
					 {value: 3, text: 'Afternoon (12pm - 6pm)'},
					 {value: 4, text: 'Evening (6pm - 9pm)'}
   	              ]
 			  });
	$('#description').editable({
		  	        url: '',
		  	        title: 'Enter requirements',
		  	        rows: 4
		  	 });
});