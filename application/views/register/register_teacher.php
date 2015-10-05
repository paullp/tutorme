    <!-- Page Content -->
    <style>
        .control-label{
            font-size:16px !important;
        }
    .clip-circle {
        background:url(URL-of-image) no-repeat;
        background-size:720px 480px;
        background-position:-160px 0px;
        height:150px;
        width:150px;
        border-radius:50%;
        overflow:hidden;
        margin:auto;
    }

    .error{
        border-color:red;
    }
    </style>
    <?php
        $monday = '';
        $tuesday = '';
        $wednesday = '';
        $thursday = '';
        $friday = '';
        $saturday = '';
        $sunday = '';
        foreach($schedule_time as $st){
            $monday    .= '<label class="checkbox-inline">' . form_checkbox('monday[]', $st->id, set_checkbox('monday', $st->id)).$st->time . '</label> ';
            $tuesday   .= '<label class="checkbox-inline">' . form_checkbox('tuesday[]', $st->id, set_checkbox('tuesday', $st->id)).$st->time . '</label> '; 
            $wednesday .= '<label class="checkbox-inline">' . form_checkbox('wednesday[]', $st->id, set_checkbox('wednesday', $st->id)).$st->time . '</label> ';
            $thursday  .= '<label class="checkbox-inline">' . form_checkbox('thursday[]', $st->id, set_checkbox('thursday', $st->id)).$st->time . '</label> ';   
            $friday    .= '<label class="checkbox-inline">' . form_checkbox('friday[]', $st->id, set_checkbox('friday', $st->id)).$st->time . '</label> '; 
            $saturday  .= '<label class="checkbox-inline">' . form_checkbox('saturday[]', $st->id, set_checkbox('saturday', $st->id)).$st->time . '</label> ';
            $sunday    .= '<label class="checkbox-inline">' . form_checkbox('sunday[]', $st->id, set_checkbox('sunday', $st->id)).$st->time . '</label> ';  
        }
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h2 class="page-header">Register Teacher</h2>

                <div class="alert alert-danger" id="error" style="display:none;"></div>
                <div class="alert alert-success" id="success" style="display:none;"></div>
                <form id="register_teacher" action="" method="post" enctype="multipart/form-data">
                <div class="form">
                <div class="col-md-6">
                    <img src="<?php echo base_url();?>images/system/default-male.jpg" class="clip-circle img-responsive" id="profile_photo">
                    <div class="form-group">
                        <label class="control-label" for="exampleInputPassword1">Email* </label>
                        <input class="form-control input-md" name="email" placeholder="Email" type="text">
                    </div>
                        <div class="form-group">
                            <label class="control-label">Password*</label>
                            <input class="form-control input-md" name="password" placeholder="Password" type="password">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password*</label>
                            <input class="form-control input-md" name="confirm_password" placeholder="Confirm Password" type="password">
                        </div>
                        <div class="form-group">
                            <label class="control-label">First Name*</label>
                            <input class="form-control input-md" name="first_name" placeholder="First Name" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name*</label>
                            <input class="form-control input-md" name="last_name"placeholder="Last Name" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Current Location*</label>
                            <input class="form-control input-md" name="current_location" placeholder="Current Location" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gender*</label><br>
                            <select class="form-control input-md" name="gender">
                                <option value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label class="control-label">Birthday*</label>
                            <input class="form-control input-md" name="birthday"placeholder="Birthday" id="datepicker" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Occupation*</label>
                            <select class="form-control input-md" name="occupation">
                                <option value="">Choose Occupation</option>
                                <option value="Student">Student</option>
                                <option value="Full Time Job">Full Time Job</option>
                                <option value="Part Time Job">Part Time Job</option>
                                <option value="Unemployed">Unemployed</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-6 text-left">
                        <div class="form-group">
                            <label class="control-label">Photo <i>(.png, .jpg, less than 5mb)</i></label>
                            <input class="form-control input-md" name="photo" type="file" id="photo">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Resume <i>(.pdf, .doc, .docx, less than 5mb)</i></label>
                            <input class="form-control input-md" name="resume" type="file">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Teaching Experience*</label>
                            <textarea class="form-control input-md" name="teaching_exp" maxlength="200" rows="3" cols="50" style="font-family:Arial;"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Schedules Per Week</label><br>
                            <table>
                                <tr>
                                    <td><label class="control-label">Monday</label></td>
                                    <td><?php echo $monday;?></td>
                                </tr>                                    
                                <tr>
                                    <td><label class="control-label">Tuesday</label></td>
                                    <td><?php echo $tuesday;?></td>
                                </tr>                                    
                                <tr>
                                    <td><label class="control-label">Wednesday</label></td>
                                    <td><?php echo $wednesday;?></td>
                                </tr>                                   
                                <tr>
                                    <td><label class="control-label">Thursday</label></td>
                                    <td><?php echo $thursday;?></td>
                                </tr>                                  
                                <tr>
                                    <td><label class="control-label">Friday</label></td>
                                    <td><?php echo $friday;?></td>
                                </tr>
                                <tr>
                                    <td><label class="control-label">Saturday</label></td>
                                    <td><?php echo $saturday;?></td>
                                </tr>                                    
                                <tr>
                                    <td><label class="control-label">Sunday</label></td>
                                    <td><?php echo $sunday;?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Preferred Location*</label>
                            <input class="form-control input-md" name="preferred_location" placeholder="Preferred Location" type="text">
                        </div>
                       <div class="form-group">
                            <label class="control-label">About Me</label>
                            <textarea class="form-control input-md" name="about_me" maxlength="200" rows="2" cols="50" style="font-family:Arial;"></textarea>
                        </div>
                        <div class="col-md-12 column" id='progress_bar' style='display:none;'>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" style="width: 100%;">
                                    Please Wait
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default" id="submit_teacher">Submit</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>




<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.2/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script type="application/javascript" src="<?php echo base_url(); ?>assets/js/register_teacher.js"></script>

<script>
    var url = "<?php echo base_url();?>index.php/";

    var photo = "";
    var resume = "";

    var errors = <?php echo $errors;?>;
    $(function() {
        var default_date = $("#datepicker").val();  
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true, yearRange: '1900:+0'
        });
        $( "#datepicker" ).datepicker( "setDate",default_date);
    });
</script>

</body>
</html>