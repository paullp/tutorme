<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script  LANGUAGE=JAVASCRIPT TYPE="TEXT/JAVASCRIPT">
	  $(function() {
		var dateToday = new Date(); 
		var default_date = $("#datepicker").val(); 
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		   changeYear: true, yearRange: '1900:+0',
		  minDate: dateToday
		});
		$( "#datepicker" ).datepicker( "setDate",default_date);
	  });
	  
	  $(window).load(function(){
		$("#datepicker").change(function(){
			var dt = new Date($(this).val());
			var dd = dt.getDate();
			var mm = dt.getMonth()+1;
			var yyyy = dt.getFullYear();
			if(dd<10){
				dd='0'+dd
			} 
			if(mm<10){
				mm='0'+mm
			} 
			var sched = yyyy+'/'+mm+'/'+dd;
			
			index = dt.getDay();
			
			var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
			var name_day = days[index]+","+sched;
			$.ajax({
			   type : "POST",
			   url  : "<?php echo base_url(); ?>index.php/home/get_sched_time",
			   datatype: "json",
			   data : "name_day=" + name_day,
			   success: function(data){
				   $("#value").val(data);
				   $("#schedule_time").html(data);
			   }
			});
		});

		});
				
		function edit_schedule()
		{
				
				$.ajax({
				type : "POST",
				url  : "<?php echo base_url(); ?>index.php/home/edit_sched",
				datatype: "json",
				data : "monday=" + $("#Monday").val() + "&tuesday=" + $("#Tuesday").val() + "&wednesday=" + $("#Wednesday").val() + "&thursday=" + $("#Thursday").val() + "&friday=" + $("#Friday").val() + "&saturday=" + $("#Saturday").val() + "&sunday=" + $("#Sunday").val(),
				success: function(data){
					$("#datepicker").trigger(changed);
				}
			});
		};
		
 </script>
<?php

	if($usertype == 3 and $edit == true)
	{
		echo "<form method='POST' action='";
		echo  base_url();
		echo "index.php/home/edit_appointment'>";
	}
	
	echo "<table align='center' border='0'>";


	foreach($appointment_info as $ai)
	{	
		
		
		if($usertype==3 or $usertype==1)
		{	echo "<tr>";
			echo "<td align='right'>Teacher : </td><td>$ai->teacher_last_name,$ai->teacher_first_name</td>";
			echo "</tr>";
		}
		
		if($usertype==2 or $usertype==1)
		{
			echo "<tr>";
			echo "<td align='right'>Student :</td><td>$ai->student_last_name,$ai->student_first_name</td>";
			echo "</tr>";
		}
		
		if($edit == false)
		{
			echo "
			
			<td align='right'>Date : </td>
				<td>".date("m-d-Y", strtotime($ai->date))."</td>
				</tr>
			<tr>
				<td align='right'>Time : </td>
				<td>$ai->time</td>
			</tr>
			<tr>
				<td align='right'>Place : </td>
				<td>$ai->place</td>
			</tr>
			";
			
			if($ai->status != "FINISHED" AND $ai->status != "REJECTED")
			{
			if($usertype == 2 and $ai->status == "PENDING")
			{
				echo "<tr>
					<td colspan='2' align='center'>
					<a href='";
						echo base_url();
						echo "index.php/home/approve_appointment?id=$ai->id'>
						<button>
							Approve Appointment
						</button>
					</a>
					<a href='";						
						echo base_url();
						echo "index.php/home/reject_appointment?id=$ai->id'
						onclick='return confirm(\"Are you sure you want to reject this appointment?\")'>
						<button>
							Reject Appointment
						</button>
					</a>
					</td>
					</tr>
					";
			}
			elseif($ai->status == "APPROVED")
			{
					
					echo "
					<tr>
					<td>
					<a href='".base_url()."index.php/home/finished_appointment?id=$ai->id' onclick='return confirm(\"Finished Appointment?\")'>
						<button>
							Finished Appointment
						</button>
					</a>
					</td>
					<td>
					<a href='".base_url()."index.php/home/cancel_appointment?id=$ai->id' onclick='return confirm(\"Are you sure you want to cancel this appointment?\")'>
						<button>
							Cancel Appointment
						</button>
					</a>
					</td>
					</tr>";			
			}
			}
		}
		elseif($usertype == 3 and $edit == true)
		{
			echo "		<tr>
							<td>
								Date :
							</td>
							<td>
								<input type='hidden' name='previous_date' value='".date("m/d/Y", strtotime($ai->date))."'>
								<input type='input' name='schedule_date' id='datepicker' value='".date("m/d/Y", strtotime($ai->date))."'>
							</td>
						</tr>
					<tr>
						<td>
							Time :
						</td>
						<td>
							<input type='hidden' name='previous_time_id' value='$ai->sched_time_id'>
							<input type='hidden' name='previous_time' value='$ai->time'>
							<div id='schedule_time'/>
							<input type='hidden' name='schedule_time_id' id='value' value='$ai->sched_time_id'>
							<input type='hidden' name='schedule_time' id='value' value='$ai->time'>
							$ai->time</div>
							<a href='#schedule-box' onclick='schedule_window(this)'>Edit schedule here.</a>
						</td>
					</tr>
					<tr>
						<td>
							Place :
						</td>
						<td>
							<input type='hidden' name='previous_place' maxlength='50' size='20' value='$ai->place'/>
							<input type='text' name='place' maxlength='50' size='20' value='$ai->place'/>
						</td>
					</tr>";
		}
	
	if($usertype == 3)
	{
		if($ai->status != "APPROVED" AND $ai->status != "FINISHED" AND $ai->status != "CANCELLED")
		{
			echo "<tr>
				<td colspan='2' align='center'>";
				if($edit == false)
				{
					echo "<a href='";
					echo base_url();
					echo "index.php/home/appointment_messages?id=$ai->id&action=true'>";
				}
				echo "
				<input type='hidden' name='appointment_id' value='$ai->id'/>
				<button>Edit Appointment</button></a>";
					echo "<a href='";
					echo base_url();
					echo "index.php/home/cancel_appointment?id=$ai->id'
					onclick='return confirm(\"Are you sure you want to cancel this appointment?\")'>
					<button>Cancel Appointment</button>
					</td>
			</tr>";
		}
	}
	
	}
	
	if($usertype == 3 and $edit == true)
	{
		echo "</form>";
	}
?>
</table>

<div id="schedule-box" class="schedule-popup">
<form method="POST" action="#"/>
<table>
<tr>
	<td align="center">
		Your Schedule
	</td>
</tr>
<tr>
	<td>
<?php
	$day = 0;
	while($day < 7){
		echo "<tr>";
			echo "<td>";
		if($day == 0){echo "Monday"; $name = "Monday";}
		else if($day == 1){echo "Tuesday"; $name = "Tuesday";}
		else if($day == 2){echo "Wednesday"; $name = "Wednesday";}
		else if($day == 3){echo "Thursday"; $name = "Thursday";}
		else if($day == 4){echo "Friday"; $name = "Friday";}
		else if($day == 5){echo "Saturday"; $name = "Saturday";}
		else if($day == 6){echo "Sunday"; $name = "Sunday";}
		$index = 0;
			echo "</td>";
		echo "<td><select id='$name' name='$name'>";
		foreach($schedule_time as $st){
			
			echo "<option name='$name' value='$st->id'";
				$name_lower = strtolower($name);
				foreach($schedule as $s)
				{
					if($s->$name_lower == $st->id)
					{	
						echo "selected";
					}
				}
			echo ">$st->time</option>"; 
			$index++;
		}
		echo "</select></td>";
		$day++;
		echo "</tr>";
	}
?>
	</td>
</tr>
<tr>
	<td align="center">
		<button type="button" id="edit_button" onClick="edit_schedule()">Edit</button>
		<button type="button" onClick="schedule_popup_close()">Close</button>
	</td>
</tr>
</table>
</form>
</div>
