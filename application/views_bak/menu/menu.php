<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/javascript/schedule_edit.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/modal.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui-1.11.2/jquery-ui.css">
<script src="<?php echo base_url() ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<table align="center">
<tr>
	<td colspan="3" align="center">
		<?php 
		if($usertype!="1")
		{
		?>
		<a href="<?php echo base_url();?>index.php/home/my_profile">
		<?php
		}
		?>
		<?php echo $name;?></a> <a href="<?php echo base_url();?>index.php/login/logout">Logout
		
		
		</a>
	</td>
</tr>
<tr>
	<td>
		<?php 
		if($usertype=="1")
		{
		?>
			<a href="<?php echo base_url();?>index.php/home">Appointments</a> |
			
			<a href="<?php echo base_url();?>index.php/register/register_teacher">Register Teacher</a> |
			
			<a href="<?php echo base_url();?>index.php/home/teacher_list">Teacher List</a> |
			
			<a href="<?php echo base_url();?>index.php/home/student_list">Student List</a>
		<?php
		}
		else if($usertype=="2")
		{
		?>
			<a href="<?php echo base_url();?>index.php/home/my_schedule"> My Schedule </a> |
		
			<a href="<?php echo base_url();?>index.php/home/appointments">Appointments</a> |
			
			<a href="<?php echo base_url();?>index.php/home/my_reviews">Reviews
			
			<?php 
				if(isset($review_count))
				{
					echo "($review_count)";
				}
				?>
				
			</a>
			<?php
		}
		else if($usertype=="3")
		{
		?>
			<a href="<?php echo base_url();?>index.php/home/my_schedule"> My Schedule </a> |
			
			<a href="<?php echo base_url();?>index.php/home/appointments">Appointments</a> |
			
			<a href="<?php echo base_url();?>index.php/home/teacher_list">Teachers</a> |
			
			<a href="<?php echo base_url();?>index.php/home/reviews">Reviews</a> |
	
		<?php
		}
		?>
	</td>
</tr>
</table>