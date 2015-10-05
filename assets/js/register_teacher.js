


$( "#register_teacher" ).on("submit",function(e) {

	e.preventDefault();

	var validation_messages = "";
	var validation_messages = validateInputs();

	$("#error").css("display","none");
	$("#success").css("display","none");

	if(validation_messages.length > 0){

		$("#error").css("display","block").html(validation_messages);
		goToByScroll($(".alert-danger").attr("id"));

	}else{

		var f_d =  new FormData(this);
		$("#error").css("display","none").html("");

		$.ajax({
			url 		: url+"register/ajax_submit_teacher",
			type		: "POST",
			data 		: f_d,
			dataType 	: "json",
			cache		: false,
			processData : false,
			contentType : false,
			success : function(sData){
				if(sData.status == false){	
					$("#error").css("display","block").html(sData.message);
					goToByScroll($(".alert-danger").attr("id")); 
				}else{
					$("#success").css("display","block").html(sData.message);
					goToByScroll($(".alert-success").attr("id"));
				}
			}
		});

	}
});


function goToByScroll(id){

	    var id = id.replace("link", "");
	    $('html,body').animate({
	        scrollTop: $("#"+id).offset().top},
	        1500);
}

$("input[name='photo']").on("change",prepareUpload);
$("input[name='resume']").on("change",prepareUpload2);


function prepareUpload(event)
{
	readURL(event.currentTarget);
	photo = event.target.files;
}

function prepareUpload2(event){
	resume = event.target.files;
	console.log(resume);
}


function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_photo').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}

function validateInputs(){

	var upload_photo = "";
	var upload_resume = "";

	var email 				= $("input[name='email']").val();
	var password 			= $("input[name='password']").val();
	var confirm_password 	= $("input[name='confirm_password']").val();
	var first_name 			= $("input[name='first_name']").val();
	var last_name 			= $("input[name='last_name']").val();
	var current_location 	= $("input[name='current_location']").val();
	var gender 				= $("select[name='gender']").val();
	var birthday 			= $("input[name='birthday']").val();
	var occupation 			= $("select[name='occupation']").val();
	var teaching_exp 		= $("input[name='teaching_exp']").val();
	var preferred_location 	= $("input[name='preferred_location']").val();

	if(photo != ""){
		var upload_photo 	= photo;
	}

	if(resume != ""){
		var upload_resume 	= resume[0].name.replace(/^.*\./, '');
	}

	var error_string = "";

	if(email == ""){
		error_string += "<p><b>Email</b> is required.</p>";
	}else{
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    	if(re.test(email) == false){	
    		error_string += "<p><b>Email</b> is not valid.</p>";
    	}
	}

	if(password == ""){
		error_string += "<p><b>Password</b> is required.</p>";
	}else{
		if(password.length < 8){
			error_string += "<p><b>Password</b> must be 8 characters or more.</p>";
		}
	}

	if(confirm_password == ""){
		error_string += "<p><b>Confirm Password</b> is required.</p>";
	}else{
		if(password != confirm_password){
			error_string += "<p><b>Confirm Password</b> does not match <b>Password</b>.</p>";
		}
	}

	if(first_name == ""){
		error_string += "<p><b>First Name</b> is required.</p>";
	}

	if(last_name == ""){
		error_string += "<p><b>Last Name</b> is required.</p>";
	}

	if(current_location == ""){
		error_string += "<p><b>Current Location</b> is required.</p>";
	}

	if(gender == ""){
		error_string += "<p><b>Gender</b> is required.</p>";
	}

	if(birthday == ""){
		error_string += "<p><b>Birthday</b> is required.</p>";
	}

	if(occupation == ""){
		error_string += "<p><b>Occupation</b> is required.</p>";
	}

	if(upload_photo != ""){	
		console.log(upload_photo);
		if(upload_photo[0].type != "image/png" && upload_photo[0].type != "image/jpeg"){
			error_string += "<p><b>Photo</b> type is not valid.</p>";
		}
	}

	if(upload_resume != ""){	
		if(upload_resume != "pdf" && upload_resume != "doc" && upload_resume != "docx"){
			error_string += "<p><b>Resume</b> type is not valid.</p>";
		}
	}

	if(teaching_exp == ""){
		error_string += "<p><b>Teaching Experience</b> is required.</p>";
	}

	if(preferred_location == ""){
		error_string += "<p><b>Preferred Location</b> is required.</p>";
	}

	return error_string;

}
