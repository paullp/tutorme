<?php
$monday = '';
$tuesday = '';
$wednesday = '';
$thursday = '';
$friday = '';
$saturday = '';
$sunday = '';
foreach($schedule_time as $st){
	$monday    .=form_checkbox('monday[]', $st->id, set_checkbox('monday', $st->id)).$st->time;
	$tuesday   .=form_checkbox('tuesday[]', $st->id, set_checkbox('tuesday', $st->id)).$st->time; 
	$wednesday .=form_checkbox('wednesday[]', $st->id, set_checkbox('wednesday', $st->id)).$st->time;
	$thursday  .=form_checkbox('thursday[]', $st->id, set_checkbox('thursday', $st->id)).$st->time;   
	$friday    .=form_checkbox('friday[]', $st->id, set_checkbox('friday', $st->id)).$st->time; 
	$saturday  .=form_checkbox('saturday[]', $st->id, set_checkbox('saturday', $st->id)).$st->time;
	$sunday    .=form_checkbox('sunday[]', $st->id, set_checkbox('sunday', $st->id)).$st->time;  
}
echo form_open_multipart("register/register_teacher_by_url");
$list = array(
"<i>(*) Required Fields</i>"                                     , 'Teacher Registration<br>'.$this->session->flashdata('msg'),
form_error('email').'*Email : '                                  , "<input type='text' name='email' value='". set_value('email')."'/>",
form_error('password').'*Password : '                            , "<input type='password' name='password' value='". set_value('password')."'/><br>
																	<i>(minimum of 8 characters)</i>",
form_error('confirm_password').'*Confirm password : '            , "<input type='password' name='confirm_password' value='".set_value('confirm_password')."'/>",
form_error('lastname').'*Last Name : '                           , "<input type='text' name='lastname' value='". set_value('lastname')."'/>",
form_error('firstname').'*First Name : '                         , "<input type='text' name='firstname' value='". set_value('firstname')."'/>",
form_error('current_location').'*Current Location : '            , "<input type='text' name='current_location' value='". set_value('current_location')."'/>",
form_error('gender').'*Gender : '                                , "Male<input type='radio' name='gender' value='male' ". set_radio('gender', 'male')." />
													                Female<input type='radio' name='gender' value='female' ". set_radio('gender', 'female')."/>",
form_error('birthday').'*Birthday : '                            , "<input type='input' name='birthday' id='datepicker' value='". set_value('birthday')."'>",
form_error('photo').'*Photo : '                                  , "<input type='file' name='photo' id='file'>",
form_error('occupation').'*Occupation : '                        , "<input type='radio' name='occupation' value='Student' ". set_radio('occupation', 'Student')."/>Student
																	</br><input type='radio' name='occupation' value='Full time Job' ". set_radio('occupation', 'Full time Job')."/>Full time Job
																	</br><input type='radio' name='occupation' value='Part Time Job' ". set_radio('occupation', 'Part time Job')."/>Part Time Job
																	</br><input type='radio' name='occupation' value='Unemployed' ". set_radio('occupation', 'Unemployed')."/>Unemployed",
form_error('teaching_experience').'*Teaching Experience : '      , "<textarea name='teaching_experience' maxlength='200' rows='5' cols='50' style='font-family:Arial;'>".set_value('teaching_experience')."</textarea>",
form_error('resume').'*Resume/CV : '                             , "<input type='file' name='resume' id='file'>",
'Schedule Per Week : '                                           , "",
'Monday : '                                                      , $monday,
'Tuesday : '                                                     , $tuesday,
'Wednesday : '                                                   , $wednesday,
'Thursday : '                                                    , $thursday,
'Friday : '                                                      , $friday,
'Saturday : '                                                    , $saturday,
'Sunday : '                                                      , $sunday,
form_error('preferred_location').'*Preferred Lesson Location : ' , "<input type='text' name='preferred_location' value='".set_value('preferred_location')."' maxlength='100'/>",
'About me : '                                                    , "<textarea name='about_me' maxlength='200' rows='5' cols='50' style='font-family:Arial;'>".set_value('about_me')."</textarea>",
''                                                               , "<input type='submit' name='submit' value='submit'/>"
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