$('form input.date').datepicker({
			showOn: "button",
			buttonImage: "/bundles/espacio/images/calendar.gif",
                    	buttonImageOnly: true });
                    
$(function() {
		$( "#accordion" ).accordion({
			
                        autoHeight: false,
                        event: "mouseover"
		});
	});