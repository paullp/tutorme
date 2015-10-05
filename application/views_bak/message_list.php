<table align="center" border="0">
	<?php
	$index = 0;
	//echo sizeof($message_list);

		foreach($message_list as $ml)
		{
			foreach($ml as $m)
			{
	?>		
			<tr onClick="window.location='messages?id=<?php echo $m->from_id?>'" style="cursor:pointer;">
				<td>
					<img src="<?php echo base_url(). $m->photo?>" style="width:50px;height:50px">
				</td>
				
				<td>
				
					<?php echo $m->last_name.", ". $m->first_name?>			
				</td>
				
				<td>
				
					<?php echo $m->content ?>
				
				</td>
			<tr>
		<?php
			}
		}
	?>
</table>