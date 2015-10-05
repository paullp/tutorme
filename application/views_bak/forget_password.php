<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/javascript/schedule_edit.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui-1.11.2/jquery-ui.css">
<script src="<?php echo base_url() ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php
echo form_open('login/retrieve_password');
$list = array(
''                                                               ,"Retrieve Password",
'Email : '.form_error('email')                                   ,'<input type="input" name="email" value='.set_value('email').'>',
'Birthday : '.form_error('birthday')                             ,'<input type="input" name="birthday" id="datepicker" value='.set_value('birthday').'>',
''																 ,"<input type='submit' name='submit' value='submit'/>"
);
$new_list = $this->table->make_columns($list, 2);
echo $this->table->generate($new_list);
?>
<script>
	$(function() {
		var default_date = $("#datepicker").val();	
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		  changeYear: true, yearRange: '1900:+0'
		});
		$( "#datepicker" ).datepicker( "setDate",default_date);
	});
</script>