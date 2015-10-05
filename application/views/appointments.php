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

	.teacher_selection:hover{
		background-color:#75FF47;
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

</style>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<h2 class="page-header">Appointments</h2> 
				<b>Status</b>
				<select class="filter_appointments form-control" id='status'>
					<option value=""> - Select Filter - </option>
					<option value="PENDING">PENDING</option>
					<option value="APPROVED">APPROVED</option>
					<option value="FINISHED">FINISHED</option>
					<option value="REJECTED">REJECTED</option>
					<option value="CANCELLED">CANCELLED</option>
				</select>
				<b>Teacher</b>
				<select class="filter_appointments form-control" id='teacher'>
					<option value=""> - Select Teacher - </option>
					<?php foreach($teachers as $key=>$value):?>
						<option value="<?php echo $value['id'];?>"><?php echo ucfirst($value['first_name'])." ".ucfirst($value['last_name']);?></option>
					<?php endforeach;?>
				</select>
			<div class="col-md-12">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
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
                        <button class="btn btn-default cancel-appointment appointment_buttons" id="CANCELLED" style="display:none;">
                            Cancel Appointment
                        </button>
                       <button class="btn btn-default approve-appointment appointment_buttons" id="APPROVED" style="display:none;">
                            Approve Appointment
                        </button>
                        <button class="btn btn-default finish-appointment appointment_buttons" id="FINISHED" style="display:none;">
                            Finish Appointment
                        </button>
                        <button class="btn btn-default reject-appointment appointment_buttons" id="REJECTED" style="display:none;">
                            Reject Appointment
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

</script>

<script src="<?php echo base_url();?>assets/js/schedule_page.js"></script>
</body>
</html>