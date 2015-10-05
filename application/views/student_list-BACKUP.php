
<table align="center" border="1" width="60%";>
	<tr>
		<td colspan="2" align="center">
			Student List
		</td>
	</tr>
	
	<?php foreach($student_list as $tl)
	{
	?>
	<tr>
		
		<td width="10%">
			<img src="<?php echo base_url(). $tl->photo?>" style="width:144px;height:144px">
		</td>
		
		<td style="vertical-align: top;" width="90%">
			Name : <a href="<?php echo base_url();?>index.php/home/my_profile?id=<?php echo $tl->id?>&view_profile=student"><?php echo $tl->last_name.", ".$tl->first_name;?></a> <br>
			
			Age : <?php echo date_diff(date_create($tl->birthday), date_create('today'))->y?> <br>
			
			Mandarin Level : <?php echo $tl->mandarin_level;?> <br>
				
			Current Location : <?php echo $tl->current_location;?> <br>
		</td>
	</tr>
	
	<?php
	}
	?>
	
</table>