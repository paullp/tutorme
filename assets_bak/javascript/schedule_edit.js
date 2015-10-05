function schedule_window(sched)
{

//Getting the variable's value from a link 
	var loginBox = $(sched).attr('href');

	//Fade in the Popup
	$(loginBox).fadeIn(300);
	
	//Set the center alignment padding + border see css style
	var popMargTop = ($(loginBox).height() + 24) / 2; 
	var popMargLeft = ($(loginBox).width() + 24) / 2; 
	
	$(loginBox).css({ 
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});
	
	return false;
}
			// When clicking on the button close or the mask layer the popup closed

function schedule_popup_close(){
  $('#mask , .schedule-popup').fadeOut(300 , function() {
	$('#mask').remove();
	if($("#datepicker").value != "")
	{
		$("#datepicker").trigger("change");
	}
}); 
return false;
}

function uncheck(checkbox)
{
	checkbox.checked = false;
}