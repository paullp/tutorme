<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<h2 class="page-header">Reviews
                <div class="right">
                            
                               <button class="btn btn-default"><a href="#" data-toggle="modal" data-target="#addReviews"> Create Reviews</a></button>
                               </div>
                </h2>
               
				<div class="col-lg-12">
					<?php
					if($review_id == NULL)
					{
						if($reviews != NULL)
						{
							foreach($reviews as $r)
							{	 
					?>
					<div class="row">
						<div class="row rowWrapper">
							<div class="col-xs-6 col-md-4-img">
								<img src="<?php echo base_url().$r->photo; ?>">
                                <h4 class="bold center">Overall Rating</h4>
                                <?php
                                	$overall_rating = round(($r->quality + $r->preparation + $r->english_ability + $r->friendliness + $r->punctuality) / 5);
                                ?>
                                <div class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-value="<?php echo $overall_rating; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-8-content">
                            
                            
                             <div class="row right">
                             <button style="vertical-align:bottom;" class ="editBtn">
                            	<i class="fa fa-edit fa-fw"></i>
                            	<?php 
                            		$teacher_name = $r->first_name . ' ' . $r->last_name; 
                            	?>
								<a href="#" onclick="edit_review('<?php echo $r->review_id . "', '" . $teacher_name . "', '" . $r->quality . "', '" . $r->preparation . "', '" . $r->english_ability . "', '" . $r->friendliness . "', '" . $r->punctuality  . "', '" . $r->comment . "', '" . $r->recommendation; ?>')" data-toggle="modal" data-target="#editReviews" class="bold">
								Edit </a> 
								</button>
                               
                               </div> 
                                
								<a href="<?php echo base_url() . 'index.php/home/my_profile?id=' . $r->id . '&view_profile=teacher'; ?>"> <h3 class="bold"><?php echo $r->first_name . ' ' . $r->last_name; ?>, <?php echo date_diff(date_create($r->birthday), date_create('today'))->y ?></h3></a>
								 <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td  class="tableLabel">Teaching Quality : </td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $r->quality; ?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Preparation :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $r->preparation; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>    
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">English Ability :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $r->english_ability; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Friendliness :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $r->friendliness; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Punctuality :</td>
                                            <td><div class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25" data-rateit-value="<?php echo $r->punctuality; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div></td>
                                        </tr>
                                        <tr>
                                            <td class="tableLabel">Recommended :</td>
                                            <td><?php 
                                            	if($r->recommendation == 1)
													{
														echo "Yes";
													}
													else
													{
														echo "No";
													}

                                            ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                 
								<div class="row right">
									<button style="vertical-align: bottom;" class="reviewsBtn">
                                        <i class="fa fa-comment-o fa-fw"></i>
                                        <a href="#" onclick="comment('You', '<?php echo $r->comment;?>')" data-toggle="modal" data-target="#studentComments" class="bold">
                                            Comment
                                        </a>
		</button>
							</div>
						</div>
					</div>
                    
                    <div class="clear"></div><br>
                    
                    
			</div>
					<?php
							}
						}
					}
					?>
                    
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
            <form method="POST" action="<?php echo base_url();?>index.php/home/submit_review">
	<?php
		if($review_id != NULL)
		{
			//echo "<input type='hidden' name='review_id' value='$review_id'/>";
		}
	?>
	<table align="center">
		<tr>
			<td>
				Teacher
			</td>
			<td>
				<?php
					if($review_id != NULL)
					{
						foreach($review as $r)
						{
							echo $r->last_name.", ".$r->first_name;
							$quality = $r->quality;
							$preparation = $r->preparation;
							$english_ability = $r->english_ability;
							$friendliness = $r->friendliness;
							$punctuality = $r->punctuality;
							$comment = $r->comment;
							$recommendation = $r->recommendation;
						}
					}
					else
					{
				?>
				<select name="teacher" class="form-control">
					<option value="">Select Teacher</option>
					<?php
						foreach($past_teacher as $pt)
						{
							echo "<option value='$pt->id'>$pt->last_name, $pt->first_name</option>";
						}
					?>
				</select>
				<?php
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				Teaching Quality
			</td>
			<td>
				<?php
					// $index = 1;
					// while($index < 6)
					// {
					// 	echo "<input type='radio' name='quality' value='$index'";
					// 		if($review_id != NULL AND $index == $quality)
					// 		{
					// 			echo "checked";
					// 		}
					// 	echo"/>$index ";
					// 	$index++;
					// }
				?>
				<input type="hidden" name="quality" id="add-review-quality">
				<div data-rateit-backingfld="#add-review-quality" class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
			</td>
		</tr>
		<tr>
		<td>
				Preparation
			</td>
			<td>
				<?php
					// $index = 1;
					// while($index < 6)
					// {
					// 	echo "<input type='radio' name='preparation' value='$index'";
					// 	if($review_id != NULL AND $index == $preparation)
					// 	{
					// 		echo "checked";
					// 	}
					// 	echo"/>$index ";
					// 	$index++;
					// }
				?>
				<input type="hidden" name="preparation" id="add-review-preparation">
				<div data-rateit-backingfld="#add-review-preparation" class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
			</td>
		</tr>
		<tr>
		<td>
				English Ability
			</td>
			<td>
				<?php
					// $index = 1;
					// while($index < 6)
					// {
					// 	echo "<input type='radio' name='english_ability' value='$index'";
					// 	if($review_id != NULL AND $index == $english_ability)
					// 	{
					// 		echo "checked";
					// 	}
					// 	echo"/>$index ";
					// 	$index++;
					// }
				?>
				<input type="hidden" name="english_ability" id="add-review-english_ability">
				<div data-rateit-backingfld="#add-review-english_ability" class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
			</td>
		</tr>
		<tr>
		<td>
				Friendliness
			</td>
			<td>
				<?php
					// $index = 1;
					// while($index < 6)
					// {
					// 	echo "<input type='radio' name='friendliness' value='$index'";
					// 	if($review_id != NULL AND $index == $friendliness)
					// 	{
					// 		echo "checked";
					// 	}
					// 	echo"/>$index ";
					// 	$index++;
					// }
				?>
				<input type="hidden" name="friendliness" id="add-review-friendliness">
				<div data-rateit-backingfld="#add-review-friendliness" class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
			</td>
		</tr>
		<tr>
		<td>
				Punctuality
			</td>
			<td>
				<?php
					// $index = 1;
					// while($index < 6)
					// {
					// 	echo "<input type='radio' name='punctuality' value='$index'";
					// 	if($review_id != NULL AND $index == $punctuality)
					// 	{
					// 		echo "checked";
					// 	}
					// 	echo"/>$index ";
					// 	$index++;
					// }
				?>
				<input type="hidden" name="punctuality" id="add-review-punctuality">
				<div data-rateit-backingfld="#add-review-punctuality" class="rateit mediumstars" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
			</td>
		</tr>
		<tr>
		<td>
				Comment
			</td>
			<td>
					<textarea class="form-control" name="comment" maxlength="250" rows="5" cols="60" style="font-family:Arial;"><?php
						if($review_id != NULL)
						{
							echo $comment;
						}
					?></textarea> 
			</td>
		</tr>
		<tr>
			<td>
				Would you recomend this teacher?
			</td>
			<td>
				<?php
				echo "<input id='recommend_yes' type='radio' name='recommendation' value='1'";
				
						if($review_id != NULL and $recommendation == 1)
						{
							echo "checked";
						}
				echo "/>";
				?>	
				
				<label for="recommend_yes">Yes</label>
				<?php
				echo "<input id='recommend_no' type='radio' name='recommendation' value='0'";
				
						if($review_id != NULL and $recommendation == 0)
						{
							echo "checked";
						}
				echo "/>";
				?>	
				<label for="recommend_no">No</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" class="btn btn-default" onclick="add_review()"> 
			</td>
		</tr>
	</table>
	</form>
            
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
			<form method="POST" action="<?php echo base_url();?>index.php/home/submit_review">
            	<input id="er-id" type="hidden" name="review_id" value=""/>
		<tr>
			<td>
				Teacher
			</td>
			<td id="er-name">
				Teacher's Name
							</td>
		</tr>
		<tr>
			<td>
				Teaching Quality
			</td>
			<td>
				<input type="hidden" name="quality" id="er-quality">
				<div id="er-rateit-quality" data-rateit-backingfld="#er-quality" class="rateit mediumstars" data-rateit-value="0" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Preparation
			</td>
			<td>
				<input type="hidden" name="preparation" id="er-preparation">
				<div id="er-rateit-preparation" data-rateit-backingfld="#er-preparation" class="rateit mediumstars" data-rateit-value="0" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				English Ability
			</td>
			<td>
				<input type="hidden" name="english_ability" id="er-english_ability">
				<div id="er-rateit-english_ability" data-rateit-backingfld="#er-english_ability" class="rateit mediumstars" data-rateit-value="0" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Friendliness
			</td>
			<td>
				<input type="hidden" name="friendliness" id="er-friendliness">
				<div id="er-rateit-friendliness" data-rateit-backingfld="#er-friendliness" class="rateit mediumstars" data-rateit-value="0" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Punctuality
			</td>
			<td>
				<input type="hidden" name="punctuality" id="er-punctuality">
				<div id="er-rateit-punctuality" data-rateit-backingfld="#er-punctuality" class="rateit mediumstars" data-rateit-value="0" data-rateit-starwidth="25" data-rateit-starheight="25"></div>
            </td>
		</tr>
		<tr>
		<td>
				Comment
			</td>
			<td>
					<textarea id="er-comment" name="comment" maxlength="250" rows="5" cols="60" style="font-family:Arial;" class="form-control"></textarea> 
			</td>
		</tr>
		<tr>
			<td>
				Would you recomend this teacher?
			</td>
			<td>
				<input id="er-recommend_yes" type="radio" name="recommendation" value="1">	
				
				<label for="er-recommend_yes">Yes</label>
				<input id="er-recommend_no" type="radio" name="recommendation" value="0">	
				<label for="er-recommend_no">No</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" class="btn btn-default">
			</td>
		</tr>
		</form>
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



<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<script>
	function comment(name, message){
		$('#comment-student').html(name);
		$('#comment-message').html(message);
	}

	function edit_review(id, name, quality, preparation, english_ability, friendliness, punctuality, comment, recommendation){
		$('#er-id').val(id);
		$('#er-name').html(name);
		$('#er-quality').val(quality);
		$('#er-preparation').val(preparation);
		$('#er-english_ability').val(english_ability);
		$('#er-friendliness').val(friendliness);
		$('#er-punctuality').val(punctuality);
		$('#er-comment').val(comment);

		$('#er-rateit-quality').attr('data-rateit-value', quality);
		$('#er-rateit-preparation').attr('data-rateit-value', preparation);
		$('#er-rateit-english_ability').attr('data-rateit-value', english_ability);
		$('#er-rateit-friendliness').attr('data-rateit-value', friendliness);
		$('#er-rateit-punctuality').attr('data-rateit-value', punctuality);

		$('#er-rateit-quality .rateit-range').attr('aria-valuenow', quality);
		$('#er-rateit-preparation .rateit-range').attr('aria-valuenow', preparation);
		$('#er-rateit-english_ability .rateit-range').attr('aria-valuenow', english_ability);
		$('#er-rateit-friendliness .rateit-range').attr('aria-valuenow', friendliness);
		$('#er-rateit-punctuality .rateit-range').attr('aria-valuenow', punctuality);

		$('#er-rateit-quality .rateit-selected').css({ 'display': 'block', 'width': (quality*25)+'px' });
		$('#er-rateit-preparation .rateit-selected').css({ 'display': 'block', 'width': (preparation*25)+'px' });
		$('#er-rateit-english_ability .rateit-selected').css({ 'display': 'block', 'width': (english_ability*25)+'px' });
		$('#er-rateit-friendliness .rateit-selected').css({ 'display': 'block', 'width': (friendliness*25)+'px' });
		$('#er-rateit-punctuality .rateit-selected').css({ 'display': 'block', 'width': (punctuality*25)+'px' });

		if(recommendation == 1){
			$('#er-recommend_yes').attr('checked', 'checked');
		}else{
			$('#er-recommend_no').attr('checked', 'checked');
		}
	}
</script>

</body>
</html>