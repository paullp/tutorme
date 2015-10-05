<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php
$mandarin_level_selection = array(
					''                  => '-',
					'Complete Beginner'  => 'Complete Beginner ( I know less than 50 words)',
					'Beginner'           => 'Beginner ( i know between 50 and 200 words)',
					'Lower Intermediate' => 'Lower Intermediate ( I know between 200 and 500 words)',
					'Intermediate'       => 'Intermediate ( I know between 500 and 1,500 Words)',
					'Advanced'           => 'Advanced ( i Know 1,500+)'
                );
$lesson_frequency_selection = array(
					'' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7'
				);	
$sched_time = array(
		NULL => '-'
);
foreach($schedule_time as $st)
{
	$sched_time[$st->id] = $st->time;
};
?>

<?php
echo form_open_multipart("register/register_student");
$list = array(
''                                                                      , "<a href='".base_url()."index.php/login'>Alreay have an account? Click here!</A>",
"<i>(*) Required Fields</i>"                                            , 'Student Register<br>'.$this->session->flashdata('msg'),
form_error('email').'*Email</span> : '                                  , "<input type='text' name='email' value='". set_value('email')."'/>",
form_error('password').'*Password</span> : '                            , "<input type='password' name='password' value='". set_value('password')."'/><br>
																		   <i>(minimum of 8 characters)</i>",
form_error('confirm_password').'*Confirm password</span> : '            , "<input type='password' name='confirm_password' value='".set_value('confirm_password')."'/>",
form_error('lastname').'*Last Name</span> : '                           , "<input type='text' name='lastname' value='". set_value('lastname')."'/>",
form_error('firstname').'*First Name</span> : '                         , "<input type='text' name='firstname' value='". set_value('firstname')."'/>",
form_error('current_location').'*Current Location</span> : '            , "<input type='text' name='current_location' value='". set_value('current_location')."'/>",
form_error('gender').'*Gender</span> : '                                , "Male<input type='radio' name='gender' value='male' ". set_radio('gender', 'male')." />
													                       Female<input type='radio' name='gender' value='female' ". set_radio('gender', 'female')."/>",
form_error('birthday').'*Birthday</span> : '                            , "<input type='input' name='birthday' id='datepicker' value='". set_value('birthday')."'>",
form_error('photo').'*Photo</span> : '                                  , "<input type='file' name='photo' id='file'>",
form_error('native_language').'*Native Language</span> : '              , "<input type='input' name='native_language' value='".set_value('native_language')."'/>",
form_error('mandarin_level').'*Current Mandarin Level</span> : '        , form_dropdown('mandarin_level', $mandarin_level_selection),
form_error('lesson_frequency').'*Lesson Frequency</span> : '            , form_dropdown('lesson_frequency', $lesson_frequency_selection)." Times per week",
'Schedule Per Week : '                                                  , "",
'Monday : '                                                             , form_dropdown('monday', $sched_time),
'Tuesday : '                                                            , form_dropdown('tuesday', $sched_time),
'Wednesday : '                                                          , form_dropdown('wednesday', $sched_time),
'Thursday : '                                                           , form_dropdown('thursday', $sched_time),
'Friday : '                                                             , form_dropdown('friday', $sched_time),
'Saturday : '                                                           , form_dropdown('saturday', $sched_time),
'Sunday : '                                                             , form_dropdown('sunday', $sched_time),
form_error('preferred_location').'*Preferred Lesson Location</span> : ' , "<input type='text' name='preferred_location' value='".set_value('preferred_location')."' maxlength='100'/>",
'About me : '                                                           , "<textarea name='about_me' maxlength='200' rows='5' cols='50' style='font-family:Arial;'>".set_value('about_me')."</textarea>",
'Comment to the teacher : '                                             , "<textarea name='comment_teacher' maxlength='200' rows='5' cols='50' style='font-family:Arial;'>".set_value('comment_teacher')."</textarea>",
''                                                                      , "<input type='submit' name='submit' value='submit'/>"
);
$new_list = $this->table->make_columns($list, 2);
echo $this->table->generate($new_list);
echo "</form>";
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