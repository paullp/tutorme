<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<h2 class="page-header">Reviews from the Student/s
                
                </h2>
               
				<div class="col-lg-12">
					
						<?php
						
						foreach($overall_rating as $or)
						{
							$id = $or->teacher_id;
							?>"<table class="table table-striped">
							<tr>
								<th colspan ='7'>
									OVERALL RATING
								</th>
							</tr>
							<tr>
								<th width='150' align='center'>Quality</th>
								<th width='150' align='center'>Preparation</th>
								<th width='150' align='center'>English Ability</th>
								<th width='150' align='center'>Friendliness</th>
								<th width='150' align='center'>Punctuality</th>
								<th width='150' align='center'>Overall Rating</th>
								<th width='150' align='center'>Recommended</th>
							</tr>
							<tr>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->quality);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->preparation);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->english_ability);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->friendliness);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->punctuality);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->overall_rating);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
								<td align='center'><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo round($or->recommended);?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
							</tr>
							</table>
						<?php }

							foreach($my_reviews as $mr)
							{
								$overall_rating = round(($mr->quality + $mr->preparation + $mr->english_ability + $mr->friendliness + $mr->punctuality) / 5);

						?>
								<!-- <tr>
								
								<td>
									<img src="<?php echo base_url(). $mr->photo?>" style="width:144px;height:144px">
								</td>
										
								<td style="vertical-align: top;">
									Overall Rating : <?php echo $overall_rating;?> <br>
									Name  : <?php echo $mr->last_name.", ".$mr->first_name;?><br>
									Quality  : <?php echo $mr->quality;?> <br>
									Preparation  : <?php echo $mr->preparation;?> <br>
									English Ability  : <?php echo $mr->english_ability;?> <br>
									Friendlinesss  : <?php echo $mr->friendliness;?> <br>
									Punctuality  : <?php echo $mr->punctuality;?> <br>
									Comment  : <?php echo $mr->comment;?> <br>
									Recommended  : <?php if($mr->recommendation == 1){echo "Yes";} else { echo "No";};?> <br>
								</td> -->
								
								
								<!-- </tr> -->
								<div class="row">
								<div class="row rowWrapper">
									<div class="col-xs-6 col-md-4-img">
										<img src="<?php echo base_url(). $mr->photo?>">
		                                <h4 class="bold center">Overall Rating</h4>
		                                <div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-value="<?php echo $overall_rating;?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
									</div>
									<di	v class="col-xs-12 col-sm-6 col-md-8-content">
		                            
		                            
		                             <div class="row right">
		                            
		                               		<?php
											if($usertype == 1)
											{
												echo "<button style='vertical-align: bottom;' class='deleteBtn'>
				                                <i class='fa fa-trash-o fa-fw'></i>
												<a href='".base_url()."index.php/home/delete_review?id=".$mr->review_id."&teacher_id=".$mr->teacher_id."' class='bold'>
												Delete Reviews </a>
												</button>";
											}
											?>
		                               </div> 
		                                
										<h3 class="bold"><?php echo $mr->first_name . ' ' .$mr->last_name;?></h3>
										 <div class="table-responsive">
		                                <table class="table table-striped">
		                                    <tbody>
		                                        <tr>
		                                            <td  class="tableLabel">Teaching Quality : </td>
		                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $mr->quality;?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
		                                        </tr>
		                                        <tr>
		                                            <td class="tableLabel">Preparation :</td>
		                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $mr->preparation;?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>    
		                                        </tr>
		                                        <tr>
		                                            <td class="tableLabel">English Ability :</td>
		                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $mr->english_ability;?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
		                                        </tr>
		                                        <tr>
		                                            <td class="tableLabel">Friendliness :</td>
		                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $mr->friendliness;?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
		                                        </tr>
		                                        <tr>
		                                            <td class="tableLabel">Punctuality :</td>
		                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $mr->punctuality;?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
		                                        </tr>
		                                        <tr>
		                                            <td class="tableLabel">Recommended :</td>
		                                            <td>
		                                            	<?php if($mr->recommendation == 1){echo "Yes";} else { echo "No";};?>
		                                            </td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </div>
		                                 
										<div class="row right">
											<button style="vertical-align: bottom;" class="reviewsBtn">
		                                        <i class="fa fa-comment-o fa-fw"></i>
		                                        <a href="#" onclick="comment('<?php echo $mr->first_name . ' ' .$mr->last_name;?>', '<?php echo $mr->comment;?>')" data-toggle="modal" data-target="#studentComments" class="bold">
		                                            View Comment
		                                        </a>
				</button>
									</div>
								</div>

							</div>
		                    
		                    <div class="clear"></div><br>
						<?php

							}
							if($usertype == 3)
							{
							?>
								<!-- <tr>
									<td>
										<a href="<?php echo base_url();?>index.php/home/set_appointment?id=<?php echo $id;?>">Request for appointment</a>
									</td>
									<Td colspan='2' align='center'>
										<a href="<?php echo base_url();?>index.php/home/teacher_list">Back to teacher list</a>
									<td>
								</tr> -->
							<?php
							}
							?>
						<!-- <div class="row rowWrapper">
							<div class="col-xs-6 col-md-4-img">
								<img src="<?php echo base_url(); ?>assets/images/sampleimg.jpg">
                                <h4 class="bold center">Overall Rating</h4>
                                <div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-value="4" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
							</div>
							<di	v class="col-xs-12 col-sm-6 col-md-8-content">
                            
                            
                             <div class="row right">
                            
                               
                               </div> 
                                
								<a href="my_profileTeacher-student.html"> <h3 class="bold">George Manuel, 24</h3></a>
								 <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td  class="tableLabel">Teaching Quality : </td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="4" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Preparation :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="3" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>    
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">English Ability :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="2" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Friendliness :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="1" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Punctuality :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Recommended :</td>
                                            <td>Yes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                 
								<div class="row right">
									<button style="vertical-align: bottom;" class="reviewsBtn">
                                        <i class="fa fa-comment-o fa-fw"></i>
                                        <a href="/" data-toggle="modal" data-target="#studentComments" class="bold">
                                            View Comment/s
                                        </a>
		</button>
							</div>
						</div>

					</div>
                    
                    <div class="clear"></div><br> -->
                    
                  <!-- <div class="row rowWrapper">
							<div class="col-xs-6 col-md-4-img">
								<img src="<?php echo base_url(); ?>assets/images/sampleimg.jpg">
                                <h4 class="bold center">Overall Rating</h4>
                                <div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-value="4" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-8-content">
                            
                            
                             <div class="row right">
                           
                               
                               </div> 
                                
								<a href="my_profileTeacher-student.html"> <h3 class="bold">George Manuel, 24</h3></a>
								 <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td  class="tableLabel">Teaching Quality : </td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="4" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Preparation :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="3" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>    
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">English Ability :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="2" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Friendliness :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="1" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Punctuality :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Recommended :</td>
                                            <td>Yes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                 
								<div class="row right">
									<button style="vertical-align: bottom;" class="reviewsBtn">
                                        <i class="fa fa-comment-o fa-fw"></i>
                                        <a href="/" data-toggle="modal" data-target="#studentComments" class="bold">
                                            View Comment/s
                                        </a>
		</button>
							</div>
						</div>
					</div> -->
                    
                    
			</div>
                    
					<div class="row">
						<div class="col-sm-6">
						</div>
						<div class="col-sm-6">
							<!-- <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
								<ul class="pagination">
									<li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li>
									<li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
									<li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="http://www.tutorme.com.tw/index.php/home/appointments/5">2</a></li>
									<li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="http://www.tutorme.com.tw/index.php/home/appointments/10">3</a></li>
									<li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="http://www.tutorme.com.tw/index.php/home/appointments/15">4</a></li>
									<li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="http://www.tutorme.com.tw/index.php/home/appointments/20">5</a></li>
									<li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="http://www.tutorme.com.tw/index.php/home/appointments/25">6</a></li>
									<li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li>
								</ul>
							</div> -->
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
<div class="modal fade" id="viewSched" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Schedule
                </h4>
                <h2 class="modal-title" id="myModalLabel">Ken Felipe</h2>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
				<table width="100%" border="0">
                      <tr>
                        <td colspan="2" class="bold">Monday</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>9am-11am | 11am-1pm | 3pm-5pm | 5pm-7pm | 7pm-9pm</td>
                      </tr>
                       <tr>
                        <td colspan="2" class="bold">Tuesday</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>9am-11am | 11am-1pm | 7pm-9pm</td>
                      </tr>
                    </table>

            </div>
            
           
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addReviews" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Review
                </h4>
            </div>
            
            <!-- Modal Body -->
            <table align="center">
		<tbody>
		<tr>
			<td>
				Teacher
			</td>
			<td>
								<select name="teacher" class="form-control">
					<option value="">Select Teacher</option>
									</select>
							</td>
		</tr>
		<tr>
			<td>
				Teaching Quality
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Preparation
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				English Ability
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>			
            </td>
		</tr>
		<tr>
		<td>
				Friendliness
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div> 			
            </td>
		</tr>
		<tr>
		<td>
				Punctuality
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Comment
			</td>
			<td>
					<textarea name="comment" maxlength="250" rows="5" cols="60" style="font-family:Arial;" class="form-control"></textarea> 
			</td>
		</tr>
		<tr>
			<td>
				Would you recomend this teacher?
			</td>
			<td>
				<input id="recommend_yes" type="radio" name="recommendation" value="1">	
				
				<label for="recommend_yes">Yes</label>
				<input id="recommend_no" type="radio" name="recommendation" value="0">	
				<label for="recommend_no">No</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" class="btn btn-default">
			</td>
		</tr>
	</tbody></table>
            
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editReviews" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit Review
                </h4>
            </div>
            
            <!-- Modal Body -->
            <table align="center">
		<tbody>
		<tr>
			<td>
				Teacher
			</td>
			<td>
				Teacher's Name
							</td>
		</tr>
		<tr>
			<td>
				Teaching Quality
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Preparation
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				English Ability
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>			
            </td>
		</tr>
		<tr>
		<td>
				Friendliness
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div> 			
            </td>
		</tr>
		<tr>
		<td>
				Punctuality
			</td>
			<td>
				<div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Comment
			</td>
			<td>
					<textarea name="comment" maxlength="250" rows="5" cols="60" style="font-family:Arial;" class="form-control"></textarea> 
			</td>
		</tr>
		<tr>
			<td>
				Would you recomend this teacher?
			</td>
			<td>
				<input id="recommend_yes" type="radio" name="recommendation" value="1">	
				
				<label for="recommend_yes">Yes</label>
				<input id="recommend_no" type="radio" name="recommendation" value="0">	
				<label for="recommend_no">No</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" class="btn btn-default">
			</td>
		</tr>
	</tbody></table>
            
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="studentComments" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Comment
                </h4>
            </div>
            
            <!-- Modal Body -->
          <table>
  <tr>
    <td class="bold" id="comment-student"> George</td>
    <td></td>
  </tr>
  <tr>
    <td> </td>
    <td id="comment-message">Good job bro</td>
  </tr>
</table>

            
            </div>
        </div>
    </div>
</div>

   



<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<script src="<?php echo base_url(); ?>assets/src/jquery.rateit.js" type="text/javascript"></script>

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

    <script src="<?php echo base_url(); ?>assets/sh/shCore.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/sh/shBrushJScript.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/sh/shBrushXml.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/sh/shBrushCss.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/sh/shBrushCSharp.js" type="text/javascript"></script>

    <script type="text/javascript">
        SyntaxHighlighter.all()
    </script>

    <script>
    	function comment(name, message){
    		$('#comment-student').html(name);
    		$('#comment-message').html(message);
    	}
    </script>

</body>
</html>