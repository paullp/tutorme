$(function(){



}).on("click",".appointment_card",function(){
	var id = $(this).attr("data-id");

	if(userType == 2){
		$(".appointment_card_modal .appointment_info").find("tr:eq(0)").css("display","none");
		$(".appointment_card_modal .appointment_info").find("tr:eq(1)").css("display","none");
	}else if(userType == 3){
		$(".appointment_card_modal .appointment_info").find("tr:eq(2)").css("display","none");
		$(".appointment_card_modal .appointment_info").find("tr:eq(3)").css("display","none");		
	}

	$.ajax({
		url : baseUrl + "index.php/home/get_appointment_info",
		data : "id="+id,
		type : "POST",
		dataType : "json",
		success : function(sData){

			$(".buttons td").html("");

			var ai = sData.appointment_info;

			$(".teacher").find("img").attr("src",baseUrl+ai[0].teacher_photo);
			$(".student").find("img").attr("src",baseUrl+ai[0].student_photo);
			$(".teacher div").html(firstLetter(ai[0].teacher_fname)+" "+firstLetter(ai[0].teacher_lname));
			$(".student div").html(firstLetter(ai[0].student_fname)+" "+firstLetter(ai[0].student_lname));
			$(".schedule").html(moment(ai[0].date).format('MMMM D,YYYY'));
			$(".time").html(ai[0].schedule_time);
			$(".place").html(ai[0].place);
			$(".buttons button").attr("data-id",ai[0].id);

			var buttons = "";
			if(userType == 1){

			}else if(userType == 2){

				if(ai[0].status == "PENDING"){

					var clonedRow = $(".button_template").find("button").clone();
					clonedRow.attr({"data-id":id,"id":"APPROVED"}).addClass("general-btn").text("Approve");
					$(".buttons td").append(clonedRow);

					var clonedRow = $(".button_template").find("button").clone();
					clonedRow.attr({"data-id":id,"id":"REJECTED"}).text("Reject");
					$(".buttons td").append(clonedRow);	

				}else if(ai[0].status == "APPROVED"){

					var clonedRow = $(".button_template").find("button").clone();
					clonedRow.attr({"data-id":id,"id":"FINISHED"}).addClass("general-btn").text("Finish");
					$(".buttons td").append(clonedRow);

					var clonedRow = $(".button_template").find("button").clone();
					clonedRow.attr({"data-id":id,"id":"CANCELED"}).text("Cancel");
					$(".buttons td").append(clonedRow);	
				
				}

			}else if(userType == 3){

				var clonedRow = $(".button_template").find("button").clone();
				clonedRow.attr("data-id",id);
				clonedRow.text("Cancel Appointment")
				$(".buttons td").append(clonedRow);
			}

			$('.message_box').html("");

			var am = sData.appoinment_messages;

			var prev = "";
		
			$.each(am,function(key,value){
				
				if(prev != value.user_id){
					var p = "<p><img class='img-responsive img-circle' style='display:inline-block; height:30px;width:30px; margin-right:5px;' src='"+baseUrl+value.photo+"'/><b>"+value.first_name+"</b></p>";
					$('.message_box').append(p);
					prev = value.user_id;
				}
				
				var p = "<p>"+value.message+"</p>";
				$('.message_box').append(p);
				
				last_id = value.id;
				
			});
			
			longPollingMessages(last_id,id);

			$("#scrollable").animate({
				scrollTop: "+="+1000
			},100);

		}

		

	});

});

function longPollingMessages(last_id,id){
	$.ajax({
		url 	: baseUrl + "index.php/home/long_polling_messages",
		data 	: "appointment_id="+id+"&last_id="+last_id,
		async 	: true,
		cache 	: false,
		type 	: "POST",
		dataType: "json",
		success : function(sData){
			
			console.log(sData);
			setTimeout(longPollingMessages(sData.id,sData.appointment_id),1000);
		}
	});
}

    $('#appointment_modal').on('hidden.bs.modal', function () {
          window.alert('hidden event fired!');
    })
    
function firstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


