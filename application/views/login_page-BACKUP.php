<?php
echo form_open('login/check_database');
echo "
<table align='center' border='0' cellpadding='0' cellspacing='0' width='20%'>
<tr>
	<td colspan='2' align='center'>
		Login
		<div style='color:red'>".form_error('password')."</div>
	</td>
</tr>
<tr>
	<td width='50%' align='center'> 	
		Email: 
	</td>
	<td>
		<input type='text' name='email' value='". set_value('email')."'/>
	</td>
</tr>
<tr>
	<td align='center'>
		Password: 
	</td>
	<td>
		<input type='password' name='password' value='". set_value('password')."'/>
	</td>
</tr>
<tr>
	<td align='center'>
	".form_submit('mysubmit', 'Login')."
</td>
	<td align='center'>
		<a href='" . base_url() . "index.php/register/register_student'>Sign up</a> | 
		<a href='" . base_url() . "index.php/login/retrieve_password'>Forgotten Password?</a>
	</td>
</tr>
</table>
</form>";
?>
<script>
	<?php if($this->session->flashdata('msg')){ ?>
	alert('<?php echo $this->session->flashdata('msg'); ?>');
	<?php } ?>
</script>