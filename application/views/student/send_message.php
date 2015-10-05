<style>
 .container {
    margin-top: 10px;
}
.my-popover-content {
    display:none;
}

.popover-content{
	width: 275px;
}
</style>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Create Appointment</h2>	
				<?php
				echo form_open_multipart("register/create_appointment");
				$cell = '';
				$this->table->set_heading($cell);
				foreach($teacher_profile as $key => $value){
				$list = array(
				'Teacher : '                                                     ,$value['last_name'].", ".$value['first_name'].
																				 "<input type='hidden' name='teacher_id' value='".$value['id']."'/>",
				form_error('place').'Date : </span>'                             ,form_error('schedule_date').'<input class="form-control" type="input" name="schedule_date" id="datepicker" value='.set_value('schedule_date').'>',
				form_error('time').'Time : </span>'                              ,'<input type="hidden" name="schedule_time_id"  value='.set_value('schedule_time').'><div id="schedule_time"/>'.form_error('schedule_date').'</div>
																				   <a href="#" class="popper change" data-toggle="popover">Edit schedule here.</a>',
				form_error('place').'Place : </span>'                            ,'<input class="form-control" type="text" name="place" maxlength="50" value="'.set_value('place').'"/>',
				'Message : '                                                     ,'<textarea class="form-control" name="message" maxlength="200" cols="50" rows="10"></textarea>',
				''																 ,"<input class='btn btn-default' type='submit' name='submit' value='Submit'/> <a href='".base_url()."index.php/home/my_profile?id=".$value['id']."&view_profile=teacher' class='btn btn-default'>Back</a>"
				);
				};
				$new_list = $this->table->make_columns($list, 2);
				echo $this->table->generate($new_list);

				echo "</form>";
				?>			
				</div>
			<div class="clearfix"></div>
			

		</div>

	</div>

</div>


<div class="popper-content hide">
<table class="schedule_table">
	<tr>
		<td>Monday : </td>
		<td>
			<select name="monday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Tuesday : </td>
		<td>
			<select name="tuesday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Wednesday : </td>
		<td>
			<select name="wednesday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Thursday : </td>
		<td>
			<select name="thursday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Friday : </td>
		<td>
			<select name="friday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Saturday : </td>
		<td>
			<select name="saturday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Sunday : </td>
		<td>
			<select name="sunday" class="form-control">
				<option value=""> - Select Time - </option>
				<?php foreach($schedule_time as $key => $value):?>
					<option value="<?php echo $value['id'];?>"><?php echo $value['time'];?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><button class="btn btn-default change_schedule">Submit</button></td></td>
	</tr>
</table>
</div>


<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<script>

	var user_info = <?php echo json_encode($student_profile);?>;
	var schedule_time = <?php echo json_encode($schedule_time);?>;
	var teacher_profile = <?php echo json_encode($teacher_profile);?>;


$(document).ready(function(){

$('.popper').popover({
    placement: 'bottom',
    container: 'body',
    html: true,
    content: function () {
        return $('.popper-content').html();
    }
});

	var dateToday = new Date(); 
	$( "#datepicker" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	  minDate: dateToday	  
	});

}).on("click",".change",function(){
			
			$("select[name='monday']").val(user_info.monday);
			$("select[name='tuesday']").val(user_info.tuesday).attr("selected","selected");
			$("select[name='wednesday']").val(user_info.wednesday).attr("selected","selected");
			$("select[name='thursday']").val(user_info.thursday).attr("selected","selected");
			$("select[name='friday']").val(user_info.friday).attr("selected","selected");
			$("select[name='saturday']").val(user_info.saturday).attr("selected","selected");
			$("select[name='sunday']").val(user_info.sunday).attr("selected","selected");

}).on("change","#datepicker",function(){
			if($(this).val() != "")
			{
				var sched = moment(new Date($(this).val())).format('dddd').toLowerCase();
				
				var time = "";

				$.each(user_info,function(key,val){
					if(key == sched.toLowerCase()){
						time = val;
					}
				});

				if(time != ""){
					$.ajax({
					   type : "POST",
					   url  : "<?php echo base_url(); ?>index.php/register/get_sched_time",
					   datatype: "json",
					   data : {
					   		'name_day' : sched,
					   		'schedule_id' : schedule_time[time].id,
					   		'teacher_id'  : teacher_profile[0].id
					   },
					   success: function(sData){
					   		if(sData == 1){
					   			$("input[name='schedule_time_id']").val("");
					   			 $("#schedule_time").html("<b style='color:red;'>Schedule is already taken</b>");	
					   		}else{
								$("input[name='schedule_time_id']").val(schedule_time[time].id);
							  	$("#schedule_time").html("<b style='color:green;'>"+schedule_time[time].time+"</b>");					   			
					   		}
					   }
					});
				}else{
				   $("input[name='schedule_time_id']").val("");
				   $("#schedule_time").html("<b style='color:red;'>No time for this day</b>");					
				}
			}
			else
			{
				data = "";
				$("#schedule_time").html(data);
			}
  });

	$("body").on("click",".change_schedule",function(){
		alert(1);
	});

	$("#edit_sched").on("submit",function(e){
		
		e.preventDefault();
		
		var f_d = new FormData(this);

		$.ajax({
			url : "<?php echo base_url();?>index.php/home/edit_sched",
			type : "POST",
			datatype : "json",
			data : f_d,
			cache		: false,
			processData : false,
			contentType : false,
			success : function(sData){
				user_info = sData.user_info;
			}
		});
	});

</script>


</body>
</html>