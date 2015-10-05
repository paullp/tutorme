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
<link href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="<?php echo base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url();?>assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.css">

</head>
<body>
<div class="loginWrapper">
<div class="bgWrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    
                    <h3 class="panel-title"><img src="<?php echo base_url();?>assets/images/TutorMe2logo.png"/></h3>
                    
                    <div class="panel-body center">
                    	<?php
							echo form_open('login/retrieve_password');
						?>
                            <fieldset>
                                <div class="form-group">
                                     <div class="col-xs-12">
                                           <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                <input type="text" class="form-control input-lg" placeholder="Email" autocomplete="off" value="<?php echo set_value('email'); ?>">
                                           </div>
                                      </div>
								</div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            <input type="input" name="birthday" id="datepicker" placeholder="Birthday" class="form-control input-lg" value="<?php echo set_value('email'); ?>">
                                        </div>
                                    </div>
								</div>
                             </fieldset>
                               <br>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Submit" class="btn btn-default">
                            </fieldset> 
                        </form>
                    </div>
                </div>
                <h4 class="center white"> 
                	<a href="<?php echo base_url(); ?>index.php/register/register_student" class="allcaps bold yellow"> Sign up</a> | 
                	<a href="<?php echo base_url(). 'index.php/login'; ?>" class="bold white">  Sign in</a> 
                </h4>
                
            </div>
        </div>
    </div>
</div>
</div>
   <!-- jQuery -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>

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

</body>
</html>
