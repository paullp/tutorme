<?php
if($appointment_list == NULL)
{?>
	<p align="center"> No Appointments Yet</p>
<?php
}
else
{
echo "<table align='center'>
	<tr>
		<th>Student</th>
		<th>Date</th>
		<th>Time</th>
		<th>Place</th>
		<th>Comment</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
";
foreach($appointment_list as $al)
{
	echo"
	<tr>
		<td align='center' width='100'> $al->last_name, $al->first_name</td>
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
			<a href="<?php echo base_url();?>index.php/home/cancellation?id=<?php echo $al->id?>&user_id=<?php echo $al->teacher_id?>&status=CANCELLED" align="center" > Cancel </a>
<?php
		}
		
	echo "
	</td>
		<td align='center' width='100'>";
		
		?>	
			<a href="<?php echo base_url();?>index.php/home/appointment_messages?id=<?php echo $al->id?>">Messages</a>
		<?php
		
		echo"</td>
	</tr>";
};
echo "</table>";
}
?>