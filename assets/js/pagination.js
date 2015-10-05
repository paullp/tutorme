var page_number=0;
var total_page =null;
var sr =0;
var sr_no =0;

function getReport(page_number,teacher,student,status){

  $.ajax({
    url: BASE_URL+"index.php/home/pagination",
    type:"POST",
    dataType: 'json',
    data:'page_number='+page_number+"&teacher="+teacher+"&student="+student+"&status="+status,

    beforeSend: function(){
      $("#progress_bar").css('display','block');
      $("#main_table").css('display','none');
      $("#paginate").css('display','none');
     },
    success:function(data){
      $("#progress_bar").css('display','none');
      $("#main_table").css('display','table');
      $("#paginate").css('display','block');
      if(data){
        window.mydata = data;
        $("#main_table").html("");
        var usertype = USERTYPE;
        rowHead = $("#table_template").find("thead").clone();
        if(usertype == 2){
          rowHead.find("th:eq(2)").remove();
        }else if(usertype == 3){
          rowHead.find("th:eq(3)").remove();
        }
        rowHead.find("th:last").css("text-align","center");
        $("#main_table").append(rowHead);
        total_page= mydata[0].TotalRows;
        $("#total_page").text(total_page);
        
        if(page_number==0){
          $("#previous").prop('disabled', true);
        }
        else{
          $("#previous").prop('disabled', false);
        }

        if(page_number==(total_page-1)){
         $("#next").prop('disabled', true);
        }
        else{
          $("#next").prop('disabled', false);
        }
        $("#page_number").text(page_number+1);
        
        var record_par_page = mydata[0].Rows;

        $.each(record_par_page, function (key, data) {
          rowBody = $("#table_template tbody").find("tr").attr({
            "appointment-id"  : data.id,
            "id"              : "appointment_info",
            "href"            : "#modal-container",
            "data-toggle"     : "modal"
          }).css('cursor','pointer').clone();
          rowBody.find("td:eq(0)").html(data.date);
          rowBody.find("td:eq(1)").html(data.time);
          rowBody.find("td:eq(2)").html(data.teacher_last_name+", "+data.teacher_first_name);
          rowBody.find("td:eq(3)").html(data.student_last_name+", "+data.student_first_name);
          rowBody.find("td:eq(4)").html(data.status);
          rowBody.find("td:eq(5)").html(data.new_message).css("text-align","center");
          
          if(usertype == 2)
          {
            rowBody.find("td:eq(2)").remove();
          }
          else if(usertype == 3)
          {
            rowBody.find("td:eq(3)").remove();
          }

          $("#main_table").append(rowBody);

        });
        $("div#paginate").css("display","block");
      }
      else{
        $("#main_table").html("");
        $("#main_table").append("<tbody><tr><td align='center'>No Results Found!</td></tr></tbody>");
        $("div#paginate").css("display","none");
      }

    }

  });
};