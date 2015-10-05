<!-- Page Content -->
<style>
    .clip-circle {
        background:url(URL-of-image) no-repeat;
        background-size:720px 480px;
        background-position:-160px 0px;
        height:200px;
        width:200px;
        border-radius:50%;
        overflow:hidden;
        margin:auto;
    }
.box {
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  width:100%;
  overflow: hidden;
  border: none;
  font: normal 16px/-1 Arial Black, Gadget, sans-serif;
  color: rgba(0,0,0,1);
  text-align: justify;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  background: rgba(255,255,255,0.69);
  -webkit-box-shadow: 2px 2px 1px 0 rgba(0,0,0,0.3) ;
  box-shadow: 2px 2px 1px 0 rgba(0,0,0,0.3) ;
}

</style>
<div id="page-wrapper">
    <div class="container-fluid" >
        <div class="row">
            <h2 class="page-header">Student Profile</h2>
            <div class="col-lg-12">
                    <img src="<?php echo base_url().$user_info['photo'];?>" class="clip-circle img-responsive" id="profile_photo">

            </div>
        </div>
        <div class="row" id="info">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="box">
                    <div class="alert alert-success" id="success" style="display:none;"></div>
                    <h2 class="text-center"> Personal Information </h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">First Name : </label> <?php echo $user_info['first_name'];?>
                            </div>
                            <div class="form-group">
                                <label>Last Name : </label> <?php echo $user_info['last_name'];?>    
                            </div>
                            <div class="form-group">
                                <label>Gender : </label> <?php echo $user_info['gender'];?>
                            </div>
                            <div class="form-group">
                                <label>Birthday : </label> <?php echo date("F d, Y",strtotime($user_info['birthday']));?>
                            </div>                        
                            <div class="form-group">
                                <label>Current Location : </label> <?php echo $user_info['current_location'];?>
                            </div>                 
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label>Native Language : </label> <?php echo $user_info['native_language'];?>
                            </div>
                            <div class="form-group">
                                <label>Mandarin Level : </label> <?php echo $user_info['mandarin_level'];?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Preferred Location : </label> <?php echo $user_info['preferred_location'];?>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label">About Me : </label> <?php echo $user_info['about_me'];?>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label">Comment to Teacher : </label> <?php echo $user_info['comment_teacher'];?>
                            </div>
                    </div>
                    <div class="col-md-1"></div>  
                </div>
                <div class="box" style="display:none;">
                    <div class="alert alert-danger" id="error"style="display:none;"></div>
                    <h2 class="text-center"> Personal Information </h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                            <div class="form-group"
                                <label class="control-label">First Name : </label> 
                                <input class="form-control input-md" name="first_name" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Last Name : </label> 
                                <input class="form-control input-md" name="last_name" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender : </label>
                                <select class="form-control input-md" name="gender">
                                    <option value="">Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select> 
                            </div>
                            <div class="form-group">
                                <label>Birthday : </label>
                                <?php $birthday = $user_info['birthday'];?>
                                <input class="form-control input-md" name="birthday"placeholder="Birthday" id="datepicker" type="text" >
                            </div>                        
                            <div class="form-group">
                                <label>Current Location : </label>
                                 <input class="form-control input-md" name="current_location" type="text">
                            </div>                        
                            <div class="form-group">
                                  <label class="control-label">Photo <i>(.png, .jpg, less than 5mb)</i></label>
                                <input class="form-control input-md" name="photo" type="file" id="photo">
                            </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label>Native Language : </label>
								<input class="form-control input-md" name="native_language" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mandarin Level : </label>
                                <select class="form-control input-md" name="mandarin_level">
                                		<option value="">Choose Mandarin Level</option>
										<option value='Complete Beginner'>Complete Beginner ( I know less than 50 words)</option>
										<option value='Beginner'>Beginner ( i know between 50 and 200 words)</option>
										<option value='Lower Intermediate'>Lower Intermediate ( I know between 200 and 500 words)</option>
										<option value='Intermediate'>Intermediate ( I know between 500 and 1,500 Words)</option>
										<option value='Advanced'>Advanced ( i Know 1,500+)</option>
                                </select> 
                            </div>
                            <div class="form-group">
                                <label class="control-label">Preferred Location : </label>
                                <input class="form-control input-md" name="preferred_location" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">About Me : </label>
                                <textarea class="form-control input-md" name="about_me" maxlength="200" rows="3" cols="50" style="font-family:Arial;"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label"> Comment to Teacher : </label>
                                <textarea class="form-control input-md" name="comment_teacher" maxlength="200" rows="3" cols="50" style="font-family:Arial;"></textarea>
                            </div>
                    </div>
                    <div class="col-md-1"></div> 
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default edit_button" id="personal_info" user="student">Edit</button>
                <div class="set2" style="display:none;">
                    <button class="btn btn-default save" id="personal_info" user="student">Save</button>
                    <button class="btn btn-default cancel" id="personal_info">Cancel</button>
                </div>
            </div>
        </div>

        <div class="row" id="info">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="box">
                    <div class="alert alert-success" id="success" style="display:none;"></div>
                    <h2 class="text-center"> Account Information</h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="control-label">Teacher ID : </label> <?php echo $user_info['id'];?>
                        </div>
                        <div class="form-group">
                            <label>Email : </label> <?php echo $user_info['email'];?>    
                        </div>
                        <div class="form-group">
                            <label>Password : </label> <?php echo $user_info['password'];?>
                        </div>
                    </div>       
                </div>

                <div class="box" style="display:none;">
                    <div class="alert alert-danger" id="error" style="display:none;"></div>
                    <?php 
                    $attr = array("id"=>"account_info");
                    echo form_open('',$attr);?>
                    <h2 class="text-center"> Account Information</h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Teacher ID : </label> <?php echo $user_info['id'];?>
                        </div>
                        <div class="form-group">
                            <label>Email : </label> 
                            <input class="form-control input-md" name="email" type="text">
                        </div>
                        <div class="form-group">
                            <label>Password : </label> 
                            <input class="form-control input-md" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password : </label> 
                            <input class="form-control input-md" name="confirm_password" type="password">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <?php echo form_close();?>       
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default edit_button" id="account_info" user="student">Edit</button>
                <div class="set2" style="display:none;">
                    <button class="btn btn-default save" id="account_info" user="student">Save</button>
                    <button class="btn btn-default cancel" id="account_info">Cancel</button>
                </div>
            </div>
        </div>

        <div class="row" id="info">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="box">
                    <div class="alert alert-success" id="success" style="display:none;"></div>
                    <h2 class="text-center"> Schedule Information </h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="control-label"> Monday : </label> <?php echo $user_info['monday_text'];?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Tuesday : </label> <?php echo $user_info['tuesday_text'];?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Wednesday : </label> <?php echo $user_info['wednesday_text'];?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Thurdsday : </label> <?php echo $user_info['thursday_text'];?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Friday : </label> <?php echo $user_info['friday_text'];?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Saturday : </label> <?php echo $user_info['saturday_text'];?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Sunday : </label> <?php echo $user_info['sunday_text'];?>
                        </div>
                    </div>       
                </div>
                <div class="box" style="display:none;">
                    <?php                     
                    $attr = array("id"=>"schedule_info");
                    echo form_open('',$attr);?>
                    <div class="alert alert-danger" id="error" style="display:none;"></div>
                    <h2 class="text-center"> Schedule Information </h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="control-label"> Monday :  </label>
                            <select class="form-control input-md" name="monday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select>                             
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Tuesday : </label>
                            <select class="form-control input-md" name="tuesday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select>  
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Wednesday : </label>
                            <select class="form-control input-md" name="wednesday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Thurdsday : </label>
                            <select class="form-control input-md" name="thursday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select> 
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Friday : </label>
                            <select class="form-control input-md" name="friday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select> 
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Saturday : </label>
                            <select class="form-control input-md" name="saturday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select> 
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Sunday : </label>
                            <select class="form-control input-md" name="sunday">
                                <option value="">- Select Time -</option>
                                <?php foreach($schedule_time as $key => $value):?>
                                	<option value="<?php echo $value['id']?>"><?php echo $value['time'];?></option>
                            	<?php endforeach;?>
                            </select> 
                        </div>
                    </div>
                <?php echo form_close();
               		$original_photo = base_url().$user_info['photo'];
                ?>           
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default edit_button" id="schedule_info" user="student">Edit</button>
                <div class="set2" style="display:none;">
                    <button class="btn btn-default save" id="schedule_info" user="student">Save</button>
                    <button class="btn btn-default cancel" id="schedule_info">Cancel</button>
                </div>
            </div>
        </div>
    </div> <!-- container -->
</div> <!-- wrapper -->
      
<!--             <?php 
            echo "<pre>";
            print_r($user_info);
            echo "</pre>";
            ?> -->

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script>
    var photo = "";
    var base_url = "<?php echo base_url();?>index.php";
    var user_info = <?php echo json_encode($user_info);?>;
    console.log(user_info);
    var dd = "<?php echo $birthday;?>";
    var orig_photo = "<?php echo $original_photo;?>";
    $(function() {

    $('#message').hide();
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true, yearRange: '1900:+0',
          dateFormat: 'yy-mm-dd'
        });
        $( "#datepicker" ).datepicker( "setDate",dd);

    });
</script>

<script src="<?php echo base_url();?>assets/js/teacher_profile.js"></script>