<form method="POST" action="<?php echo base_url();?>index.php/home/export_excel"/>
	<div align="center">
	Select Filter : <select name="status" id="filter" onchange="submit_filter()">
		<option value="-1">Select filter</option>
		<option value="0" <?php if($status == "0"){echo "selected";}?>>ALL</option>
		<option value="PENDING" <?php if($status == "PENDING"){echo "selected";}?>>PENDING</option>
		<option value="APPROVED" <?php if($status == "APPROVED"){echo "selected";}?>>APPROVED</option>
		<option value="REJECTED" <?php if($status == "REJECTED"){echo "selected";}?>>REJECTED</option>
		<option value="CANCELLED" <?php if($status == "CANCELLED"){echo "selected";}?>>CANCELLED</option>
		<option value="FINISHED" <?php if($status == "FINISHED"){echo "selected";}?>>FINISHED</option>
	</select>
	<input type="submit" value="Export to Excel"/>
	</div>
</form>
<?php
echo "<table align='center'>
	<tr>
		<th>Teacher</th>
		<th>Student</th>
		<th>Date</th>
		<th>Time</th>
		<th>Place</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
";
if($appointment_list == NULL)
{
	echo "<tr>
				<td colspan='8' align='center'>
					No Appointments Yet
				</td>
		</tr>";
}
else
{
foreach($appointment_list as $al)
{
	echo"
	<tr>
		<td align='center' width='200'> $al->teacher_last_name, $al->teacher_first_name</td>
		<td align='center' width='200'> $al->student_last_name, $al->student_first_name</td>
		<td align='center' width='100'> $al->date</td>
		<td align='center' width='100'> $al->time</td>
		<td align='center' width='100'> $al->place</td>
		<td align='center' width='100'> $al->status</td>
		<td align='center' width='150'>";
		if($al->status == "PENDING" || $al->status == "REJECTED" || $al->status == "FINISHED")
		{
			echo "-";
		}
		else if($al->status == "APPROVED")
		{
?>
			<a href="<?php echo base_url();?>index.php/home/appointment_action?id=<?php echo $al->id?>&user_id=<?php echo $al->teacher_id?>&status=CANCELLED" align="center" > Cancel </a>
<?php
		}
		
	echo "</td>
	</tr>";
};
}
echo "</table>";

?>

<script type="text/javascript">
	function submit_filter()
	{
		var filter = document.getElementById("filter").value;
		window.location = "<?php echo base_url();?>index.php/home/?status="+filter;
	}
</script>