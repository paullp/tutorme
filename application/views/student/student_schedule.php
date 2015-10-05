<style>
	.create_appointment{
		text-align:center;
	}

	.fc-left, .fc-right{
		display:none;
	}

	.fc-content{
		border-radius:100px;
		cursor:pointer;
	}

	a.fc-day-grid-event{
		border-radius:100px;
	}

	.fc-title{
		cursor:pointer;
	}

	#calendar{
		    /*max-height:500px;*/
		    margin: 40px auto;
		    padding: 0 10px;
	}

	.popover{
	    width: 100%;
	    max-width: 385px!important;
	    height: 250px;
	    padding: 10px !important;
	}

	.popover-content{
		height: auto;
	    max-height: 200px;
	    overflow: auto;
	}

	.teacher_selection{
		width:100%;
		height:50px;
		margin-bottom:3px;
		font-color:white;
		cursor:pointer;
	}

	.teacher_selection p{
	    float: left;
	    margin-left: 10px;
	    margin-top: 13px;
	}

	.teacher_selection{
		background-color:blue;
	}

	.clip-circle {
		background-size:720px 480px;
		background-position:-160px 0px;
		height:30px;
		width:30px;
		border-radius:50%;
		overflow:hidden;
		margin-left:10px;
		margin-top:10px;
		float:left;
	}

	.parts{

		margin-bottom:20px;

	}

	.news{
		height:25px;
		background-color:#fefefe;
	}

</style>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<h2 class="page-header">Schedules</h2> 
			<div class="col-md-12">	
				<div class="col-md-8">
					<div style="margin-top:-10px;" id='calendar'></div>
				</div>
				<div class="col-md-4">
					<div class="parts">
						<b>Status</b>
						<select class="filter_appointments form-control" id='status'>
							<option value=""> - Select Filter - </option>
							<option value="PENDING">PENDING</option>
							<option value="APPROVED">APPROVED</option>
							<option value="FINISHED">FINISHED</option>
							<option value="REJECTED">REJECTED</option>
							<option value="CANCELLED">CANCELLED</option>
						</select>
					</div>
					<div class="parts">
						<b>Teacher</b>
						<select class="filter_appointments form-control" id='teacher'>
							<option value=""> - Select Teacher - </option>
							<?php foreach($teachers as $key=>$value):?>
								<option value="<?php echo $value['id'];?>"><?php echo ucfirst($value['first_name'])." ".ucfirst($value['last_name']);?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="parts">
					<b>Newsfeed</b>
						<div class="newsfeed" style="width:100%;max-height:300px;overflow-y:auto;">
							<div class="news">
								
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<div id="ohsnap"></div>
	</div>
</div>


<div class="modal fade create_appointment" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger" style="display:none;"></div>
      	<table class="create_appointment" border="0" style="width:100%;">
      		<tr>
				<td style="width:30%;"><b>Teacher<b></td>
				<td class="pop_Teacher" align="center" style="cursor:pointer;">
					Click To Select Teacher
				</td>
      		</tr>
      		<tr>
      			<td><b>Time<b></td>
      			<td class="appointment_time" ></td>
      		</tr>
      		<tr>
      			<td><b>Place</b></td>
      			<td><input type="text" class="form-control" name="place"/></td>
      		</tr>
      		<tr>
      			<td><b>Message</b></td>
      			<td><textarea class="form-control" name="message"></textarea></td>
      		</tr>
      	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default cancel_request" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary send_request">Send Request</button>
      </div>
    </div>
  </div>
</div>

<div class="popper-content hide">
<?php foreach($teachers as $key=>$value):?>
	<div class="teacher_selection" data-id="<?php echo $value['id'];?>">
		<img src="<?php echo base_url().$value['photo'];?>" class="clip-circle"/>
		<p><?php echo ucFirst($value['first_name'])." ".ucFirst($value['last_name']);?></p>
	</div>
	<div class="clearfix"></div>
<?php endforeach;?>
</div>

<!-- Modal -->
<div class="modal fade appointment_info" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title bold" id="myModalLabel">
                    Appointment
                </h3>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
			<table align="center" border="0"><tbody>
                <tr>
                	<td align="right">Teacher : </td>
                    <td id="appointment-teacher"></td>
               	</tr>
                <tr>
                	<td align="right">Student : </td>
                    <td id="appointment-student"></td>
               	</tr>
				<tr>
					<td align="right">Date : </td>
					<td id="appointment-date">05-10-2015</td>
				</tr>
				<tr>
					<td align="right">Time : </td>
					<td id="appointment-time">11am-1pm</td>
				</tr>
				<tr>
					<td align="right">Place : </td>
					<td id="appointment-place">SB megamall</td>
				</tr>
				<tr>
					<td colspan="2">
						<button class="btn btn-default cancel-appointment appointment_buttons" id="CANCELLED" style='display:none;'>
							Cancel Appointment
						</button>
					</td>
				</tr>
			</table>
        	</div>
    </div>
</div>



<!-- /#wrapper -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>


<!-- full calendar -->
<link href="<?php echo base_url();?>assets/fullcalendar/fullcalendar.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/fullcalendar/fullcalendar.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>
<!-- full calendar -->
<script>

	var base_url 		= "<?php echo base_url();?>";
	
	var appointments 	= <?php echo json_encode($appointments);?>;
	
	var date_today 		= moment().format("YYYY-MM-DD");
	
	var user_info 		= <?php echo json_encode($user_info);?>;

	var schedule_time 	= <?php echo json_encode($schedule_time);?>;
	
	var chosen_appointment = "";

	var date_picked 	= "";

	var schedule_for_the_day = "";

	var chosenEvent = "";
	
</script>

<script src="<?php echo base_url();?>assets/js/schedule_page.js"></script>
</body>
</html>