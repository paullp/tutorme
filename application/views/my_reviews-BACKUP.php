<?php
	$id = 0;
	foreach($overall_rating as $or)
	{
		$id = $or->teacher_id;
		echo "<table align='center'>
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
			<td align='center'> ".round($or->quality)." </td>
			<td align='center'> ".round($or->preparation)." </td>
			<td align='center'> ".round($or->english_ability)." </td>
			<td align='center'> ".round($or->friendliness)." </td>
			<td align='center'> ".round($or->punctuality)." </td>
			<td align='center'> ".round($or->overall_rating)." </td>
			<td align='center'> ".round($or->recommended)." </td>
		</tr>";
	}
?>

<table align="center">
<?php


	foreach($my_reviews as $mr)
	{
		$overall_rating = round(($mr->quality + $mr->preparation + $mr->english_ability + $mr->friendliness + $mr->punctuality) / 5);

?>
		<tr>
		
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
		</td>
		
		<?php
		if($usertype == 1)
		{
			echo "<td>
				<a href='";
				echo base_url();
				echo "index.php/home/delete_review?id=$mr->review_id&teacher_id=$mr->teacher_id'> X </a>
			</td>";
		}
		?>
		</tr>
<?php

	}
if($usertype == 3)
{
?>
	<tr>
		<td>
			<a href="<?php echo base_url();?>index.php/home/set_appointment?id=<?php echo $id;?>">Request for appointment</a>
		</td>
		<Td colspan='2' align='center'>
			<a href="<?php echo base_url();?>index.php/home/teacher_list">Back to teacher list</a>
		<td>
	</tr>
<?php
}
?>
</table>