<form method="POST" action="<?php echo base_url();?>index.php/home/create_appointment_exec">
<table align="center">
<tr>
	<td align="center" colspan="2">
		Create Appointment
	</td>
</tr>
<tr>
	<td>
		Student
	</td>
	<td>
		<?php foreach($student_info as $si){echo $si->last_name.", ".$si->first_name;
		
		echo "<input type='hidden' name='student_id' value='$si->id'>";
		
		};?>
	</td>
</tr>
<td>
	Date:
</td>
<td>
			Month
			<select name="month">
			<option value="0">-</option>
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
			</select>
			Day
			<select name="day">
			<option value="">-</option>
			<?php
				for($x = 1; $x <= 31;$x++)
				{
			?>
				<option value="<?php echo $x?>"><?php echo $x?></option>
			<?php
				}
			?>
			</select>
			Year
			<select name="year">
			<option value="">-</option>
			<?php
				for($x = date("Y"); $x > 1949;$x--)
				{
			?>
				<option value="<?php echo $x?>"><?php echo $x?></option>
			<?php
				}
			?>
			</select>
</td>
</tr>
<tr>
	<td>
		Schedule:
	</td>
	<td>
		<select name="schedule">
		<option value="-1">-----</option>
		<?php 
		foreach($schedule_time as $st){
			echo "<option value='$st->id'>$st->time</option>";
		};
		?>
		</select>
	</td>
</tr>
<tr>
	<td>
		Place:
	</td>
	<td>
		<input type="text" name="place" maxlength="50" size="50">
	</td>
</tr>
<tr>
	<td>
		Comment:
	</td>
	<td>
		<textarea name="comment" maxlength="200" rows="5" cols="55" style="font-family:Arial;"></textarea> 
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" name="submit">
	</td>
</tr>
</table>
</form>
