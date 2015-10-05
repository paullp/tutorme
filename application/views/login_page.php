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
                    	<?php echo form_open('login/check_database'); ?>
                            <fieldset>
                                <div class="form-group">
                                     <div class="col-xs-12">
                                           <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                <input type="text" class="form-control input-lg" placeholder="Email" autocomplete="off" name="email" value="<?php if(isset($email)){echo $email;}else{echo set_value('email');}?>">
                                           </div>
                                      </div>
								</div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                            <input type="password" class="form-control input-lg" placeholder="Password" autocomplete="off" name="password" value="<?php if(isset($password)){echo $password;}else{echo set_value('password');} ?>"">
                                        </div>
                                    </div>
								</div>
                             </fieldset>
                                <div class="checkbox centerAlign">
                                	<?php echo form_error('password') ?>
                                </div>
                                <input type="submit" name="mysubmit" value="Login" class="btn btn-default center">
                            </fieldset> 
                        </form>
                    </div>
                </div>
                <h4 class="center white">
                	<a href="<?php echo base_url(); ?>index.php/register/register_student" class="allcaps bold yellow"> Sign up</a> | 
                	<a href="<?php echo base_url(); ?>index.php/login/retrieve_password" class="bold white">  Forgotten Password?</a> 
                </h4>
                
            </div>
        </div>
    </div>
</div>
</div>

<script>
	<?php if($this->session->flashdata('msg')){ ?>
	alert('<?php echo $this->session->flashdata('msg'); ?>');
	<?php } ?>
</script>

   <!-- jQuery -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>
</body>
</html>
