<style>
	.clip-circle {
		background-size:720px 480px;
		background-position:-160px 0px;
		height:200px;
		width:200px;
		border-radius:50%;
		overflow:hidden;
		margin:auto;
	}

</style>
	<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<h2 class="page-header">Teacher List</h2>
				<div class="col-lg-12">
					<?php
						$session_data = $this->session->userdata('logged_in');
						if($teacher_list != FALSE){

						foreach($teacher_list as $key => $tl){?>
		                <div class="row">
		                    <div class="col-md-9">
		                    	<img src="<?php echo base_url().$tl['photo'];?>" class="clip-circle img-responsive" style="float:left; margin-right:10px;">
			                    <a href="<?php echo base_url().'index.php/home/my_profile?id='.$tl['id'].'&view_profile=teacher';?>">								
			                        <h2 class="text-left"><?php echo $tl['first_name'] .' ' .$tl['last_name']." ".date_diff(date_create($tl['birthday']), date_create('today'))->y;?></h2>
			                    </a>
		                        <span class="bold">Occupation:</span> <?php echo $tl['occupation'];?> <br>
		                        <span class="bold">Teaching Experience:</span> <?php echo $tl['teaching_exp'];?> <br>
		                        <span class="bold">Current Location:</span> <?php echo $tl['current_location'];?> <br>
		                    </div>
		                    <div class="col-md-3">
			                    <table border="0">
			                    	<tr>
			                    		<td>
											<div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-value="<?php echo round($tl['overall_rating']);?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
			                    			<p align="center">Based on <?php echo $tl['review_count'];?> reviews</p>
			                    		</td>
			                    	</tr>
			                    	<tr>
			                    		<td>
			                    			<i class='fa fa-comment-o fa-fw'></i>
											<a class='bold' <?php if($tl['review_count'] != 0){?>href="<?php echo base_url().'index.php/home/my_reviews?id='.$tl['id'];?>"<?php }?>>
												<?php echo $tl['review_count'];?> Reviews
											</a>
			                    		</td>
			                    	</tr>
			                    	<tr>
			                    		<td>
			                 				<i class="fa fa-calendar fa-fw"></i>
			                               	<a id="sched" href="#teacher_sched" role="button" class="bold" data-toggle="modal" teacher-id="<?php echo $tl['id'];?>">
			                                	View Schedule
			                                </a>
			                    		</td>
			                    	</tr>
			                    	<?php if($session_data['usertype'] == 1):?>
				                    	<tr>
				                    		<td>
												<i class='fa fa-edit fa-fw'></i>
												<a class='bold' href="<?php echo base_url().'index.php/home/my_profile?id='.$tl['id'].'&edit_profile=true&view_profile=teacher';?>">
													Edit Profile
												</a>
				                    		</td>
				                    	</tr>
				                    	<tr>
				                    		<td>
				                    			<i class='fa fa-trash-o fa-fw'></i>
												<a class='bold' href="<?php echo base_url().'index.php/home/delete_teacher?id='.$tl['id'];?>">
													Delete Teacher
												</a>
				                    		</td>
				                    	</tr>
			                    	<?php endif;?>
			                    </table>
		                    </div>
		                </div>	
						<hr></hr>

					<?php }
					}
					else{
						?>						
					<div class="col-md-12">
		            	<h3>No Teachers Yet :(</h3>
		            </div>
					<?php }?>
					<div class="row">
						<div class="col-sm-6">
						</div>
						<div class="col-sm-6">
							<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
								<ul class="pagination">
									<?php echo $links; ?>
								</ul>
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
<!-- /#wrapper -->


<!-- Modal -->
<div class="container-fluid">
	<div class="row">
			<div class="modal fade" id="teacher_sched" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								×
							</button>
			                <h4 class="modal-title" id="myModalLabel">
			                    Schedule
			                </h4>
						</div>
						<div class="modal-body">
				            <div class="modal-body" id="view-sched-teacher-sched">
								<table width="100%" border="0" id="modal_table">
				               
				                </table>
				            </div>
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Close
							</button> 
						</div>
					</div>		
				</div>			
			</div>
	</div>
</div>

<table id='table_template' style='display:none;'>
		<tbody>
			<tr>
				<td></td>
				<td></td>
			</tr>
		</tbody>
</table>

<script src="<?php echo base_url();?>assets/src/jquery.rateit.js" type="text/javascript"></script>

<script>
    //build toc
    var toc = [];
    $('#examples > li').each(function (i, e) {

        toc.push('<li><a href="#')
        toc.push(e.id)
        toc.push('">')
        toc.push($(e).find('h3:first').text());
        toc.push('</a></li>');

    });

    $('#toc').html(toc.join(''));

</script>

<!-- syntax highlighter -->

<script src="<?php echo base_url();?>assets/sh/shCore.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/sh/shBrushJScript.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/sh/shBrushXml.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/sh/shBrushCss.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/sh/shBrushCSharp.js" type="text/javascript"></script>

 
<script type="text/javascript">
$(document).ready(function(){

}).on("click","#sched",function(){
	$("#modal_table").html('');
	var teacher_id = $(this).attr("teacher-id");
	$.ajax({
		url 	: "<?php echo base_url();?>index.php/home/get_teacher_schedule",
		data 	: "teacher_id="+teacher_id,
		type	: "POST",
		dataType: "json",
		success : function(sData){
			$.each(sData,function(key,value){
				var time_string = '';
				rowBody = $("#table_template tbody").find("tr").clone();
				rowBody.find("td:eq(0)").html("<strong align='right'>"+key+"</strong>");
				$.each(value,function(k,v){
					time_string += v+"|";
				});
				time_string = time_string.slice(0, - 1)
				rowBody.find("td:eq(1)").html(time_string);
				$("#modal_table").append(rowBody);
			});
		}
	});
});
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