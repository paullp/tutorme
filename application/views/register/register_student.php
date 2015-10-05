<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>TutorMe</title>
<!--Google Font-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.css">

</head>
<body>
<div class="loginWrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default" style="margin:10px">
                        <h3 class="panel-title"><img src="<?php echo base_url(); ?>assets/images/TutorMe2logo.png"></h3>
                        <!-- /.panel-heading -->

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

                        <div class="panel-body">
                        <form id="register_student" action="" method="post" enctype="multipart/form-data">
                          	<table border="0" align="center" width="100%">
								<tbody>
								<tr>
									<td colspan="2" class="center"><a href="<?php echo base_url(). 'index.php/login'; ?>" class="allcaps bold yellow center">Already have an account? Click here!</a></td>
								</tr>
								<tr>
									<td colspan="2">
										<div class="alert alert-danger" id="error" style="display:none;"></div>
									</td>
								</tr>
								<tr>
									<td><i>(*) Required Fields</i></td>
								</tr>
								<tr>
									<td>*Email</span> : </td>
									<td><input type="text" name="email" class="form-control"></td>
								</tr>
								<tr>
									<td>*Password</span> : </td>
									<td>
										<input type="password" name="password" class="form-control"><br>
										<i>(minimum of 8 characters)</i>
									</td>
								</tr>
								<tr>
									<td>*Confirm password</span> : </td>
									<td><input type="password" name="confirm_password" class="form-control"></td>
								</tr>
								<tr>
									<td>*Last Name</span> : </td>
									<td><input type="text" name="last_name" class="form-control"></td>
								</tr>
								<tr>
									<td>*First Name</span> : </td>
									<td><input type="text" name="first_name" class="form-control"></td>
								</tr>
								<tr>
									<td>*Current Location</span> : </td>
									<td><input type="text" name="current_location" class="form-control"></td>
								</tr>
								<tr>
									<td>*Gender</span> : </td>
									<td>
										<select class="form-control input-md" name="gender">
			                                <option value="">Choose Gender</option>
			                                <option value="Male">Male</option>
			                                <option value="Female">Female</option>
                            			</select> 
									</td>
								</tr>
								<tr>
									<td>*Birthday</span> : </td>
									<td><input type="input" name="birthday" id="datepicker" class="form-control" ></td>
								</tr>
								<tr>
									<td>Photo</span> : </td>
									<td><input type="file" name="photo" id="file" class="form-control"></td>
								</tr>
								<tr>
									<td>*Native Language</span> : </td>
									<td><input type="input" name="native_language" class="form-control"></td>
								</tr>
								<tr>
									<td>*Current Mandarin Level</span> : </td>
									<td><?php echo form_dropdown('mandarin_level', $mandarin_level_selection, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>*Lesson Frequency</span> : </td>
									<td>
										<?php echo form_dropdown('lesson_frequency', $lesson_frequency_selection, '', 'class="form-control"'); ?> 
										Times per week
									</td>
								</tr>
								<tr>
									<td>Schedule Per Week : </td><td></td>
								</tr>
								<tr>
									<td>Monday : </td>
									<td><?php echo form_dropdown('monday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>Tuesday : </td>
									<td><?php echo form_dropdown('tuesday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>Wednesday : </td>
									<td><?php echo form_dropdown('wednesday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>Thursday : </td>
									<td><?php echo form_dropdown('thursday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>Friday : </td>
									<td><?php echo form_dropdown('friday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>Saturday : </td>
									<td><?php echo form_dropdown('saturday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>
								<tr>
									<td>Sunday : </td>
									<td><?php echo form_dropdown('sunday', $sched_time, '', 'class="form-control"'); ?></td>
								</tr>

								<tr>
									<td>*Preferred Lesson Location</span> : </td>
									<td><input type="text" name="preferred_location"  maxlength="100" class="form-control"></td>
								</tr>
								<tr>
									<td>About me : </td>
									<td><textarea name="about_me" maxlength="200" rows="5" cols="50" style="font-family:Arial;" class="form-control"></textarea></td>
								</tr>
								<tr>
									<td>Comment to the teacher : </td>
									<td><textarea name="comment_teacher" maxlength="200" rows="5" cols="50" style="font-family:Arial;" class="form-control"></textarea></td>
								</tr>

								</tbody>
							</table>
						
						<div class="col-md-12 column" id='progress_bar' style='display:none;'>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" style="width: 100%;">
                                    Please Wait
                                </div>
                            </div>
                        </div>
						<button class="btn btn-default" id="submit_student">Submit</button>
						</form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>  
                
            
       </div>
              
                
            </div>
        </div>
    </div>
</div>
   <!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<script src="<?php echo base_url(); ?>assets/js/register_student.js"></script>

<script>
var url 	= "<?php echo base_url();?>index.php/";
var photo 	= "";
	$(function() {
		var default_date = $("#datepicker").val();	
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		  changeYear: true, yearRange: '1900:+0'
		});
		$( "#datepicker" ).datepicker( "setDate",default_date);
	});
</script>

</body>
</html>
