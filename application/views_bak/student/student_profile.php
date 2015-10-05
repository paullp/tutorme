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
	$native_language    = $ui->native_language;
	$mandarin_level     = $ui->mandarin_level;
	$lesson_frequency   = $ui->lesson_frequency;
	$preferred_location = $ui->preferred_location;
	$about_me           = $ui->about_me;
	if($edit_profile == true)
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
		$native_language = "<input type='text' name='native_language' value='$ui->native_language'/>";
		$mandarin_level ="<input type='radio' name='mandarin_level' value='Complete Beginner'";
		if($ui->mandarin_level == "Complete Beginner"){$mandarin_level = $mandarin_level . "checked";}
		$mandarin_level = $mandarin_level."/>Complete Beginner ( I know less than 50 words)
		</br><input type='radio' name='mandarin_level' value='Beginner'";
		if($ui->mandarin_level == "Beginner"){$mandarin_level = $mandarin_level . "checked";}
		$mandarin_level = $mandarin_level."/>Beginner ( i know between 50 and 200 words)
		</br><input type='radio' name='mandarin_level' value='Lower Intermediate'";
		if($ui->mandarin_level == "Lower Intermediate"){$mandarin_level = $mandarin_level . "checked";}
		$mandarin_level = $mandarin_level."/>Lower Intermediate ( I know between 200 and 500 words)
		</br><input type='radio' name='mandarin_level' value='Intermediate'";
		if($ui->mandarin_level == "Intermediate"){$mandarin_level = $mandarin_level . "checked";}
		$mandarin_level = $mandarin_level."/>Intermediate ( I know between 500 and 1,500 Words)
		</br><input type='radio' name='mandarin_level' value='Advanced'";
		if($ui->mandarin_level == "Advanced"){$mandarin_level = $mandarin_level . "checked";}
		$mandarin_level = $mandarin_level."/>Advanced ( i Know 1,500+)";
		
		$index = 1;
		$lesson_frequency = "<select name='lesson_frequency'>";
		while ($index <= 8)
		{
			$lesson_frequency = $lesson_frequency."<option value='$index'";
			if($index == $ui->lesson_frequency)
			{
				$lesson_frequency = $lesson_frequency."selected";
			}
			$lesson_frequency = $lesson_frequency."/>$index</option>";
			$index++;
		}
		$lesson_frequency = $lesson_frequency . "</select>";
		
		$preferred_location = "<input type='text' name='preferred_location' value='$ui->preferred_location'/>";
		$about_me           = "<input type='text' name='about_me' value='$ui->about_me'/>";
	}
		echo "
		<input type='hidden' name='user_id' value='$ui->id'/>
		<input type='hidden' name='usertype' value='$ui->usertype'/>
		<input type='hidden' name='previous_photo' value='$ui->photo'/>";
}
echo"<table align='center' border='0'>
		<tr><th colspan='2'>My Profile</th></tr>
		<tr><td align='left'>Email :</td><td>$email</td></tr>
		<tr><td align='left'>Password :</td><td>$password</td></tr>
		<tr><td align='left'>Last Name :</td><td>$last_name</td></tr>
		<tr><td align='left'>First Name :</td><td>$first_name</td></tr>
		<tr><td align='left'>Current Location :</td><td>$current_location</td></tr>
		<tr><td align='left'>Gender :</td><td>$gender</td></tr>
		<tr><td align='left'>Birthday :</td><td>$birthday</td></tr>
		<tr><td align='left'>Photo :</td><td>$photo</td></tr>
		<tr><td align='left'>Native Language :</td><td>$native_language</td></tr>
		<tr><td align='left'>Current Language Level :</td><td>$mandarin_level</td></tr>
		<tr><td align='left'>Lesson Frequency :</td><td>$lesson_frequency times a week</td></tr>
		<tr><td colspan='2' align='center'>===================================</td></tr>
		<tr><th colspan='2' align='center'>Schedule</th></tr>";
		$day = 0;
				while($day < 7){
					echo "<tr><td align='left'>";
					if($day == 0){echo "Monday : "; $name = "m_time";}
					else if($day == 1){echo "Tuesday : "; $name = "t_time";}
					else if($day == 2){echo "Wednesday : "; $name = "w_time";}
					else if($day == 3){echo "Thursday : "; $name = "th_time";}
					else if($day == 4){echo "Friday : "; $name = "f_time";}
					else if($day == 5){echo "Saturday : "; $name = "s_time";}
					else if($day == 6){echo "Sunday : "; $name = "sun_time";}
					$index = 0;
					echo "</td><td><select name='$name'";
						if($edit_profile == false)
						{
							echo "disabled";
						}
					echo"><option value=''>-----</option>";
					foreach($schedule_time as $st)
					{
						echo "<option value='$st->id'";
						if($st->id == $sched[$day])
						{
							echo "selected";
						}
						echo ">$st->time</option>";
					}
					echo "
					</select></br></td></tr>
					";
					$day++;
				}
		echo "
		<tr><td colspan='2' align='center'>===================================</td></tr>
		<tr><td align='left'>Preferred_location :</td><td>$preferred_location</td></tr>
		<tr><td align='left'>About me :</td><td>$about_me</td></tr>
		<tr><td colspan='2' align='center'>";
			if($edit_profile == false)
			{
				echo "<a href='" . base_url() . "index.php/home/my_profile?id=$id&edit_profile=TRUE&view_profile=student'>Edit Profile</a>";
			}
			else
			{
				echo "<input type='submit' value='submit'>";
			}
			echo"</td></tr>
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