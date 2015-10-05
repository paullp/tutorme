<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/modal.css" />
<script>
$(document).ready(function() {
$('a.login-window').click(function() {
    
            //Getting the variable's value from a link 
    var loginBox = $(this).attr('href');

    //Fade in the Popup
    $(loginBox).fadeIn(300);
    
    //Set the center alignment padding + border see css style
    var popMargTop = ($(loginBox).height() + 24) / 2; 
    var popMargLeft = ($(loginBox).width() + 24) / 2; 
    
    $(loginBox).css({ 
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });
    
    // Add the mask to body
    $('body').append('<div id="mask"></div>');
    $('#mask').fadeIn(300);
    
    return false;
});

// When clicking on the button close or the mask layer the popup closed
$('a.close, #mask').live('click', function() { 
  $('#mask , .login-popup').fadeOut(300 , function() {
    $('#mask').remove();  
}); 
return false;
});
});
</script>

<a href="#login-box" class="login-window">Login / Sign In</a>
<div id="login-box" class="login-popup">
<?php

	$day = 0;
	while($day < 7){
		if($day == 0){echo "Monday &nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Monday";}
		else if($day == 1){echo "Tuesday &nbsp&nbsp&nbsp&nbsp"; $name = "Tuesday";}
		else if($day == 2){echo "Wednesday"; $name = "Wednesday";}
		else if($day == 3){echo "Thursday&nbsp&nbsp&nbsp&nbsp"; $name = "Thursday";}
		else if($day == 4){echo "Friday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Friday";}
		else if($day == 5){echo "Saturday&nbsp&nbsp&nbsp&nbsp"; $name = "Saturday";}
		else if($day == 6){echo "Sunday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Sunday";}
		$index = 0;
		foreach($schedule_time as $st){
			echo "<input type='radio' ondblclick='uncheck(this)' name='$name'  value='$st->id'>$st->time";  
			$index++;
		}
		echo "</br>";
		$day++;
	}
?><button class="close">asdasd</button>
  </form>
</div>