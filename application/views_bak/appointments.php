<?php
echo "<table align='CENTER' border='0'>
	<tr>
		<th colspan='5'>
			APPOINTMENTS
		</th>
	</tr>
	<tr>";
	if($usertype != 1)
	{
		echo"<td colspan='6' align='center'>
			
			<a href='";
			echo base_url();
			echo "index.php/home/appointments'>ALL</a> |
			
			<a href='";
			echo base_url();
			echo "index.php/home/appointments?status=PENDING'>PENDING</a> |
			
			<a href='";
			echo base_url();
			echo "index.php/home/appointments?status=APPROVED'>APPROVED</a> |
			
			<a href='";
			echo base_url();
			echo "index.php/home/appointments?status=FINISHED'>FINISHED</a> |
			
			<a href='";
			echo base_url();
			echo "index.php/home/appointments?status=CANCELLED'>CANCELLED</a>
			</td>";
	}
	else
	{?>
		<form method="GET" action="<?php echo base_url();?>index.php/home/appointments">
	<?php
			echo "<td colspan='6' align='center'>
			Teachers: <select name='teacher'>
			<option value='-'>Select Teacher</option>";
			foreach($dropdown_teacher as $dt)
			{
				echo "<option value='$dt->id'";
						if($teacher == $dt->id)
						{
							echo "selected";
						}				
				echo ">$dt->last_name, $dt->first_name</option>";
			}
			echo "</select>
				
			Students: <select name='student'>
			<option value='-'>Select Student</option>";
			foreach($dropdown_student as $st)
			{
					echo "<option value='$st->id'";
						if($student == $st->id)
						{
							echo "selected";
						}
					echo ">$st->last_name, $st->first_name</option>";
			}
			echo " </select>
			
			Status: <select name='status'>
			<option value='-'>Select Status</option>
			<option value='PENDING'";
					if($status == "PENDING")
					{
						echo "selected";
					}
			echo ">PENDING</option>
			<option value='APPROVED'";
					if($status == "APPROVED")
					{
						echo "selected";
					}
			echo ">APPROVED</option>
			<option value='FINISHED'";
					if($status == "FINISHED")
					{
						echo "selected";
					}
			echo ">FINISHED</option>
			<option value='CANCELLED'";
					if($status == "CANCELLED")
					{
						echo "selected";
					}
			echo ">CANCELLED</option>
			</td>
				<tr>
			<td colspan='6' align='center'>
				<input type='submit' value='Apply Filter'/>
			</td>
			</tr>
			</form>";
	}	
	
	echo "</tr>
	<tr>
		<td align='CENTER'>
			Appointment Date
		</td>
		<td align='CENTER'>
			Time
		</td>
		<td align='CENTER'>
			Teacher
		</td>";
		if($usertype == 1)
		{
			echo "<td align='CENTER'>
				Student
			</td>";
		}
		echo "<td align='CENTER'>
			Status
		</td>
		<td align='CENTER'>
			&nbsp
		</td>
	</tr>
	";
	if($usertype == 1)
	{
		$row = 0;
		$row2 = 0;
		foreach($appointments as $ap)
		{
			$row++;
			$row2++;
			echo "<tr onClick='appointment($ap->id)' style='cursor:pointer'>
				<td>";
					
					echo date("d M Y",strtotime($ap->date));
					
			echo"</td>
				<td>
					$ap->time
				</td>
				<td>
					$ap->teacher_last_name, $ap->teacher_first_name
				</td>
				<td>
					$ap->student_last_name, $ap->student_first_name
				</td>
				<td>
					$ap->status
				</td>
			</tr>";
		

		}
		while($row < $per_page)
		{
			echo "<tr><td>&nbsp</td></tr>";
			$row++;
		}
		if($total_rows > $per_page)
		{
			echo "<tr>
					<td>
						$links
					</td>
				</tr>";
		}
	}
	else
	if($appointments != FALSE)
	{
		$row = 0;
		$row2 = 0;
		foreach ($appointments as $ap)
		{
			$row++;
			$row2++;
			echo "<tr onClick='appointment($ap->id)' style='cursor:pointer'>
				<td>
					$ap->date
				</td>
				<td>
					$ap->time
				</td>
				<td>
					$ap->last_name, $ap->first_name
				</td>
				<td>
					$ap->status
				</td>";
				//<td>";
				// if($ap->status != "FINISHED")
				// {
					// if($ap->new_message != 0)
					// {
					// echo "<a href='";
					// echo base_url();
					// echo "index.php/home/appointment_messages?id=$ap->id'>
						// Message";
							// echo "($ap->new_message)";
					// }
					// echo "</a>";
				// }
				// else
				// {
					// echo "FINISHED";
				// }
				// echo"</td>
			echo "</tr>";
		}
		
		while($row < $per_page)
		{
			echo "<tr><td>&nbsp</td></tr>";
			$row++;
		}
		if($total_rows > $per_page)
		{
			echo "<tr>
					<td>
						$links
					</td>
				</tr>";
		}
	}
	else
	{
		//NO APPOINTMENTS YET
	}
echo "</table>";
?>
<script>
	function appointment(id)
	{
		window.location ="<?php echo base_url();?>index.php/home/appointment_messages?id="+id;
	}
	$(function() {
	<?php if($this->session->flashdata('msg')){ ?>
	alert('<?php echo $this->session->flashdata('msg'); ?>');
	<?php } ?>
	});
</script>