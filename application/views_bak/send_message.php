<?php
echo form_open_multipart("register/create_appointment");
$cell = array('data' => 'Request Appointment', 'colspan' => 2, 'align' => 'center');
$this->table->set_heading($cell);
foreach($teacher_profile as $tl){
$list = array(
'Teacher : '                                                     ,$tl->last_name.", ".$tl->first_name.
																  "<input type='hidden' name='teacher_id' value='$tl->id'/>",
'Date : '                                                        ,'<input type="input" name="schedule_date" id="datepicker" value='.set_value('schedule_date').'>',
'Time : '.form_error('time')                                     ,'<div id="schedule_time"/>'.form_error('schedule_date').'<input type="hidden" name="schedule_time_id" id="value" value='.set_value('schedule_time').'></div>
																   <a href="#schedule-box" onclick="schedule_window(this)">Edit schedule here.</a>',
'Place : '.form_error('place')                                   ,'<input type="text" name="place" maxlength="50" value="'.set_value('place').'"/>',
'Message : '                                                     ,'<textarea name="message" maxlength="200" cols="50" rows="10"></textarea>',
''																 ,"<input type='submit' name='submit' value='submit'/>"
);
};
$new_list = $this->table->make_columns($list, 2);
echo $this->table->generate($new_list);

echo "</form>";
?>
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
		if($day == 0){echo "Monday &nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Monday";}
		else if($day == 1){echo "Tuesday &nbsp&nbsp&nbsp&nbsp"; $name = "Tuesday";}
		else if($day == 2){echo "Wednesday"; $name = "Wednesday";}
		else if($day == 3){echo "Thursday&nbsp&nbsp&nbsp&nbsp"; $name = "Thursday";}
		else if($day == 4){echo "Friday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Friday";}
		else if($day == 5){echo "Saturday&nbsp&nbsp&nbsp&nbsp"; $name = "Saturday";}
		else if($day == 6){echo "Sunday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Sunday";}
		$index = 0;
		foreach($schedule_time as $st){
			
			echo "<input type='radio' ondblclick='uncheck(this)' name='$name' value='$st->id'";
				$name_lower = strtolower($name);
				foreach($schedule as $s)
				{
					if($s->$name_lower == $st->id)
					{
						echo "checked";
					}
				}
			echo ">$st->time"; 
			$index++;
		}
		echo "</br>";
		$day++;
	}
?>
	</td>
</tr>
<tr>
	<td align="center">
		<button type="button" id="edit_button">Edit</button>
		<button type="button" onClick="schedule_popup_close()">Close</button>
	</td>
</tr>
</table>
</form>
</div>
<script  LANGUAGE=JAVASCRIPT TYPE="TEXT/JAVASCRIPT">
	  $(function() {
		var dateToday = new Date(); 
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  minDate: dateToday	  
		});
		if($("#datepicker").val() != "")
		{
			var dt = new Date($("#datepicker").val());
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
			   url  : "<?php echo base_url(); ?>index.php/register/get_sched_time",
			   datatype: "json",
			   data : "name_day=" + name_day,
			   success: function(data){
				   $("#value").val(data);
				   $("#schedule_time").html(data);
			   }
			});
		}
	  });
	  
	  $(window).load(function(){
		$("#datepicker").change(function(){
		if($(this).val() != "")
		{
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
			   url  : "<?php echo base_url(); ?>index.php/register/get_sched_time",
			   datatype: "json",
			   data : "name_day=" + name_day,
			   success: function(data){
				   $("#value").val(data);
				   $("#schedule_time").html(data);
			   }
			});
		}
		else
		{
			data = "";
			$("#schedule_time").html(data);
		}
		});
		
		$("#edit_button").click(function(){
			var monday = "e";
			var tuesday = "e";
			var wednesday = "e";
			var thursday = "e";
			var friday = "e";
			var saturday = "e";
			var sunday = "e";
			var index = 0;
			while(index < 6)
			{
				if(document.getElementsByName("Monday")[index].checked == true && monday == "e")
				{
					monday = document.getElementsByName("Monday")[index].value;
				}if(document.getElementsByName("Tuesday")[index].checked == true && tuesday == "e")
				{
					tuesday = document.getElementsByName("Tuesday")[index].value;
				}if(document.getElementsByName("Wednesday")[index].checked == true && wednesday == "e")
				{
					wednesday = document.getElementsByName("Wednesday")[index].value;
				}if(document.getElementsByName("Thursday")[index].checked == true && thursday == "e")
				{
					thursday = document.getElementsByName("Thursday")[index].value;
				}if(document.getElementsByName("Friday")[index].checked == true && friday == "e")
				{
					friday = document.getElementsByName("Friday")[index].value;
				}if(document.getElementsByName("Saturday")[index].checked == true && saturday == "e")
				{
					saturday = document.getElementsByName("Saturday")[index].value;
				}if(document.getElementsByName("Sunday")[index].checked == true && sunday == "e")
				{
					sunday = document.getElementsByName("Sunday")[index].value;
				}
				index++;
			}

			//alert(monday +"="+ tuesday +"="+ wednesday +"="+ thursday +"="+ friday +"="+ saturday +"="+ sunday);
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url(); ?>index.php/home/edit_sched",
				datatype: "json",
				data : "monday=" + monday + "&tuesday=" + tuesday + "&wednesday=" + wednesday + "&thursday=" + thursday + "&friday=" + friday + "&saturday=" + saturday + "&sunday=" + sunday,
				success: function(data){
					//$("#ddd").html(data);
				}
			});
			alert("Updated");
			$("#datepicker").trigger("change");
		});
		});
		
</script>