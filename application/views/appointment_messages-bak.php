<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
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
			<input type="submit" id="delete" name="submit" value="Delete Message(s)"/>
			<a href="#" onclick="hide()" id="hide"/>Hide</a>
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
			<input type="checkbox" class="chkbox" name="message_delete[]" value="<?php echo $am->id?>"/>
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
	<?php foreach($appointment_info as $ai){
	if($ai->status != "FINISHED" AND $ai->status != "REJECTED")
	{
	?>
	<form method="POST" action="<?php echo base_url();?>index.php/home/send_message_exec"/>
	<tr>
		<td>
			Reply
		</td>
		<td>
			<input type="hidden" name="appointment_id" value="<?php echo $appointment_id;?>">
			<textarea name="message" maxlength="200" rows="5" cols="60" style="font-family:Arial;"></textarea>
		</td>
	</tr>
	<tr>
		<td colspan='2' align="center">
			<input type="submit" name="Send" value="Send"/>
		</td>
	</tr>
	</form>
	<?php }}?>
</table>