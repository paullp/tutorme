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
				<h2 class="page-header">Student List</h2>
				<div class="col-lg-12">
					<?php
						$session_data = $this->session->userdata('logged_in');
						if($student_list != FALSE){

						foreach($student_list as $key => $sl){?>
		                <div class="row">
		                    <div class="col-md-2">
		                        <img src="<?php echo base_url().$sl['photo'];?>" class="clip-circle img-responsive" style="float:left; margin-right:10px;">
		                    </div>
		                    <div class="col-md-8">
			                    <a href="<?php echo base_url().'index.php/home/my_profile?id='.$sl['id'].'&view_profile=student';?>">								
			                        <h2 class="text-left"><?php echo $sl['first_name'] .' ' .$sl['last_name']." ".date_diff(date_create($sl['birthday']), date_create('today'))->y;?></h2>
			                    </a>
		                        <span class="bold">Occupation:</span> <?php echo $sl['occupation'];?> <br>
		                        <span class="bold">Mandarin Level:</span> <?php echo $sl['mandarin_level'];?> <br>
		                        <span class="bold">Current Location:</span> <?php echo $sl['current_location'];?> <br>
		                    </div>
		                    <div class="col-md-2">
			                    <table border="0">
			                    	<tr>
			                    		<td>
			                 				<i class="fa fa-calendar fa-fw"></i>
			                               	<a id="sched" href="#teacher_sched" role="button" class="bold" data-toggle="modal" teacher-id="<?php echo $sl['id'];?>">
			                                	View Schedule
			                                </a>
			                    		</td>
			                    	</tr>
			                    	<?php if($session_data['usertype'] == 1):?>
				                    	<tr>
				                    		<td>
												<i class='fa fa-edit fa-fw'></i>
												<a class='bold' href="<?php echo base_url().'index.php/home/my_profile?id='.$sl['id'].'&edit_profile=true&view_profile=teacher';?>">
													Edit Profile
												</a>
				                    		</td>
				                    	</tr>
				                    	<tr>
				                    		<td>
				                    			<i class='fa fa-trash-o fa-fw'></i>
												<a class='bold' href="<?php echo base_url().'index.php/home/delete_teacher?id='.$sl['id'];?>">
													Delete Student
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