$("#register_student").on("submit",function(e){
	
	e.preventDefault();

	var validation_messages = "";
	var validation_messages = validateInputs();

	$("#error").css("display","none");

	if(validation_messages.length > 0){

		$("#error").css("display","block").html(validation_messages);
		goToByScroll($(".alert-danger").attr("id"));

	}else{

		var f_d =  new FormData(this);
		
		$.ajax({
			url 		: url+"register/ajax_submit_student",
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

function prepareUpload(event)
{
	readURL(event.currentTarget);
	photo = event.target.files;
}

function validateInputs(){

	var upload_photo = "";
	var error_string = "";

	var email 				= $("input[name='email']").val();
	var password 			= $("input[name='password']").val();
	var confirm_password 	= $("input[name='confirm_password']").val();
	var last_name 			= $("input[name='last_name']").val();
	var first_name 			= $("input[name='first_name']").val();
	var current_location 	= $("input[name='current_location']").val();
	var gender 				= $("select[name='gender']").val();
	var birthday 			= $("input[name='birthday']").val();
	var native_language 	= $("input[name='native_language']").val();
	var mandarin_level 		= $("select[name='mandarin_level']").val();
	var lesson_frequency 	= $("select[name='lesson_frequency']").val();
	var preferred_location 	= $("input[name='preferred_location']").val();

	if(photo != ""){
		var upload_photo 	= photo;
	}

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

	if(upload_photo != ""){	
		console.log(upload_photo);
		if(upload_photo[0].type != "image/png" && upload_photo[0].type != "image/jpeg"){
			error_string += "<p><b>Photo</b> type is not valid.</p>";
		}
	}

	if(native_language == ""){
		error_string += "<p><b>Native Language</b> is required.</p>";
	}

	if(mandarin_level == ""){
		error_string += "<p><b>Mandarin Level</b> is required.</p>";
	}

	if(lesson_frequency == ""){
		error_string += "<p><b>Lesson Frequency</b> is required.</p>";
	}

	if(preferred_location == ""){
		error_string += "<p><b>Preferred Location</b> is required.</p>";
	}

	return error_string;

}