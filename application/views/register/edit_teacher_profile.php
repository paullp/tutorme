<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/image_upload.js"></script>
<?php
foreach ($teacher_profile as $tp)
{
?>
<script>
$( document ).ready(function() {
	$('#message').hide();
});

function previous(){
	$('#image')
	.attr('src', "<?php echo base_url(). $tp->photo?>")
	.width(144)
	.height(144);
	$('#photo').val("");
	$('#message').hide();
}
</script>
	<form method="POST"  autocomplete="off" action="<?php echo base_url();?>index.php/edit_user/edit_teacher_profile" enctype="multipart/form-data">
	<input type="hidden" name="created_on" value=<?php echo $tp->created_on;?>">
	<input type="hidden" name="id" value=<?php echo $tp->id;?>>
	<input type="hidden" name="resume" value=<?php echo $tp->resume;?>>
	<input type="hidden" name="old_photo" value=<?php echo $tp->photo;?>>
	<input type="hidden" name="old_lastname" value=<?php echo $tp->last_name;?>>
	<table align="center" border="0"cellpadding="0" cellspacing="0" width="50%">
		
		<tr>
			<td align="center" colspan="2">
				Teacher Register
			</td>
		</tr>
		
		<tr>
			<td width="20%">
				E-mail:
			</td>
			<td>
				<input type="input" name="email" maxlength="50" value="<?php echo $tp->email;?>"/>
			</td>
		</tr>
		
		<tr>
			<td width="20%">
				Password:
			</td>
			<td>
				<input type="password" name="password" maxlength="50"/>
			</td>
		</tr>
		
		<tr>
			<td width="20%">
				Confirm Password:
			</td>
			<td>
				<input type="password" name="confirm_password" maxlength="50"/>
			</td>
		</tr>
		
		<tr>
			<td colspan="2" align="center">
				Teacher Information
			</td>
		</tr>
		
		<tr>
			<td width="30%">
				Last Name:
			</td>
			<td>
				<input type="input" name="lastname" maxlength="20" value="<?php echo $tp->last_name;?>"/>
			</td>
		</tr>
		
		<tr>
			<td width="20%">
				Fist Name:
			</td>
			<td>
				<input type="input" name="firstname" maxlength="20" value="<?php echo $tp->first_name;?>"/>
			</td>
		</tr>
			
		<tr>
			<td width="20%">
				Gender:
			</td>
			<td>
				<input type="radio" name="gender" value="male" <?php if($tp->gender == "male"){echo "checked";}?>/>Male
				<input type="radio" name="gender" value="female"  <?php if($tp->gender == "female"){echo "checked";}?>/>Female
			</td>
		</tr>

		<tr>
			<td width="20%">
				Current Location:
			</td>
			<td>
				<input type="input" name="current_location" maxlength="20" value="<?php echo $tp->current_location;?>"/>
			</td>
		</tr>

		<tr>
			<td width="20%">
				Birthday:
			</td>
			<td>
				<?php 
					$year = date('Y', strtotime($tp->birthday));
					$month = date('m', strtotime($tp->birthday));
					$day = date('d', strtotime($tp->birthday));
				?>
				Month
				<select name="month">
				<option value="0" <?php if($month == "0"){echo "selected";}?>>-</option>
				<option value="1" <?php if($month == "1"){echo "selected";}?>>January</option>
				<option value="2" <?php if($month == "2"){echo "selected";}?>>February</option>
				<option value="3" <?php if($month == "3"){echo "selected";}?>>March</option>
				<option value="4" <?php if($month == "4"){echo "selected";}?>>April</option>
				<option value="5" <?php if($month == "5"){echo "selected";}?>>May</option>
				<option value="6" <?php if($month == "6"){echo "selected";}?>>June</option>
				<option value="7" <?php if($month == "7"){echo "selected";}?>>July</option>
				<option value="8" <?php if($month == "8"){echo "selected";}?>>August</option>
				<option value="9" <?php if($month == "9"){echo "selected";}?>>September</option>
				<option value="10" <?php if($month == "10"){echo "selected";}?>>October</option>
				<option value="11" <?php if($month == "11"){echo "selected";}?>>November</option>
				<option value="12" <?php if($month == "12"){echo "selected";}?>>December</option>
				</select>
				Day
				<select name="day">
				<option value="">-</option>
				<?php
					for($x = 1; $x <= 31;$x++)
					{
						echo "<option value='$x'";
						if($day == $x)
						{
							echo "selected";
						}
						echo ">$x</option>";
					}
				?>
				</select>
				Year
				<select name="year">
				<option value="">-</option>
				<?php
					for($x = date("Y"); $x > 1949;$x--)
					{
						echo "<option value='$x'";
						if($year == $x)
						{
							echo "selected";
						}
						echo ">$x</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td width="20%">
					Occupation
			</td>
			<td>
				<input type="radio" name="occupation" value="Student"       <?php if($tp->occupation == "Student"){echo "checked";}?>/>Student </br>
				<input type="radio" name="occupation" value="Full time Job" <?php if($tp->occupation == "Full time Job"){echo "checked";}?>/>Full time Job </br>
				<input type="radio" name="occupation" value="Part Time Job" <?php if($tp->occupation == "Part Time Job"){echo "checked";}?> />Part Time Job </br>
				<input type="radio" name="occupation" value="Unemployed"    <?php if($tp->occupation == "Unemployed"){echo "checked";}?>/>Unemployed
			</td>
		</tr>
		
		<tr>
			<td width="20%">
					Teaching Experience
			</td>
			<td>
					<textarea name="teaching_exp" maxlength="200" rows="3" cols="30" style="font-family:Arial;"><?php echo $tp->teaching_exp;?></textarea> 
			</td>
		</tr>

		<tr>
			<td width="20%">
					Resume/CV*:
			</td>
			<td>
					<input type="file" name="file" id="file"> maxsize 8Mb
			</td>
		</tr>
			
		<tr>
			<td width="20%">
					Photo:
			</td>
			<td>
				<img id="image" src="<?php echo base_url(). $tp->photo?>" style="width:144px;height:144px" onclick="previous();"></br>
				<div id="message">Click image for previous one</div>
				<input type="file" name="photo" id="photo" onChange="readURL(this);">
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				Available Time:*
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<?php
				$day = 0;
				while($day < 7){
					if($day == 0){echo "Monday &nbsp&nbsp&nbsp&nbsp&nbsp";}
					else if($day == 1){echo "Tuesday &nbsp&nbsp&nbsp&nbsp";}
					else if($day == 2){echo "Wednesday";}
					else if($day == 3){echo "Thursday&nbsp&nbsp&nbsp&nbsp";}
					else if($day == 4){echo "Friday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";}
					else if($day == 5){echo "Saturday&nbsp&nbsp&nbsp&nbsp";}
					else if($day == 6){echo "Sunday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";}
					$index = 0;
					foreach($schedule_time as $st){
						echo "<input type='checkbox' name='schedule[$day][$index]' value='$st->id'";
							$index2 = 0;
							while(isset($sched[$day][$index2]) and $sched != NULL){
								if($sched[$day][$index2] == $st->id){
									echo "checked";
								}
								$index2++;
							}
						echo ">$st->time";  
						$index++;
					}
					echo "</br>";
					$day++;
				}
				?>
				</br>
			</td>
		</tr>
		
		<tr>
			<td>
				Preferred Lesson Location *
			</td>
			<td>
				<input type="radio" name="preferred_location" value="Cafe/Coffee shop nearby" <?php if($tp->preferred_location == "Cafe/Coffee shop nearby"){echo "checked";}?>/>Cafe/Coffee shop nearby
				<br><input type="radio" name="preferred_location" value="Your office" <?php if($tp->preferred_location == "Your office"){echo "checked";}?>/>Your office
			</td>
		</tr>
		
		<tr>
			<td>
				About me:
			</td>
			<td>
				<textarea name="about_me" maxlength="200" rows="5" cols="60" style="font-family:Arial;"><?php echo $tp->about_me?></textarea> 
			</td>
		</tr>
		
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="submit">
			</td>
		</tr>
	</table>
<?php
}
?>
</form>

