<?php
$session_data = $this->session->userdata('logged_in');
$cell = array('data' => 'Teacher List', 'colspan' => 2, 'align' => 'center');
$this->table->set_heading($cell);
$this->table->add_row($links);
foreach($teacher_list as $tl)
{
	$buttons  = "";
	$schedule = "";
	if($session_data['usertype'] == 1)
	{
		$buttons .=
		"<button style=vertical-align: bottom;'>
			<a style='color:black;text-decoration:none;' href='".base_url()."index.php/home/my_profile?id=$tl->id&edit_profile=true&view_profile=teacher'>
				Edit Profile
			</a>
		</button>
		<button style='vertical-align: bottom;'>
			<a style='color:black;text-decoration:none;' href='".base_url()."index.php/home/delete_teacher?id=$tl->id'>
				Delete Teacher
			</a>
		</button>";
	}
	if($tl->review_count != 0)
	{
	$buttons .= 
		"<button style='vertical-align: bottom;'>
		<a style='color:black;text-decoration:none;' href='".base_url()."index.php/home/my_reviews?id=$tl->id?>'>
			$tl->review_count Reviews(view all)
		</a>
		</button>";
	}
	else
	{
	$buttons .= " <i>No review/s yet</i>"; 
	}	

	if ($session_data['usertype'] == 3)
	{
		$schedule.= "Schedule:<BR>";
		if($tl->monday != NULL){$day[0] = explode(',',$tl->monday);}else{$day[0] = 6;}
		if($tl->tuesday != NULL){$day[1] = explode(',',$tl->tuesday);}else{$day[1] = 6;}
		if($tl->wednesday != NULL){$day[2] = explode(',',$tl->wednesday);}else{$day[2] = 6;}
		if($tl->thursday != NULL){$day[3] = explode(',',$tl->thursday);}else{$day[3] = 6;}
		if($tl->friday != NULL){$day[4] = explode(',',$tl->friday);}else{$day[4] = 6;}
		if($tl->saturday != NULL){$day[5] = explode(',',$tl->saturday);}else{$day[5] = 6;}
		if($tl->sunday != NULL){$day[6] = explode(',',$tl->sunday);}else{$day[6] = 6;}
		$index = 0;
		while(isset($day[$index]))
		{
			$index2 = 0;
			if($day[$index] != 6)
			{
				if($index == 0){$schedule.= "Monday:";}
				else if($index == 1){$schedule.= "Tuesday:";}
				else if($index == 2){$schedule.= "Wednesday:";}
				else if($index == 3){$schedule.= "Thursday:";}
				else if($index == 4){$schedule.= "Friday:";}
				else if($index == 5){$schedule.= "Saturday:";}
				else{$schedule.= "Sunday:";}
				while(isset($day[$index][$index2]))
				{
					foreach($schedule_time as $st)
					{
						if($st->id == $day[$index][$index2])
						{
							$schedule.= " ".$st->time;
						}
					}
					$index2++;
				}
				$schedule.= "<BR>";
				}
			$index++;
		}
	}
	
	$this->table->add_row(
	"<img src='". base_url() . "$tl->photo?>' style='width:144px;height:144px'>", 
	"Name :<a href='". base_url() . "index.php/home/my_profile?id=$tl->id&view_profile=teacher'>$tl->last_name,$tl->first_name</a> <br>
	Age : ".date_diff(date_create($tl->birthday), date_create('today'))->y."<br>
	Occupation : $tl->occupation <br>
	Teaching Experience : $tl->teaching_exp <br>
	Current Location : $tl->current_location <br>$schedule$buttons"
	);
}
echo $this->table->generate();
?>
<script>
	

	$(function() {
		var default_date = $("#datepicker").val();	
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		  changeYear: true, yearRange: '1900:+0'
		});
		$( "#datepicker" ).datepicker( "setDate",default_date);

	});
</script>