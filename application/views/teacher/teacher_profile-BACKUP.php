<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/image_upload.js"></script>
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
foreach($user_info as $ui)
{
	$email              = $ui->email;
	$password           = $ui->password;
	$last_name          = $ui->last_name;
	$first_name         = $ui->first_name;
	$current_location   = $ui->current_location;
	$gender             = $ui->gender;
	$birthday           = date("m/d/y",strtotime($ui->birthday));
	$photo              = "<img src='".base_url().$ui->photo."' style='width:144px;height:144px'></td>";
	$occupation         = $ui->occupation;
	$teaching_exp       = $ui->teaching_exp;
	$rate               = $ui->rate_per_hour;
	$preferred_location = $ui->preferred_location;
	$about_me           = $ui->about_me;
	if($edit_profile == true)
	{
		if($usertype == 1)
		{
		$email = "<input type='text' name='email' value='$ui->email'/>";
		$password = "<input type='text' name='password' value='$ui->password'/>"; 
		$last_name = "<input type='text' name='last_name' value='$ui->last_name'/>"; 
		$first_name = "<input type='text' name='first_name' value='$ui->first_name'/>";
		$current_location = "<input type='text' name='current_location' value='$ui->current_location'/>";
		$gender = "<input type='radio' name='gender' value='male'";
		if($ui->gender == "male")
		{
			$gender = $gender . "checked";
		}
		$gender = $gender . "/>Male <input type='radio' name='gender' value='female'";
		if($ui->gender == "female")
		{
			$gender = $gender . "checked";
		}
		$gender = $gender . "/>Female";
		$birthday = "<input type='input' name='birthday' id='datepicker' value='".date("m/d/Y",strtotime($ui->birthday))."'/>";
		
		
		$photo = "<img id='image' src='";
		$photo = $photo . base_url();
		$photo = $photo ."$ui->photo' style='width:144px;height:144px' onclick='previous();'></br>
					<div id='message'>Click image for previous one</div>
					<input type='file' name='photo' value='$ui->photo' id='photo' onChange='readURL(this);'>";
		$teaching_exp = "<input type='text' name='teaching_exp' value='$ui->teaching_exp'/>";
		$rate = "<input type='text' name='rate_per_hour' value='$ui->rate_per_hour'/>";
		$preferred_location = "<input type='text' name='preferred_location' value='$ui->preferred_location'/>";
		$about_me = "<input type='text' name='about_me' value='$ui->about_me'/>";
		
		}
	}
	echo "
		<input type='hidden' name='user_id' value='$ui->id'/>
		<input type='hidden' name='usertype' value='$ui->usertype'/>
		<input type='hidden' name='previous_photo' value='$ui->photo'/>";
}
echo"
		<table align='center' border='0'>
		<tr><th colspan='2'>My Profile </th></tr>
		<tr><td align='left'>Email : </td><td>$email</td></tr>
		<tr><td align='left'>Password : </td><td>$password</td></tr>
		<tr><td align='left'>Last Name : </td><td>$last_name</td></tr>
		<tr><td align='left'>First Name : </td><td>$first_name</td></tr>
		<tr><td align='left'>Current Location : </td><td>$current_location</td></tr>
		<tr><td align='left'>Gender : </td><td>$gender</td></tr>
		<tr><td align='left'>Birthday : </td><td>$birthday</td></tr>
		<tr><td align='left'>Photo : </td><td>$photo</td></tr>
		<tr><td align='left'>Occupation : </td><td>";
		if($usertype == 2 or $edit_profile == false)
		{
			echo $occupation;
		}
		elseif($edit_profile == true and $usertype == 1)
		{
			echo "<select name='occupation'>
				<option value='Student'";
				if($occupation == "Student")
					echo "selected='selected'";
				echo">Student</option>
				<option value='Part time Job'";
				if($occupation == "Part time Job")
					echo "selected='selected'";
				echo">Part time Job</option>
				<option value='Full time Job'";
				if($occupation == "Full time Job")
					echo "selected='selected'";
				echo">Full time Job</option>
				<option value='Unemployed'";
				if($occupation == "Unemployed")
					echo "selected='selected'";
				echo">Unemployed</option>				
			</select>";
		}
		echo "</td></tr>
		<tr><td align='left'>Teaching Experience : </td><td>$teaching_exp</td></tr>
		<tr><td align='left'>Rate per Hour : </td><td>$rate</td></tr>
		<tr><td colspan='2' align='center'>===================================</td></tr>
		<tr><th colspan='2' align='center'>Schedule</th></tr>
		<tr><td colspan='2'>";
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
					if($edit_profile == false)
					{
						echo "disabled='disabled'";
					}
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
		echo"</td></tr>
		<tr><td colspan='2' align='center'>===================================</td></tr>
		<tr><td align='left'>Preferred location : </td><td>$preferred_location</td></tr>
		<tr><td align='left'>About me : </td><td>$about_me</td></tr>
		<tr><td colspan='2' align='center'>";
		if($usertype == 2 or $usertype == 1)
		{
			if($edit_profile == false)
			{
				echo "<a href='";
				echo base_url();
				echo "index.php/home/my_profile?id=$id&edit_profile=TRUE&view_profile=teacher'>Edit Profile</a>";
			}
			else
			{
				echo "<input type='submit' value='submit'>";
			}
		}
		
		if($usertype == 3)
		{
				echo "<a href='";
				echo base_url();
				echo "index.php/register/create_appointment?teacher_id=$id'>Request an appointment</a> | ";
				echo "<a href='";
				echo base_url();
				echo "index.php/home/teacher_list'>Return to teacher list</a>";
		}
		echo "</td></tr>
		</table>";
?>
</form>
<script>
	$(function() {
	$('#message').hide();
		var default_date = $("#datepicker").val();	
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		  changeYear: true, yearRange: '1900:+0'
		});
		$( "#datepicker" ).datepicker( "setDate",default_date);
		<?php if($this->session->flashdata('msg')){ ?>
			alert('<?php echo $this->session->flashdata('msg'); ?>');
		<?php } ?>
	});
	function previous(){
		$('#image')
		.attr('src', "<?php echo base_url(). $ui->photo?>")
		.width(144)
		.height(144);
		$('#photo').val("");
		$('#message').hide();
	}
</script>