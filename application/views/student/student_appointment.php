<?php
if($appointment_list == NULL)
{?>
	<p align="center"> No Appointments Yet</p>
	<p align="center"><a href="<?php echo base_url();?>index.php/home/teacher_list"> Create Appointment </a></p>
<?php
}
else
{
echo "<table align='center'>
	<tr>
		<th>Teacher</th>
		<th>Date</th>
		<th>Time</th>
		<th>Place</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
";
foreach($appointment_list as $al)
{
	echo"
	<tr>
		<td align='center' width='100'> $al->last_name, $al->first_name</td>
		<td align='center' width='100'>". date("m-d-Y", strtotime($al->date)) ."</td>
		<td align='center' width='100'> $al->time</td>
		<td align='center' width='100'> $al->place</td>
		<td align='center' width='100'> $al->status</td>
		<td align='center' width='150'>";

		if($al->status == "APPROVED")
		{
?>
			<a href="<?php echo base_url();?>index.php/home/appointment_action?id=<?php echo $al->id?>&status=CANCELLED" align="center" > Cancel </a>

<?php
		}
		else
		{
			echo "-";
		}
		
	echo "</td>
	<td>";
	?>
	<a href="<?php echo base_url();?>index.php/home/appointment_messages?id=<?php echo $al->id?>">Messages</a>
	<?php
	"</td>
	</tr>";
};
echo "</table>";
}
?>