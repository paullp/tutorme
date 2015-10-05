
	

<script>
	$(document).ready(function(){
		$(".chkbox").hide();
		$("#delete").hide();
		$("#hide").hide();
	
	});
	function check()
	{
		$(".chkbox").show();
		$("#delete").show();
		$("#hide").show();
	}
	function hide()
	{
		$(".chkbox").hide();
		$("#delete").hide();
		$("#hide").hide();
	}
</script>
<table align="center">
	<form method="POST" action="<?php echo base_url();?>index.php/home/delete_message"/>
	<tr>
		<td colspan="2">
			<input type="submit" id="delete" name="submit" value="Delete Message(s)" class="btn btn-default"/>
			<a href="#" onclick="hide()" id="hide" class="btn btn-default"/>Hide</a>
		</td>
	</tr>
<?php
	$previous = "";
	foreach($appointment_messages as $am)
	{
		if($previous == "" or $previous != $am->user_id)
		{
		echo"
		<tr>
			<td colspan='2'>
				<div style='font-weight:bold'>
					$am->first_name
				</div>
			</td>
		</tr>";
		$previous = $am->user_id;
		}
		echo "
		<tr>
			<td>";
			if($am->user_id == $id)
			{
		?>
			<input type="checkbox" class="chkbox" name="message_delete[]" value="<?php echo $am->id?>" class="btn btn-default"/>
		<?php
			}
		echo "
			</td>
			<td>
				$am->message
			</td>";
			if($usertype == 1)
			{
				echo "<td>";
					echo "<a onclick='return confirm(\"Are you sure you want to delete this comment?\")' href='";
					echo base_url();
					echo "index.php/home/delete_comment?id=$am->id&appointment_id=$am->appointment_id'>
						<img scr='#'>[X]
					</a>";
				echo "</td>";
			}
		echo"</tr>";
	}
?>
	</form>
	<form method="POST" action="<?php echo base_url();?>index.php/home/send_message_exec"/>
	<tr>
		<td>
			Reply
		</td>
		<td>
			<input type="hidden" name="appointment_id" value="<?php echo $appointment_id;?>" class="form-control">
			<textarea name="message" maxlength="200" rows="5" cols="60" style="font-family:Arial;" class="form-control"></textarea>
		</td>
	</tr>
	<tr>
		<td colspan='2' align="center">
			<input type="submit" name="Send" value="Send" class="btn btn-default"/>
		</td>
	</tr>
	</form>
</table>


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