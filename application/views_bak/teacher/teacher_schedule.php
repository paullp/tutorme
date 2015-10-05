<form method="post" action="<?php echo base_url();?>index.php/home/edit_profile" enctype="multipart/form-data">
<?php
foreach($schedule as $sch)
{
	$sched[0] = $sch->monday;
	$sched[1] = $sch->tuesday;
	$sched[2] = $sch->wednesday;
	$sched[3] = $sch->thursday;
	$sched[4] = $sch->friday;
	$sched[5] = $sch->saturday;
	$sched[6] = $sch->sunday;
}
echo"
<table align='center' border='0'>
<tr>
	<th colspan='2' align='center'>
		My Schedule
	</th>
</tr>";
$day = 0;
while($day < 7){
	echo"<tr>
		<td>";
		if($day == 0){echo "Monday &nbsp&nbsp&nbsp&nbsp&nbsp";}
		else if($day == 1){echo "Tuesday &nbsp&nbsp&nbsp&nbsp";}
		else if($day == 2){echo "Wednesday";}
		else if($day == 3){echo "Thursday&nbsp&nbsp&nbsp&nbsp";}
		else if($day == 4){echo "Friday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";}
		else if($day == 5){echo "Saturday&nbsp&nbsp&nbsp&nbsp";}
		else if($day == 6){echo "Sunday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";}
		echo "</td>
				<td>";
		$index = 0;
		foreach($schedule_time as $st){
			echo "<input type='checkbox' name='schedule[$day][$index]' value='$st->id'";
				$index2 = 0;
				while(isset($sched[$day][$index2])){
					if($sched[$day][$index2] == $st->id){
						echo "checked";
					}
					$index2++;
				}
			echo ">$st->time";  
			$index++;
		}
		
		echo "</td>
		</tr>";
	$day++;
}
echo "
<tr>
	<td colspan='2' align='center'>
		<input type='hidden' name='my_schedule' value='true'/>
		<input type='hidden' name='user_id' value='$id'/>
		<input type='submit' value='edit_schedule'/>
	</td>
</tr>
</table>";
?>
</form>
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