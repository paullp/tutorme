<table align="center">
<?php
	$from_id = "";
	foreach($messages as $mes)
	{
		$from_id = $mes->id;
?>		
		<tr>
			<td>
				From <?php echo $mes->first_name;?><br><br>
				<p style="font-size:10"><?php echo $mes->sent_on;?>
			</td>
			<td>
				<?php echo $mes->content?>
			</td>
		</tr>
<?php
	};
?>	

	
	<tr style="center">
		<td colspan="2">
			Reply
		</td>
	</tr>
		
	<tr style="center">
		<td colspan="2">
			<textarea name="appointment_message" maxlength="200" rows="5" cols="60" style="font-family:Arial;"></textarea> 
		</td>
	</tr>
	
	<tr>
		<td colspan="2" align="center">
			<a href="<?php echo base_url();?>index.php/home/create_appointment?from_id=<?php echo $from_id;?>"><button>Create Appointment</button></a>
		</td>
	</tr>
</table>