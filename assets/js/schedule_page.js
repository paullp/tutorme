$(function() {

// setInterval(get_news_feed, 1000);

$('#calendar').fullCalendar({
            header: {
                center: 'prev title next'
            },
            defaultDate: date_today,
            allDay: false,
            dayClick: function(date, jsEvent, view, resourceObj) {

                if(user_info.usertype != 2 && user_info.usertype != 1){

                    if(moment(date).format("YYYY-MM-DD") >= date_today){

                        date_picked = moment(date).format("YYYY-MM-DD");

                        $(".create_appointment").find(".modal-title").html("");
                        $(".create_appointment").find(".appointment_time").html("");
                        $(".create_appointment").find(".modal-title").append("Create Appointment for " + moment(date).format("dddd, MMMM D,YYYY"));
                        
                        var day = moment(date).format("dddd");
                        day = day.substring(0, 1).toLowerCase() + day.substring(1);
                        day_time_id = user_info[day];

                        if(schedule_time[day_time_id] != undefined){

                            schedule_for_the_day = day_time_id;
                            $(".create_appointment").find(".appointment_time").html("<span>"+schedule_time[day_time_id].time+"</span>");
                        
                        }else{
                          
                            schedule_for_the_day = "";
                            $(".create_appointment").find(".appointment_time").html("<span>You have no time for this day.</span>");
                        
                        }
                        $(".create_appointment").modal("show");
                    }

                }

            },
            eventClick: function(calEvent, jsEvent, view) {

                // alert('Event: ' + calEvent.id);

                var appointment_info = $(".appointment_info");

                appointment_info.find(".appointment_buttons").css("display","none");

                chosenEvent = calEvent;

                $.each(appointments,function(key,value){
                    if(value.id == calEvent.id){

                        chosen_appointment = value.id;

                        appointment_info.find("#appointment-teacher").html(value.teacher_fname+" "+value.teacher_lname);
                        appointment_info.find("#appointment-student").html(value.student_fname+" "+value.student_lname);
                        appointment_info.find("#appointment-date").html(value.appointment_date);
                        appointment_info.find("#appointment-time").html(value.schedule_time);
                        appointment_info.find("#appointment-place").html(value.place);

                        if(value.status == "PENDING"){
                            if(user_info["usertype"] == 3){
                                appointment_info.find(".cancel-appointment").css("display","block");
                            }else{
                                appointment_info.find(".approve-appointment").css("display","block");        
                                appointment_info.find(".reject-appointment").css("display","block");        
                            }
                        }else if(value.status == "APPROVED"){
                            if(user_info["usertype"] == 3){
                                appointment_info.find(".cancel-appointment").css("display","block");
                            }else{
                                appointment_info.find(".finish-appointment").css("display","block");        
                                appointment_info.find(".cancel-appointment").css("display","block");        
                            }                            
                        }
                    }
                });

                $(".appointment_info").modal("show");

            },
            events: appointments
        });


            
        $('.pop_Teacher').popover({
            placement: 'bottom',
            container: 'body',
            html: true,
            content: function () {
                
                var teacher_id = $(this).find("span").attr("data-id");
                
                $.each($(".teacher_selection"),function(){
                        $(this).removeAttr("picked");
                        $(this).css("background-color","white");
                });

                $(".teacher_selection[data-id='"+teacher_id+"']").trigger("click");


                return $('.popper-content').html();
            }
        });

        

}).on("click",".appointment_buttons",function(){

    var status          = $(this).attr("id");
    var appointment_id  = chosen_appointment;

    $.ajax({

        url     : base_url+"home/edit_appointment_status",
        type    : "POST",
        dataType: "json",
        data    : {
            "status"            : status,
            "appointment_id"    : appointment_id
        },
        success : function(sData){


            chosenEvent.color = sData.appointment_info[0].color;

            $.each(appointments,function(key,value){
                if(value.id == sData.appointment_info[0].id){
                    appointments[key] = sData.appointment_info[0];
                }
            });

            $('#calendar').fullCalendar('updateEvent', chosenEvent);
            $('.appointment_info').modal("hide");

        }
    });

}).on("click",".fc-button",function(){

	$('#calendar').fullCalendar( 'removeEvents');

	var date = $('#calendar').fullCalendar('getDate');

	$.ajax({
		url 		: base_url+"home/get_appointments_for_calendar",
		type 		: "POST",
		dataType 	: "json",
		data 		: "date="+date.format("YYYY-M-DD"),
		success 	: function(sData){
			if(sData.status == true){

                var status = $(".filter_appointments").val();

                appointments = sData.appointments; 



                var filtered_appointments = [];

                if(status != ""){

                    $.each(appointments,function(key,value){
                        if(value.status == status){
                            filtered_appointments.push(value);
                        }
                    });
                }else{
                    filtered_appointments = appointments
                }

                $('#calendar').fullCalendar('addEventSource', filtered_appointments);         
                $('#calendar').fullCalendar('rerenderEvents');

			}
		}
	});
}).on("click",".teacher_selection",function(){

    var teacher =  $(this);
    
    $.each($(".popover-content").find(".teacher_selection"),function(){
            $(this).removeAttr("picked");
            $(this).css("background-color","white");
    });

    if(teacher.attr("picked") == undefined){
        teacher.attr("picked","");
        teacher.css("background-color","#75FF47");
        $(".pop_Teacher").html("<span data-id='"+teacher.attr("data-id")+"'>"+teacher.find("p").text()+"</span>");
    }

    if($(".popover").length>0){
        $(".pop_Teacher").popover("hide");
    }

    validate_appointment_time(teacher.attr("data-id"));

}).on("change",".filter_appointments",function(){

    $('#calendar').fullCalendar( 'removeEvents');

    var status      = $(".filter_appointments[id='status']").val();
    var teacher_id  = $(".filter_appointments[id='teacher']").val();

    var filtered_appointments = [];

    var temp = appointments;

    if(status != ""){
        $.each(temp,function(key,value){
            if(value.status == status){
                filtered_appointments.push(value);
            }
        });
        temp = filtered_appointments;
    };



    if(teacher_id != ""){
        $.each(temp,function(key,value){
            if(value.teacher_id == teacher_id){
                filtered_appointments.push(value);
            }
        });
        temp = filtered_appointments
    };

    $('#calendar').fullCalendar('addEventSource', temp);         
    $('#calendar').fullCalendar('rerenderEvents');

});


$('.create_appointment').on('hidden.bs.modal', function (e) {
    $(".create_appointment").find(".pop_Teacher").text("Click To Select Teacher");
    $(".create_appointment").find(".alert-danger").css("display","none").html("");
    $(".create_appointment").find("input[name='place']").val("");
    $(".create_appointment").find("textarea[name='message']").val("");

    $(".pop_Teacher").popover("hide");
});

$(".send_request").click(function(){

    var modal = $(this).closest(".modal-content");
    var validate_request = validation(modal);

    modal.find(".alert-danger").css("display","none");

    if(validate_request.length > 0){

        modal.find(".alert-danger").css("display","block").html(validate_request);

    }else{

        var teacher_id      = modal.find(".pop_Teacher span").attr("data-id");
        var schedule_id     = modal.find(".appointment_time span").attr("schedule_id");
        var place           = modal.find("input[name='place']").val();
        var message         = modal.find("textarea[name='message']").val();

        $.ajax({
            url         : base_url+"register/request_appointment",
            type        : "POST",
            dataType    : "json",
            data        : {
                "teacher_id"    : teacher_id,
                "time"          : schedule_id,
                "place"         : place,
                "message"       : message,
                "date"          : date_picked
            },
            success : function(sData){

                appointments.push(sData.appointment_info[0]);
                $('#calendar').fullCalendar('addEventSource', sData.appointment_info);         
                $('#calendar').fullCalendar('rerenderEvents');                
                $('.create_appointment').modal("hide");
                
            }
        });

    }

});


function validation(modal){

    var errors = "";

    if(modal.find(".pop_Teacher span").attr("data-id") == undefined){
        errors += "<p>Please Select a Teacher</p>";
    }

    if(modal.find(".appointment_time .error").length > 0){
        errors += "<p>There is an error.</p>";
    }

    if(modal.find("input[name='place']").val() == ""){
        errors += "<p>Place is required.</p>";
    }

    if(modal.find("textarea[name='message']").val() == ""){
        errors += "<p>Message is required.</p>";
    }

    return errors;

}


function validate_appointment_time(teacher_id){

    $.ajax({

        url     : base_url+"home/validate_appointment",
        type    : "POST",
        dataType: "json",
        data    : {
            "id"           : teacher_id,
            "date_picked"  : date_picked,
            "schedule_id"  : schedule_for_the_day
        },
        success : function(sData){
            if(sData.status == false){
                if(sData.message == undefined){
                    $(".create_appointment").find(".appointment_time").html("<span class='error' style='color:red;font-weight:bold;'>There is an existing request for this time.<Br>"+schedule_time[day_time_id].time+"</span>");
                }else{
                    $(".create_appointment").find(".appointment_time").html("<span class='error' style='color:red;font-weight:bold;'>"+sData.message+"</span>").data("errors","");
                }   
            }else{
                $(".create_appointment").find(".appointment_time span").css({
                    "color" : "green",
                    "font-weight" : "bold"
                }).html(schedule_time[day_time_id].time).attr("schedule_id",day_time_id);
            }
        }
    });

}


function get_news_feed(){

    $.ajax({
        url         : base_url+"home/get_news_feed",
        type        : "POST",
        dataType    : "json",
        success     : function(sData){
            console.log(sData);
        }
    });

}