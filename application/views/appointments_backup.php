	<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<h2 class="page-header">Appointments</h2>
				<div class="col-lg-12">
					<div class="row">
						<div class="form-group">
							<?php
								if($usertype != 1)
								{
							?>
	                            <ul class="nav nav-tabs">
	                                <li id='status' name='-'><a href='#'>All</a></li>
	                                <li id='status' name='PENDING'><a href='#'>Pending</a></li>
	                                <li id='status' name='APPROVED'><a href='#'>Approved</a></li>
	                                <li id='status' name='FINISHED'><a href='#'>Finished</a></li>
	                                <li id='status' name='CANCELLED'><a href='#'>Cancelled</a></li>
	                            </ul>
							<?php
								}else{
							?>

							<div class="col-md-4">	
								
								<?php
									echo "Teachers: <select name='teacher' class='form-control'>
									<option value='-'>Select Teacher</option>";
									foreach($dropdown_teacher as $dt){
										echo "<option value='$dt->id'>$dt->last_name, $dt->first_name</option>";
									}
									echo "</select>";
								?>
							</div>
							<div class="col-md-4">
								<?php 
									echo "Students: <select name='student' class='form-control'>
									<option value='-'>Select Student</option>";
									foreach($dropdown_student as $st){
											echo "<option value='$st->id'>$st->last_name, $st->first_name</option>";
									}
									echo " </select>";
								?>
							</div>
							<div class="col-md-4">
								<?php
									echo "Status: <select name='status' class='form-control'>
													<option value='-'>Select Status</option>
													<option value='PENDING'>PENDING</option>
													<option value='APPROVED'>APPROVED</option>
													<option value='FINISHED'>FINISHED</option>
													<option value='CANCELLED'>CANCELLED</option>
									</select>";
								?>
							</div>
						</div>
					</div>
					<div class="clearfix">

					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							<input type="button" id="toggle_view" value="Full Calendar View" class="btn btn-default left">
						</div>
						<div class="col-sm-6">
							<button class="btn btn-default right" id="filter">Apply Filter</button>
						</div>
					</div>
					<?php } ?>
					<div class="clearfix">
					</div>

					<br>

					<div class="table-responsive">
							<div class="col-md-12 column" id='progress_bar' style='display:none;'>
								<div class="progress progress-striped active">
									<div class="progress-bar progress-success" style="width: 100%;">
										Please Wait
									</div>
								</div>
							</div>
						<table class="table table-striped" id="main_table" border='0'>

						</table>

					</div>
					    <div class="row clear-fix">
					        <div class="col-md-15 pull-right">
					            <div id='paginate'>
					            <button  id="previous" class="btn btn-sm btn-primary">Previous</button>
					            <lable>Page <lable id="page_number"></lable> of <lable id="total_page"></lable></lable>
					            <button  id="next" class="btn btn-sm btn-primary">Next</button>
					            </div>
					        </div>
					        
					    </div>

				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<table id='table_template' style='display:none;'>
		<thead>
		<tr>
			<th>Appointment Date</th>
			<th>Time</th>
			<th>Teacher</th>
			<th>Student</th>
			<th>Status</th>
			<th>Messages</th>
		</thead>
		<tbody>
		<tr href="#modal-container" data-toggle="modal">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</tbody>
</table>

<div class="modal fade" id="modal-container" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">
					Appointment
				</h4>
			</div>
			<div class="modal-body">
				<table align="center">
					<tr><td><strong>Teacher : </strong></td><td id="teacher_name"></td></tr>
					<tr><td><strong>Student : </strong></td><td id="student_name"></td></tr>
					<tr><td><strong>Date    : </strong></td><td id="appointment_date"></td></tr>
					<tr><td><strong>Time    : </strong></td><td id="appointment_time"></td></tr>
					<tr class="buttons">
						<td colspan="2">
							<button class="btn btn-primary status" id="APPROVED"  data-id="" style="display:none;">Approved Appoinment </button>
							<button class="btn btn-primary status" id="REJECTED"  data-id="" style="display:none;">Rejected Appointment</button>
							<button class="btn btn-primary status" id="FINISHED"  data-id="" style="display:none;">Finished Appointment</button>
							<button class="btn btn-primary status" id="CANCELLED" data-id="" style="display:none;">Cancel Appointment  </button>
						</td>
					</tr>
				</table>
				<hr>
				<p align="center"><strong>Messages</strong></p>
				<div id="scrollable" style="height:200px;width:550px;overflow-y:scroll;">
					<table id="modal_table">
					</table>
				</div>
				</br>
				<p><strong>Reply :</strong></p> <input class="form-control" type="text" value="" name="message">
			</div>
			<div class="modal-footer">
				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				 <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
		
	</div>
	
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pagination.js"></script>

<script>
var BASE_URL = "<?php echo base_url();?>";
var USERTYPE = "<?php echo $usertype;?>";
var TEACHER = "-";
var STUDENT = "-";
var STATUS = "-";
$(function(){

		$("li#status:eq(0)").addClass("active");
		getReport(page_number,TEACHER,STUDENT,STATUS);

		$("#next").on("click", function(){
			$(".tb").html("");
			page_number = (page_number+1);
			getReport(page_number,TEACHER,STUDENT,STATUS);
		});

		$("#previous").on("click", function(){
			$(".tb").html("");
			page_number = (page_number-1);
			getReport(page_number,TEACHER,STUDENT,STATUS);
		});

		$("li#status").click(function(){
			$("li#status").removeClass("active");
			page_number = 0;
			$(this).addClass("active");
			STATUS = $(this).attr("name");
			
			getReport(page_number,TEACHER,STUDENT,STATUS);
		});

		$("button#filter").click(function(){
			page_number = 0;
			TEACHER = $("select[name='teacher']").val();
			STUDENT = $("select[name='student']").val();
			STATUS = $("select[name='status']").val();
			getReport(page_number, TEACHER, STUDENT, STATUS);
		});


}).on('click','tr#appointment_info', function(){
	$("#modal_table").html('');
	$("div.modal-body").find("#teacher_name").text($(this).find("td:eq(2)").html());
	$("div.modal-body").find("#student_name").text($(this).find("td:eq(3)").html());
	$("div.modal-body").find("#appointment_date").text($(this).find("td:eq(0)").html());
	$("div.modal-body").find("#appointment_time").text($(this).find("td:eq(1)").html());
	$.ajax({
		url 		: BASE_URL+"index.php/home/appointment_messages_by_id",
		data		: "appointment_id="+$(this).attr("appointment-id"),
		type		: "POST",
		dataType	: "json",
		success 	: function(sData){
			var previous = "";

			if(USERTYPE == 1 || USERTYPE == 2){

				$.each(sData.info, function(key,value){
					$(".buttons").find(".btn:eq(0)").css("display","none");
					$(".buttons").find(".btn:eq(1)").css("display","none");
					$(".buttons").find(".btn:eq(2)").css("display","none");
					$(".buttons").find(".btn:eq(3)").css("display","none");
					if(value.status == "PENDING"){
						$(".buttons").find(".btn:eq(0)").css("display","inline-block").attr("data-id",value.id);
						$(".buttons").find(".btn:eq(1)").css("display","inline-block").attr("data-id",value.id);
					}else if(value.status == "APPROVED"){
						$(".buttons").find(".btn:eq(2)").css("display","inline-block").attr("data-id",value.id);
						$(".buttons").find(".btn:eq(3)").css("display","inline-block").attr("data-id",value.id);									
					}
				});

			}
			$.each(sData.messages,function(key,data){
				
				if(previous == "" || previous != data.user_id)
				{
					rowBody = $("#table_template tbody").find("tr").removeAttr("data-toggle href style id appointment-id").clone();
					rowBody.find("td:eq(0)").html("<strong>"+data.last_name+", "+data.first_name+"</strong>");
					rowBody.find("td:eq(1)").remove();
					rowBody.find("td:eq(2)").remove();
					rowBody.find("td:eq(3)").remove();					
					$("#modal_table").append(rowBody);
					previous = data.user_id;
				}

				rowBody = $("#table_template tbody").find("tr").clone();
				rowBody.find("td:eq(0)").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.message);
				rowBody.find("td:eq(1)").remove();
				rowBody.find("td:eq(2)").remove();
				rowBody.find("td:eq(3)").remove();
				rowBody.find("td:eq(4)").remove();
				rowBody.find("td:eq(5)").remove();
				rowBody.find("td:eq(6)").remove();
				rowBody.find("td:eq(7)").remove();
				rowBody.find("td:eq(8)").remove();
				rowBody.find("td:eq(9)").remove();
				$("#modal_table").append(rowBody);
				$("#scrollable").scrollTop($("#modal_table")[0].scrollHeight);
			    // $('#scrollable').scrollTop($("#scrollable").children(':last').offset().top);
			});
		}
	});
}).on('click','.status',function(){
	$.ajax({
		url : BASE_URL+"index.php/home/edit_status_appointment",
		data:{
			id 		: $(this).attr("data-id"),
			status 	: $(this).attr("id")
		},
		type: "POST",
		success : function(sData){
			location.reload();
		}
	});
}).on("hidden.bs.modal","#modal-container ",function(){
	alert(1);
});



	$("#toggle_view").click(function (){
		if($("#toggle_view").val() == "Full Calendar View")
		{
			$("#toggle_view").attr('value',"Appointments List View");
			$( ".table-responsive" ).load( "<?php echo base_url();?>index.php/home/appointments_fullcalendar" );
		}
		else
		{
			$("#toggle_view").attr('value',"Full Calendar View");
			$( ".table-responsive" ).unload( "<?php echo base_url();?>index.php/home/appointments_fullcalendar" );
		}
	});
	$(".button_edit_row").click(function(){

	});
</script>

</body>
</html>


<script>
var RecordsArray = "<?php echo json_encode($records);?>";


$(document).ready(function(){

});

	$(".button_edit_row").click(function(){
		var id = $(this).attr("data-id");
		$.each(RecordsArray,function(key,val){
			if(id == key)
			{
				var name = val.name;
				var value = val.value;
				var status = val.status;
			}
		});
	});
</script>