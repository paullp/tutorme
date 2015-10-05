
$.each($('div#info'), function() {
    var parent = $(this);
    parent.find(".edit_button").click(function(){
        var button = $(this);
        button.css("display","none"); 
        parent.find(".set2").css("display","inline-block");
        parent.find(".box:eq(0)").fadeOut("fast");
        parent.find(".box:eq(1)").fadeIn("slow");

        if(button.attr("id") == "personal_info"){

            if(button.attr("user") == "teacher"){
                parent.find(".input-md:eq(0)").val(user_info.first_name);
                parent.find(".input-md:eq(1)").val(user_info.last_name);
                parent.find(".input-md:eq(2)").val(user_info.gender);
                parent.find(".input-md:eq(3)").val(user_info.birthday);
                parent.find(".input-md:eq(4)").val(user_info.current_location);
                parent.find(".input-md:eq(6)").val(user_info.occupation);
                parent.find(".input-md:eq(7)").val(user_info.teaching_exp);
                parent.find(".input-md:eq(8)").val(user_info.preferred_location);
                parent.find(".input-md:eq(9)").val(user_info.about_me);
            }else if(button.attr("user") == "student"){

                parent.find(".input-md:eq(0)").val(user_info.first_name);
                parent.find(".input-md:eq(1)").val(user_info.last_name);
                parent.find(".input-md:eq(2)").val(user_info.gender);
                parent.find(".input-md:eq(3)").val(user_info.birthday);
                parent.find(".input-md:eq(4)").val(user_info.current_location);
                parent.find(".input-md:eq(6)").val(user_info.native_language);
                parent.find(".input-md:eq(7)").val(user_info.mandarin_level);
                parent.find(".input-md:eq(8)").val(user_info.preferred_location);
                parent.find(".input-md:eq(9)").val(user_info.about_me);                
                parent.find(".input-md:eq(10)").val(user_info.comment_teacher);                
                
            }
        
        }else if(button.attr("id") == "account_info"){
           
           parent.find(".input-md:eq(0)").val(user_info.email);
           parent.find(".input-md:eq(1)").val(user_info.password);
           parent.find(".input-md:eq(2)").val(user_info.password);                
        
        }else if(button.attr("id") == "schedule_info"){

            if(button.attr("user") == "teacher"){
                parent.find("input[type='checkbox']").prop("checked",false);
                var monday = arrayConversion(user_info.monday);
                var tuesday = arrayConversion(user_info.tuesday);
                var wednesday = arrayConversion(user_info.wednesday);
                var thursday = arrayConversion(user_info.thursday);
                var friday = arrayConversion(user_info.friday);
                var saturday = arrayConversion(user_info.saturday);
                var sunday = arrayConversion(user_info.sunday);

                if(monday != ""){
                    $.each(monday,function(key,value){
                         parent.find("input[name='monday[]']:eq("+value+")").prop("checked",true);
                    });
                }

                if(tuesday != ""){
                    $.each(tuesday,function(key,value){
                         parent.find("input[name='tuesday[]']:eq("+value+")").prop("checked",true);
                    });
                }     

                if(wednesday != ""){
                    $.each(wednesday,function(key,value){
                         parent.find("input[name='wednesday[]']:eq("+value+")").prop("checked",true);
                    });
                }

                if(thursday != ""){
                    $.each(thursday,function(key,value){
                         parent.find("input[name='thursday[]']:eq("+value+")").prop("checked",true);
                    });
                }
                
                if(friday != ""){
                    $.each(friday,function(key,value){
                         parent.find("input[name='friday[]']:eq("+value+")").prop("checked",true);
                    });
                }

                if(saturday != ""){
                    $.each(saturday,function(key,value){
                         parent.find("input[name='saturday[]']:eq("+value+")").prop("checked",true);
                    });
                }

                if(sunday != ""){
                    $.each(sunday,function(key,value){
                         parent.find("input[name='sunday[]']:eq("+value+")").prop("checked",true);
                    });
                }
            }else if(button.attr("user") == "student"){
                parent.find("select[name='monday']").val(user_info.monday);
                parent.find("select[name='tuesday']").val(user_info.tuesday);
                parent.find("select[name='wednesday']").val(user_info.wednesday);
                parent.find("select[name='thursday']").val(user_info.thursday);
                parent.find("select[name='friday']").val(user_info.friday);
                parent.find("select[name='saturday']").val(user_info.saturday);
                parent.find("select[name='sunday']").val(user_info.sunday);                 
            }
        }
    });

    parent.find(".save").click(function(){
        var button = $(this);
        var cont = true;
        $.each(parent.find(".input-md"),function(){
            if($(this).attr("name") != "photo" && $(this).attr("name") != "about_me"){     
                if($(this).val() == ""){
                    $(this).css("border-color","red");
                }
            }
        });

        if(cont == true){
            var formData = new FormData();
            if(button.attr("id") == "personal_info"){
               
                if(button.attr("user") == "teacher"){
                    formData.append('first_name', parent.find(".input-md:eq(0)").val());
                    formData.append('last_name', parent.find(".input-md:eq(1)").val());
                    formData.append('gender', parent.find(".input-md:eq(2)").val());
                    formData.append('birthday', parent.find(".input-md:eq(3)").val());
                    formData.append('current_location', parent.find(".input-md:eq(4)").val());
                    formData.append('occupation', parent.find(".input-md:eq(6)").val());
                    formData.append('teaching_exp', parent.find(".input-md:eq(7)").val());
                    formData.append('preferred_location', parent.find(".input-md:eq(8)").val());
                    formData.append('about_me', parent.find(".input-md:eq(9)").val());
                }else if(button.attr("user") == "student"){
                     formData.append("first_name",parent.find(".input-md:eq(0)").val());
                     formData.append("last_name",parent.find(".input-md:eq(1)").val());
                     formData.append("gender",parent.find(".input-md:eq(2)").val());
                     formData.append("birthday",parent.find(".input-md:eq(3)").val());
                     formData.append("current_location",parent.find(".input-md:eq(4)").val());
                     formData.append("native_language",parent.find(".input-md:eq(6)").val());
                     formData.append("mandarin_level",parent.find(".input-md:eq(7)").val());
                     formData.append("preferred_location",parent.find(".input-md:eq(8)").val());
                     formData.append("about_me",parent.find(".input-md:eq(9)").val());
                     formData.append("comment_teacher",parent.find(".input-md:eq(10)").val());                   
                }
            if(parent.find('input[type=file]').val() != ""){
            
                formData.append('photo', parent.find('input[type=file]')[0].files[0]);
            
            }
            }else if(button.attr("id") == "account_info"){

                if(user_info.email != parent.find(".input-md:eq(0)").val()){   
                    formData.append('email', parent.find(".input-md:eq(0)").val());
                }
                formData.append('password', parent.find(".input-md:eq(1)").val());
                formData.append('confirm_password', parent.find(".input-md:eq(2)").val());

            }else if(button.attr("id") == "schedule_info"){

                if(button.attr("user") == "teacher"){              
                    var monday      = [];
                    var tuesday     = [];
                    var wednesday   = [];
                    var thursday    = [];
                    var friday      = [];
                    var saturday    = [];
                    var sunday      = [];
                    
                    parent.find("input[name='monday[]']:checked").each(function(i){
                        monday[i] = $(this).val();
                    });
                    parent.find("input[name='tuesday[]']:checked").each(function(i){
                        tuesday[i] = $(this).val();
                    });
                    parent.find("input[name='wednesday[]']:checked").each(function(i){
                        wednesday[i] = $(this).val();
                    });
                    parent.find("input[name='thursday[]']:checked").each(function(i){
                        thursday[i] = $(this).val();
                    });
                    parent.find("input[name='friday[]']:checked").each(function(i){
                        friday[i] = $(this).val();
                    });
                    parent.find("input[name='saturday[]']:checked").each(function(i){
                        saturday[i] = $(this).val();
                    });
                    parent.find("input[name='sunday[]']:checked").each(function(i){
                        sunday[i] = $(this).val();
                    });
                }else if(button.attr("user") == "student"){
                    var monday      = parent.find("select[name='monday']").val();
                    var tuesday     = parent.find("select[name='tuesday']").val();
                    var wednesday   = parent.find("select[name='wednesday']").val();
                    var thursday    = parent.find("select[name='thursday']").val();
                    var friday      = parent.find("select[name='friday']").val();
                    var saturday    = parent.find("select[name='saturday']").val();
                    var sunday      = parent.find("select[name='sunday']").val();
                }

                formData.append('monday', monday);
                formData.append('tuesday', tuesday);
                formData.append('wednesday', wednesday);
                formData.append('thursday', thursday);
                formData.append('friday', friday);
                formData.append('saturday', saturday);
                formData.append('sunday', sunday);

            }

            $.ajax({
                url: base_url+"/register/edit_user_info/"+user_info.id+"/"+button.attr("user"),
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(sData){
                    console.log(sData);
                    if(sData.status == "failed"){
                        parent.find("#error").css("display","block").html(sData.message);
                    }else{   
                        location.reload();
                    }
                }
            });
        }
    });

    parent.find(".cancel").click(function(){
        $.each(parent.find(".input-md"),function(){
            if($(this).attr("name") != "photo"){     
                if($(this).val() == ""){
                    $(this).css("border-color","#fff");
                }
            }
        });

        parent.find(".set2").css("display","none"); 
        parent.find(".edit_button").css("display","inline-block");
        parent.find(".box:eq(0)").fadeIn("slow");
        parent.find(".box:eq(1)").css("display","none");
        parent.find(".alert").css("display","none"); 
        $('#profile_photo').attr('src', orig_photo);
    });
});

 $("#photo").change(function() {
      readURL(this);
 });

 function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_photo').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function arrayConversion(str){
    if(str != null){
        return str.split(',');
    }else{
        return "false";
    }
}

