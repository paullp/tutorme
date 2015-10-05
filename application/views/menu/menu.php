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

<link href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/widget.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/toastr.css" rel="stylesheet">


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.css">

<link href="<?php echo base_url(); ?>assets/src/rateit.css" rel="stylesheet" type="text/css">





<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>

</head>
<body>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo-white.png"></a>
	</div>
	<!-- /.navbar-header -->
	<ul class="nav navbar-top-links navbar-right">
		<li>Welcome, <?php echo $name;?>!</li>
		<li><a href="#" style="margin-right: -18px; background-color: lightseagreen;" class="notifications"><span class="glyphicon glyphicon-bullhorn" style="margin-right:5px;"></span></a></li>
		<li><a href="<?php echo base_url();?>login/logout">Logout</a></li>

	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<?php 
				if($usertype=="1")
				{
				?>
					<li>
						<a href="<?php echo base_url();?>home/appointments">
							<img src="<?php echo base_url();?>assets/images/Icn-calendar.png"/> Appointments
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>register/register_teacher/">
							<img src="<?php echo base_url();?>assets/images/Icn-admin.png"/> Register Teacher
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/teacher_list">
							<img src="<?php echo base_url();?>assets/images/Icn-board.png"/> Teacher List
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/student_list">
							<img src="<?php echo base_url();?>assets/images/Icn-book.png"/> Student List
						</a>
					</li>
				<?php
				}
				else if($usertype=="2")
				{
				?>
					<li>
						<a href="<?php echo base_url();?>home/my_schedule">
							<img src="<?php echo base_url();?>assets/images/Icn-schedule.png"/> My Schedule
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/appointments">
							<img src="<?php echo base_url();?>assets/images/Icn-calendar.png"/> Appointments
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/my_reviews">
							<img src="<?php echo base_url();?>assets/images/Icn-reviews.png"/> Reviews
						
					<?php 
						if(isset($review_count))
						{
							echo "($review_count)";
						}
						?>
						</a>
					</li>
					<?php
				}
				else if($usertype=="3")
				{
				?>
					<li>
						<a href="<?php echo base_url();?>home/my_schedule"><img src="<?php echo base_url();?>assets/images/Icn-schedule.png"/> My Schedule</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/appointments"><img src="<?php echo base_url();?>assets/images/Icn-calendar.png"/> Appointments</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/teacher_list"><img src="<?php echo base_url();?>assets/images/Icn-admin.png"/> Teachers</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>home/reviews"><img src="<?php echo base_url();?>assets/images/Icn-reviews.png"/> Reviews</a>
					</li>
			
				<?php
				}
				?>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
	</nav>
</div>

<div style="display:none;">

	<div class="notifications_container">
		<div class="notif_row"  style="max-width:100px">
			<table>
				<tr>
					<td width="10%">
						<img src="http://40.media.tumblr.com/c2855fde171362f27e05dd8b5f2b6a0d/tumblr_nv326chULG1st5lhmo1_1280.jpg" style="border-radius:100px;width:40px;height:40px;"/>
					</td>
					<td><b>asdasdas das dasdasd asdasdasd asdas das dasda sda sdasd asdasdasdasd</b></td>
				</tr>
				<tr>
					<td>
						<img src="http://40.media.tumblr.com/c2855fde171362f27e05dd8b5f2b6a0d/tumblr_nv326chULG1st5lhmo1_1280.jpg" style="border-radius:100px;width:40px;height:40px;"/>
					</td>
				</tr>
				<tr>
					<td>
						<img src="http://40.media.tumblr.com/c2855fde171362f27e05dd8b5f2b6a0d/tumblr_nv326chULG1st5lhmo1_1280.jpg" style="border-radius:100px;width:40px;height:40px;"/>
					</td>
				</tr>
				<tr>
					<td>
						<img src="http://40.media.tumblr.com/c2855fde171362f27e05dd8b5f2b6a0d/tumblr_nv326chULG1st5lhmo1_1280.jpg" style="border-radius:100px;width:40px;height:40px;"/>
					</td>
				</tr>
				<tr>
					<td>
						<img src="http://40.media.tumblr.com/c2855fde171362f27e05dd8b5f2b6a0d/tumblr_nv326chULG1st5lhmo1_1280.jpg" style="border-radius:100px;width:40px;height:40px;"/>
					</td>
				</tr>
				<tr>
					<td>
						<img src="http://40.media.tumblr.com/c2855fde171362f27e05dd8b5f2b6a0d/tumblr_nv326chULG1st5lhmo1_1280.jpg" style="border-radius:100px;width:40px;height:40px;"/>
					</td>
				</tr>
			</table>
		</div>
	</div>

</div>

<script>

$(document).ready(function(){
        $('.notifications').popover({
            placement: 'bottom',
            container: 'body',
            html: true,
            content: function () {

                return $('.notifications_container').html();
            	
            }
        });
});
</script>