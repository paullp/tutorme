<link href='<?php echo base_url();?>assets/fullcalendar-2.3.1/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar-2.3.1/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script src='<?php echo base_url();?>assets/fullcalendar-2.3.1/moment.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar-2.3.1/fullcalendar.min.js'></script>


<script>
$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: "<?php echo $set_date;?>",
			editable: false,
                        eventLimit: true,
			allDaySlot: false,
			minTime: "09:00:00",
			maxTime: "22:00:00",
        events: {
            url: '<?php echo base_url()?>index.php/home/json_appointments',
            type: 'POST', // Send post data
            error: function() {
                alert('There was an error while fetching events.');
            }
        }
    });
});

</script>
<style>

	body {
		margin: 0px 0px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 100%;
	}

</style>


<form method="POST" action="<?php echo base_url();?>index.php/home/appointments_fullcalendar">
Date : <input type='input' name='set_date' id='datepicker'>
<input type='submit' name='submit'/>
</form>
<div id="calendar"></div>


