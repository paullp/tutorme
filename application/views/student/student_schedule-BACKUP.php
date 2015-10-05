
<table align="center">
<tr>
	<th colspan="2" align="center">
		My Schedule
	</th>
</tr>
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
	
	echo "
	<tr>
		<td colspan='2' align='center'><button onclick='edit_schedule()'>Update Schedule</button></td>
	</tr>
	";
?>
</table>

<table align="center" border="0">
	<tr>
		<th colspan='4'>
			Upcomming Schedule
		</th>
	</tr>
	<tr>
		<td align="center">Date</td>
		<td align="center">Time</td>
		<td align="center">Teacher</td>
		<td align="center">Place</td>
	</tr>
	
<?php

if($results != false)
{
	$rows = 0;
	foreach($results as $data) {
		echo "<tr>
			<td>";
			
			$date = date('Y-m-d');
			if(date('Y-m-d',strtotime($date . "+1 days")) == $data->date)
			{
				echo "Tomorrow";
			}
			else if(date('Y-m-d') == $data->date)
			{
				echo "Today";
			}
			else
			{
				echo $data->date;
			}
			
		echo "</td>
			<td>". $data->time ."</td>
			<td>". $data->last_name.", ". $data->first_name ."</td>
			<td>". $data->place ."</td>
			<td><a href='";
					echo base_url();
					echo "index.php/home/appointment_messages?id=$data->id'>
						Message";
						
						if($data->new_message != 0)
						{
							echo "($data->new_message)";
						}
						
		echo "</a></td>
		</tr>";
		
		$rows++;
	}
	while($rows < $per_page)
	{
		echo "<tr>
			<td>&nbsp</td>
			<td>&nbsp</td>
			<td>&nbsp</td>
			<td>&nbsp</td>
		</tr>";
		$rows++;
	}
	if($total_rows > $per_page)
	{
		echo "<tr><td colspan='4'>$links</td></tr>"; 
	}
}
else
{
echo "<tr>
		<td colspan='4'>
			No Upcomming Schedules
		</td>
	</tr>";
}

?>

</table>   
   
<script>
		function edit_schedule()
		{
				$.ajax({
				type : "POST",
				url  : "<?php echo base_url(); ?>index.php/home/edit_sched",
				datatype: "json",
				data : "monday=" + $("#Monday").val() + "&tuesday=" + $("#Tuesday").val() + "&wednesday=" + $("#Wednesday").val() + "&thursday=" + $("#Thursday").val() + "&friday=" + $("#Friday").val() + "&saturday=" + $("#Saturday").val() + "&sunday=" + $("#Sunday").val(),
				success: function(data){
					alert("Schedule Updated");
				}
			});
		};
</script>
