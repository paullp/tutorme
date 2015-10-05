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
        <?php 
        $original_photo = base_url().$user_info['photo'];

            $monday = '';
            $tuesday = '';
            $wednesday = '';
            $thursday = '';
            $friday = '';
            $saturday = '';
            $sunday = '';
            foreach($schedule_time as $key => $value){
                $monday    .= '<label class="checkbox-inline">' . form_checkbox('monday[]', $value['id'], set_checkbox('monday', $value['id'])).$value['time'] . '</label> ';
                $tuesday   .= '<label class="checkbox-inline">' . form_checkbox('tuesday[]', $value['id'], set_checkbox('tuesday', $value['id'])).$value['time'] . '</label> '; 
                $wednesday .= '<label class="checkbox-inline">' . form_checkbox('wednesday[]', $value['id'], set_checkbox('wednesday', $value['id'])).$value['time'] . '</label> ';
                $thursday  .= '<label class="checkbox-inline">' . form_checkbox('thursday[]', $value['id'], set_checkbox('thursday', $value['id'])).$value['time'] . '</label> ';   
                $friday    .= '<label class="checkbox-inline">' . form_checkbox('friday[]', $value['id'], set_checkbox('friday', $value['id'])).$value['time'] . '</label> '; 
                $saturday  .= '<label class="checkbox-inline">' . form_checkbox('saturday[]', $value['id'], set_checkbox('saturday', $value['id'])).$value['time'] . '</label> ';
                $sunday    .= '<label class="checkbox-inline">' . form_checkbox('sunday[]', $value['id'], set_checkbox('sunday', $value['id'])).$value['time'] . '</label> ';  
            }
        ?>
        <div class="row">
            <h2 class="page-header">Teacher Profile</h2>
            <div class="col-lg-12">
                    <img src="<?php echo base_url().$user_info['photo'];?>" class="clip-circle img-responsive" id="profile_photo">
            </div>
            <?php if($usertype == 3):?>
                <div class="col-lg-12 text-center">
                        <a class="btn btn-default" href="<?php echo base_url();?>index.php/register/create_appointment?teacher_id=<?php echo $user_info['id']?>"> Request an Appointment</a >
                </div>
            <?php endif;?>
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
                                <label>Occupation : </label> <?php echo $user_info['occupation'];?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Teaching Experience : </label> <?php echo $user_info['teaching_exp'];?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Preferred Location : </label> <?php echo $user_info['preferred_location'];?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">About Me : </label> <?php echo $user_info['about_me'];?>
                            </div>
                    </div>
                    <div class="col-md-1"></div>  
                </div>
                <?php if($usertype == 1):?>
                <div class="box" style="display:none;">
                    <div class="alert alert-danger" id="error"style="display:none;"></div>
                    <?php
                    $attr = array("id"=>"personal_info"); 
                    echo form_open_multipart("register/edit_user_info/".$user_info['id'],$attr);?>
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
                                <label>Occupation : </label>
                                <select class="form-control input-md" name="occupation">
                                    <option value="">Choose Occupation</option>
                                    <option value="Student">Student</option>
                                    <option value="Full Time Job">Full Time Job</option>
                                    <option value="Part Time Job">Part Time Job</option>
                                    <option value="Unemployed">Unemployed</option>
                                </select> 
                            </div>
                            <div class="form-group">
                                <label class="control-label">Teaching Experience : </label>
                                <textarea class="form-control input-md" name="teaching_exp" maxlength="200" rows="3" cols="50" style="font-family:Arial;"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Preferred Location : </label>
                                <input class="form-control input-md" name="preferred_location" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">About Me : </label> <?php echo $user_info['about_me'];?>
                                <textarea class="form-control input-md" name="about_me" maxlength="200" rows="3" cols="50" style="font-family:Arial;"></textarea>
                            </div>
                    </div>
                    <div class="col-md-1"></div> 
                    <?php echo form_close();?>
                </div>
                <?php endif;?>
            </div>
            <?php if($usertype == 1):?>
            <div class="col-md-2" id="buttons">
                <button class="btn btn-default edit_button" id="personal_info" user="teacher">Edit</button>
                <div class="set2" style="display:none;">
                    <button class="btn btn-default save" id="personal_info" user="teacher">Save</button>
                    <button class="btn btn-default cancel" id="personal_info">Cancel</button>
                </div>
            </div>
            <?php endif;?>
        </div>
        <?php if($usertype == 1):?>
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
            <div class="col-md-2" id="buttons">
                <button class="btn btn-default edit_button" id="account_info" user="teacher">Edit</button>
                <div class="set2" style="display:none;">
                    <button class="btn btn-default save" id="account_info" user="teacher">Save</button>
                    <button class="btn btn-default cancel" id="account_info">Cancel</button>
                </div>
            </div>
        </div>
        <?php endif;?>

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
                <?php if($usertype == 1):?>
                <div class="box" style="display:none;">
                    <?php                     
                    $attr = array("id"=>"schedule_info");
                    echo form_open('',$attr);?>
                    <div class="alert alert-danger" id="error" style="display:none;"></div>
                    <h2 class="text-center"> Schedule Information </h2>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="control-label"> Monday : </label> <?php echo $monday;?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Tuesday : </label> <?php echo $tuesday;?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Wednesday : </label> <?php echo $wednesday;?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Thurdsday : </label> <?php echo $thursday;?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Friday : </label> <?php echo $friday;?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Saturday : </label> <?php echo $saturday;?>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label"> Sunday : </label> <?php echo $sunday;?>
                        </div>
                    </div>
                <?php echo form_close();?>           
                </div>
                <?php endif;?>
            </div>
            <?php if($usertype == 1):?>
            <div class="col-md-2" id="buttons">
                <button class="btn btn-default edit_button" id="schedule_info" user="teacher">Edit</button>
                <div class="set2" style="display:none;">
                    <button class="btn btn-default save" id="schedule_info" user="teacher">Save</button>
                    <button class="btn btn-default cancel" id="schedule_info">Cancel</button>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div> <!-- container -->
</div> <!-- wrapper -->
      
<!--             <?php 
            echo "<pre>";
            print_r($user_info);
            echo "</pre>";
            ?> -->

<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>

<script>
    var photo = "";
    var base_url = "<?php echo base_url();?>index.php";
    var user_info = <?php echo json_encode($user_info);?>;
    var dd = user_info.birthday;
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