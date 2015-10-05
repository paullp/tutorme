<?php
if($review_id == NULL)
{
?>
<h3 align="center">My Reviews : <a href="#">[add review]</a></h3>


<table align="center">
<tr>
	<th width="100">       </th>
	<th width="100">Teacher</th>
	<th width="100">Teacher Quality</th>
	<th width="100">Preparation</th>	
	<th width="100">English Ability</th>
	<th width="100">Friendliness</th>
	<th width="100">Punctuality</th>
	<th width="100">Comment</th>
	<th width="100">Recommended</th>
	<th width="100">Action</th>
</tr>
<?php
if($reviews != NULL)
{
	foreach($reviews as $r)
	{	
		
		echo "<tr><td align='center'><img src='".base_url().$r->photo."' style='width:144px;height:144px'></td>";
		echo "<td align='center'>$r->last_name, $r->first_name</td>";
		echo "<td align='center'>$r->quality</td>";
		echo "<td align='center'>$r->preparation</td>";
		echo "<td align='center'>$r->english_ability</td>";
		echo "<td align='center'>$r->friendliness</td>";
		echo "<td align='center'>$r->punctuality</td>";
		echo "<td align='center'>$r->comment</td>";
		echo "<td align='center'>";
		if($r->recommendation == 1)
		{
			echo "Yes";
		}
		else
		{
			echo "No";
		}
		echo "</td>";
		echo "<td align='center'><a href='reviews?id=$r->review_id'>Edit</a></tr>"; 
	}
}
else
{
?>
	<tr>
			<td>
				No Reviews Yet.
			</td>
		</tr>
	
<?php
}
ECHO "</table>";
}
?>
	
	<div class="form">
	<form method="POST" action="<?php echo base_url();?>index.php/home/submit_review">
	<?php
		if($review_id != NULL)
		{
			echo "<input type='hidden' name='review_id' value='$review_id'/>";
		}
	?>
	<table align="center">
		<tr>
			<th colspan="2">
				Create Review
			</th>
		</tr>
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
				<select name="teacher">
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
					$index = 1;
					while($index < 6)
					{
						echo "<input type='radio' name='quality' value='$index'";
							if($review_id != NULL AND $index == $quality)
							{
								echo "checked";
							}
						echo"/>$index ";
						$index++;
					}
				?>
			</td>
		</tr>
		<tr>
		<td>
				Preparation
			</td>
			<td>
				<?php
					$index = 1;
					while($index < 6)
					{
						echo "<input type='radio' name='preparation' value='$index'";
						if($review_id != NULL AND $index == $preparation)
						{
							echo "checked";
						}
						echo"/>$index ";
						$index++;
					}
				?>
			</td>
		</tr>
		<tr>
		<td>
				English Ability
			</td>
			<td>
				<?php
					$index = 1;
					while($index < 6)
					{
						echo "<input type='radio' name='english_ability' value='$index'";
						if($review_id != NULL AND $index == $english_ability)
						{
							echo "checked";
						}
						echo"/>$index ";
						$index++;
					}
				?>
			</td>
		</tr>
		<tr>
		<td>
				Friendliness
			</td>
			<td>
				<?php
					$index = 1;
					while($index < 6)
					{
						echo "<input type='radio' name='friendliness' value='$index'";
						if($review_id != NULL AND $index == $friendliness)
						{
							echo "checked";
						}
						echo"/>$index ";
						$index++;
					}
				?>
			</td>
		</tr>
		<tr>
		<td>
				Punctuality
			</td>
			<td>
				<?php
					$index = 1;
					while($index < 6)
					{
						echo "<input type='radio' name='punctuality' value='$index'";
						if($review_id != NULL AND $index == $punctuality)
						{
							echo "checked";
						}
						echo"/>$index ";
						$index++;
					}
				?>
			</td>
		</tr>
		<tr>
		<td>
				Comment
			</td>
			<td>
					<textarea name="comment" maxlength="250" rows="5" cols="60" style="font-family:Arial;"><?php
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
				<input type="submit" name="submit">
			</td>
		</tr>
	</table>
	</form>
	</div>