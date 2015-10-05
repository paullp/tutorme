<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('register/register_model','register');

		$this->check_session();
	}
	
	public function index()
	{
		$session_data = $this->session->userdata('logged_in');

		if($session_data["usertype"] == 1)//ADMIN
		{
			$this->appointments();
		}
		else if($session_data["usertype"] == 2 || $session_data["usertype"] == 3)//TEACHER
		{
			$this->my_schedule();
		}

	}
	
	function my_schedule()
	{
		
		$session_data = $this->session->userdata('logged_in');

		$data['teachers'] = $this->list_model->dropdown_user(2,"array");
		$data["schedule_time"] = $this->list_model->schedule_time("array");
		$data['days_array'] = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");
		$data['appointments'] = $this->list_model->get_appointments($session_data["id"],$session_data['usertype']);
		
		$page_info = array(
			"page" => "schedule",
			"data" => $data
		);

		$this->render($page_info);

	}
	
	function my_profile()
	{
		$id = "";
		$session_data = $this->session->userdata('logged_in');
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];
		}
		else
		{
			$id = $session_data["id"];
		}
		$data["id"] = $id;
		$data["name"] = $session_data["fullname"];
		$data["usertype"] = $session_data["usertype"];
		$data["schedule_time"] = $this->list_model->schedule_time("array");
		$data["review_count"] = $this->list_model->review_count($id);
		$this->load->view("menu/menu",$data);
		//for edit
		$edit_profile = false;
		if(isset($_GET["edit_profile"])){
			$edit_profile = true;
		}
		$data["edit_profile"] = $edit_profile;
		//if ADMIN
		$user_info = $this->list_model->get_user_info($id,$data["usertype"]);
		$days_array = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");

		foreach($data['schedule_time'] as $key => $value){
			$sched[$key] = $value['time'];
		}

		foreach($user_info as $key => $value){
			$string = "";
			if(in_array($key, $days_array)){
				if($value != NULL){
					$test = explode(",",$value);
					foreach($test as $key2 => $val){
						if(array_key_exists($val,$sched)){
							$string .= $sched[$val].", ";
						}
					}
					$string = rtrim($string, ", ");
				}else{
					$string = "-";
				}
				$user_info[$key."_text"] = $string;
			}
		}

		$data['user_info'] = $user_info;

		$view_profile = "";

		if(isset($_GET["view_profile"])){
			$view_profile = $_GET["view_profile"];
		}
		if($this->session->userdata('logged_in')){
			if($session_data["usertype"] == 2 or $view_profile == "teacher")
			{
				$this->load->view("teacher/teacher_profile",$data);
			}
			else if($session_data["usertype"] == 3 or $view_profile == "student")
			{
				$this->load->view("student/student_profile",$data);
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	function appointments()
	{
		$session_data = $this->session->userdata('logged_in');

		$start_of_month = date("Y-m-1");
		$end_of_month = date("Y-m-t");

		$data["appointments"] = $this->list_model->get_appointments($session_data["id"],$session_data["usertype"],"",$start_of_month,$end_of_month);

		$data["teachers"] = $this->list_model->dropdown_user(2,"array");
		$data["student"] = $this->list_model->dropdown_user(3,"array");

		$page_info = array(
			"page" => "appointments",
			"data" => $data
		);

		$this->render($page_info);

	}

	function test_page(){
		$this->load->view('test_pagination');
	}

    function pagination(){
    	$session_data = $this->session->userdata('logged_in');
    	
    	$id = $session_data["id"];
    	$usertype = $session_data["usertype"];
    	$teacher = $this->input->post('teacher');
    	$student = $this->input->post('student');
    	$status = $this->input->post('status');

        $page_number = $this->input->post('page_number');
        $item_per_page = 5;
        $position = ($page_number*$item_per_page);
        $result_set = $this->list_model->appointments_pagination($id,$usertype,$status,$item_per_page,$position,$teacher,$student);
        $total_set =  count($result_set);
        $total =  $this->list_model->appointment_pagination_count($id,$usertype,$status,$teacher,$student);
        $total = ceil($total/$item_per_page);
        if($total_set>0){
            $entries = null;
            foreach($result_set as $row){
                 $entries[] = $row;
            }
            $data = array(
                'TotalRows' => $total,
                'Rows' => $entries
            );              
            $this->output->set_content_type('application/json');
            echo json_encode(array($data));
        }
        exit;
   }
	 
	function teacher_list()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in'))
		{		
			$this->session->set_flashdata('item', 2);
			$data['flash_message'] = $this->session->flashdata('message');
			$teacher_id = "";
			$data["name"] = $session_data["fullname"];
			$data["usertype"] = $session_data["usertype"];
			
			//PAGINATION FOR TEACHER LIST

			$config = array();
			$config["base_url"] = base_url() . "index.php/home/teacher_list";
			$config["total_rows"] = $this->list_model->count_user(2);
			$config["per_page"] = 5;
			$config["uri_segment"] = 3;		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["teacher_list"] = $this->list_model->teacher_list($teacher_id,$config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data["total_rows"] = $config["total_rows"];
			$data["per_page"] = $config["per_page"];

			// echo "<pre>";
			// print_r($data['teacher_list']);
			// exit;
			//PAGINATION FOR TEACHER LIST
			
			$data["schedule_time"] =$this->list_model->schedule_time();

			$this->load->view("menu/menu",$data);
			$this->load->view("teacher_list",$data);	
		}	
		else
		{
			redirect('login', 'refresh');
		}		
	}
	
	function student_list()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in'))
		{
			$data["name"] = $session_data["fullname"];
			$data["usertype"] = $session_data["usertype"];
			if(isset($_GET["status"]) and $session_data["usertype"] == 1)
			{
				$status = $_GET["status"];
				$data["status"] = $_GET["status"];
			}
			else
			{
				$status = 0;
				$data["status"] = "0";
				if($session_data["usertype"] == 2)
				{
					$data["review_count"] = $this->list_model->review_count($session_data["id"]);
				}
			}
				
			$student_id = "";
			$config = array();
			$config["base_url"] = base_url() . "index.php/home/student_list";
			$config["total_rows"] = $this->list_model->count_user(3);
			$config["per_page"] = 5;
			$config["uri_segment"] = 3;		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["student_list"] = $this->list_model->student_list($student_id,$config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data["total_rows"] = $config["total_rows"];
			$data["per_page"] = $config["per_page"];
			 // print_r($data['student_list']);exit;
			$this->load->view("menu/menu",$data);
			$this->load->view("student_list",$data);
		}	
		else
		{
			redirect('login', 'refresh');
		}		
	}

	function set_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		$data["name"] = $session_data["fullname"];
		$data["usertype"] = $session_data["usertype"];
		$teacher_id = $_GET["id"];
		
		if($session_data["usertype"] == 3)
		{
			$data["teacher_profile"] = $this->list_model->teacher_list($teacher_id,1,1);
		}
		$data["schedule_time"] = $this->list_model->schedule_time();
		$data["schedule"] = $this->list_model->get_schedule($session_data["id"]);
		$this->load->view("menu/menu",$data);
		$this->load->view("student/send_message",$data);
	}
	
	function send_message_exec()
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $_POST["appointment_id"];
		if($_POST["message"]!=NULL or $_POST["message"] != "")
		{
			$message = $_POST["message"];
			$data = array(
				'created_on' => date('Y/m/d H:i:s'),
				'appointment_id' => $id,
				'user_id' => $session_data["id"],
				'message' => $message,
				'status' => "NEW"
		);
			$this->message_model->send_message($data);
		}
		$info = $this->list_model->appointment_data($id,$session_data["usertype"]);
		if($session_data["usertype"] == 2)
		{
			$this->sendMail(4,$info);
		}
		else if($session_data["usertype"] == 3)
		{
			$this->sendMail(3,$info);
		}
		else
		{
			$this->sendMail(12,$info);
			$this->sendMail(13,$info);
		}
		redirect("home/appointment_messages?id=$id", 'refresh');
	}

	function reviews()
	{
		$session_data = $this->session->userdata('logged_in');
		if(isset($_GET["id"]))
		{
			$data["review_id"] = $_GET["id"];
			$data["review"] = $this->list_model->load_review($data["review_id"]);
		}
		else
		{
			$data["review_id"] = NULL;
			$data["past_teacher"] = $this->list_model->past_teacher($session_data["id"]);
			$data["reviews"] = $this->list_model->review($session_data["id"]);
		}
		
		$data["name"] = $session_data["fullname"];
		$data["usertype"] = $session_data["usertype"];
		
		$this->load->view("menu/menu",$data);
		$this->load->view("reviews",$data);
	}
	
	function submit_review()
	{
		$session_data = $this->session->userdata('logged_in');
		if(isset($_POST["review_id"]))
		{
			$review_id = $_POST["review_id"];
		}
		else
		{
			$review_id = NULL;
			$teacher_id = $_POST["teacher"];
		}
		$quality = $_POST["quality"];
		$preparation = $_POST["preparation"];
		$english_ability = $_POST["english_ability"];
		$friendliness = $_POST["friendliness"];
		$punctuality = $_POST["punctuality"];
		$comment = $_POST["comment"];
		$recommendation = $_POST["recommendation"];
		if(isset($_POST["review_id"]))
		{
		$data = array(
			"date_updated" => date('Y/m/d H:i:s'),
			"quality" => $quality,
			"preparation" => $preparation,
			"english_ability" => $english_ability,
			"friendliness" => $friendliness,
			"punctuality" => $punctuality,
			"comment" => $comment,
			"recommendation" => $recommendation,
		);		
		}
		else
		{
		$data = array(
			"date_created" => date('Y/m/d H:i:s'),
			"date_updated" => date('Y/m/d H:i:s'),
			"teacher_id" => $teacher_id,
			"student_id" => $session_data["id"],
			"quality" => $quality,
			"preparation" => $preparation,
			"english_ability" => $english_ability,
			"friendliness" => $friendliness,
			"punctuality" => $punctuality,
			"comment" => $comment,
			"recommendation" => $recommendation,
			"active" => 1,
		);
		}
		$this->list_model->save_review($data,$review_id);
		redirect('home/reviews', 'refresh');
	}
	
	function my_reviews()
	{
		$session_data = $this->session->userdata('logged_in');
		$data["name"] = $session_data["fullname"];
		$data["usertype"] = $session_data["usertype"];
		
		if($data["usertype"] == 2)//teacher
		{
			$id = $session_data["id"];
			$edit = array("seen" => TRUE,);
			$this->list_model->review_edit($edit,$id);
		}
		else//student and admin
		{
			$id = $_GET["id"];
		}
		$data["my_reviews"] = $this->list_model->my_reviews($id);
		$data["review_count"] = $this->list_model->review_count($id);
		
		
		$total = $this->list_model->get_count_reviews($id);
		$data["overall_rating"] = $this->list_model->overall_rating($id,$total);
		$this->load->view("menu/menu",$data);
		$this->load->view("my_reviews",$data);
	}

	
	function export_excel()
	{
		$session_data = $this->session->userdata('logged_in');
		$data = array();
		$name="";
		
		if(isset($_GET["type"]))
		{
			if($_GET["type"] == 2)
			{
				$name = "teacher_list";
			}
			else if($_GET["type"] == 3)
			{
				$name = "student_list";
			}
			$user = $this->list_model->user($_GET["type"]);
			
			foreach($user as $u)
			{
				$column1 = $_GET["type"] == 2?"Occupation":"Mandarin Level";
				$column2 = $_GET["type"] == 2?"Teaching Experience":"Native Language";
				$data1 = $_GET["type"] == 2?$u->occupation:$u->mandarin_level;
				$data2 = $_GET["type"] == 2?$u->teaching_exp:$u->native_language;
				$active = $u->active == TRUE?"Active":"Inactive";
				array_push($data, array("Last Name" => $u->last_name, 
						"First Name" => $u->first_name, 
						"Email" => $u->email, 
						"Gender" => $u->gender, 
						"Location" => $u->current_location, 
						"Birthday" => $u->birthday,
						$column1 => $data1,
						$column2 => $data2,
						"Status" => $active,
						)
				);
			}
		}
		else
		{
			$name = "appointments_list";
			$status = "0";
			if(isset($_POST["status"]))
			{
				$status = $_POST["status"];
			}
			$appointment_list = $this->list_model->check_appointments($session_data['id'],$session_data["usertype"],$status);
			foreach($appointment_list as $al)
			{
				array_push($data, array("Teacher" => $al->teacher_last_name .",". $al->teacher_first_name,
								"Student" => $al->student_last_name .",". $al->student_first_name,
								"Date" => $al->appointment_date,
								"Time" => $al->appointment_time,
								"Place" => $al->place,
								"Comment" => $al->comment,
								"Status" => $al->status,
						)
				);
			}
		}
		
		
		header("Content-Type: text/plain");

		function cleanData(&$str)
		{
			$str = preg_replace("/\t/", "\\t", $str);
			$str = preg_replace("/\r?\n/", "\\n", $str);
			if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
		}
		
		$filename = $name . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");

		$flag = false;
		foreach($data as $row) {
			if(!$flag) {
			//display field/column names as first row
			echo implode("\t", array_keys($row)) . "\r\n";
			$flag = true;
		}
		array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\r\n";
		}
		exit;
	}
	
	function review_count()
	{
		$session_data = $this->session->userdata('logged_in');
		if(isset($_GET["status"]) and $session_data["usertype"] == 1)
		{
			$status = $_GET["status"];
			$data["status"] = $_GET["status"];
		}
		else
		{
			$status = 0;
			$data["status"] = "0";
			if($session_data["usertype"] == 2)
			{
				return $this->list_model->review_count($session_data["id"]);
			}
		}
	}
	
	function edit_sched()
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data["id"];
		
		$d = $this->input->post();

		$this->schedule_model->edit_schedule($d,$id);
		$return['user_info'] = $this->list_model->get_user_info($id);
		echo json_encode($return);
	}
	
	function edit_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		
		$appointment_id = $_POST["appointment_id"];
		
		$schedule_date = $_POST["schedule_date"];
		$previous_date = $_POST["previous_date"];
		
		$schedule_time_id = $_POST["schedule_time_id"];
		$schedule_time = $_POST["schedule_time"];
		
		$previous_time_id = $_POST["previous_time_id"];
		$previous_time = $_POST["previous_time"];
		
		$place = $_POST["place"];
		$previous_place = $_POST["previous_place"];
		
		$insert_comment = "";
		$changed = false;
		
		if($previous_date != $schedule_date)
		{
			$insert_comment = $insert_comment . "Date changed : $previous_date => $schedule_date</br>";
			$changed = true;
		}
		
		if($previous_time != $schedule_time)
		{
			$insert_comment = $insert_comment . "Time changed : $previous_time => $schedule_time</br>";
			$changed = true;
		}
		
		if($previous_place != $place)
		{
			$insert_comment = $insert_comment . "Place changed : $previous_place => $place";
			$changed = true;
		}
		
		if($changed == true)
		{
			$insert_comment = "Date edited : ". date('m/d/Y H:i:s'). "</br>" . $insert_comment;
			$data = array(
				"date" => date("Y-m-d", strtotime($schedule_date)),
				"time" => $schedule_time_id,
				"place" => $place
			);
			$this->schedule_model->edit_appointment($appointment_id,$data);
		}
		
		if($insert_comment != "")
		{
			$data = array(
				"created_on" => date('Y/m/d H:i:s'),
				"appointment_id" => $appointment_id,
				"user_id" => $session_data["id"],
				"message" => $insert_comment,
				"status" => "NEW"
			);
			$this->schedule_model->appointment_messages($data);
			$info = $this->list_model->appointment_data($appointment_id,$session_data["usertype"]);
			$this->sendMail(9,$info);
		}
		
		redirect('home/appointment_messages?id='.$appointment_id, 'refresh');
	}
	
	function appointment_messages()
	{
		$session_data = $this->session->userdata('logged_in');
		$data["name"] = $session_data["fullname"];
		$data["usertype"] = $session_data["usertype"];
		$data["id"] = $session_data["id"];
		$data["review_count"] = $this->list_model->review_count($session_data["id"]);
		
		$this->load->view("menu/menu",$data);
		$id = $_GET["id"];
		$data["appointment_id"] = $_GET["id"];
		
		$data["edit"] = false;
		if(isset($_GET["action"]) and $_GET["action"] == true)
		{
			$data["edit"] = true;
		}
		
		//change comment new to read
		if($session_data["usertype"] != 1)
		{
			$arr = array(
				"status" => "READ"
			);
			$this->schedule_model->change_comment_status($session_data["id"],$_GET["id"],$arr);
		}
		
		//appointment information
		$data["schedule_time"] = $this->list_model->schedule_time();
		$data["schedule"] = $this->list_model->get_schedule($session_data["id"]);
		$data["appointment_info"] = $this->list_model->appointment_info($id,$session_data["usertype"]);
		$this->load->view("appointment_info",$data);
		
		//appointment messages
		$data["appointment_messages"] = $this->list_model->appointment_messages($id);
		$this->load->view("appointment_messages",$data);
	}
	
	function edit_appointment_status(){

		$session_data = $this->session->userdata("logged_in");

		$d = $this->input->post();

		$id 		 	= $d['appointment_id'];
		$data['status'] = $d['status'];

		$this->schedule_model->change_appointment_status($id,$data);

		$data = array(
			"created_on" => date('Y/m/d H:i:s'),
			"appointment_id" => $id,
			"user_id" => $session_data["id"],
			"message" => $data['status']." Date : ". date('m/d/Y'),
			"status" => "NEW"
		);

		$this->schedule_model->appointment_messages($data);

		$return['appointment_info'] = $this->list_model->get_appointments('','',$id);


		echo json_encode($return);

	}

	function edit_status_appointment()
	{
		$session_data = $this->session->userdata("logged_in");
		$data = $this->input->post();

		$id = $data['id'];
		unset($data['id']);
		$this->schedule_model->change_appointment_status($id,$data);

	
		$data = array(
			"created_on" => date('Y/m/d H:i:s'),
			"appointment_id" => $id,
			"user_id" => $session_data["id"],
			"message" => $data['status']." Date : ". date('m/d/Y'),
			"status" => "NEW"
		);
		$this->schedule_model->appointment_messages($data);
		
		$info = $this->list_model->appointment_data($id,$session_data["usertype"]);
		$this->sendMail(6,$info);
		$this->session->set_flashdata('msg', 'Appointment Approved!');
		redirect('home/appointments', 'refresh');
	}
	
	function reject_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		$data = array(
			"status" => "REJECTED"
		);
		$this->schedule_model->change_appointment_status($_GET["id"],$data);
		
		$data = array(
			"created_on" => date('Y/m/d H:i:s'),
			"appointment_id" => $_GET["id"],
			"user_id" => $session_data["id"],
			"message" => "Date Rejected : ". date('m/d/Y'),
			"status" => "NEW"
		);
		$this->schedule_model->appointment_messages($data);
		
		$info = $this->list_model->appointment_data($_GET["id"],$session_data["usertype"]);
		$this->sendMail(7,$info);
		$this->session->set_flashdata('msg', 'Appointment Rejected!');
		redirect('home/appointments', 'refresh');		
	}
	
	function finished_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		$data = array(
			"status" => "FINISHED"
		);
		$this->schedule_model->change_appointment_status($_GET["id"],$data);
		
		$data = array(
			"created_on" => date('Y/m/d H:i:s'),
			"appointment_id" => $_GET["id"],
			"user_id" => $session_data["id"],
			"message" => "Date Finished : ". date('m/d/Y'),
			"status" => "NEW"
		);
		$this->schedule_model->appointment_messages($data);
		
		$info = $this->list_model->appointment_data($_GET["id"],$session_data["usertype"]);
		$this->sendMail(14,$info);
		$this->session->set_flashdata('msg', 'Appointment Finished!');
		redirect('home/appointments', 'refresh');		
	}
	
	function cancel_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		$data = array(
			"status" => "CANCELLED"
		);
		$this->schedule_model->change_appointment_status($_GET["id"],$data);
		
		$data = array(
			"created_on" => date('Y/m/d H:i:s'),
			"appointment_id" => $_GET["id"],
			"user_id" => $session_data["id"],
			"message" => "Date CANCELLED : ". date('m/d/Y'),
			"status" => "NEW"
		);
		$this->schedule_model->appointment_messages($data);
		
		$info = $this->list_model->appointment_data($_GET["id"],$session_data["usertype"]);
		
		if($session_data["usertype"] == 2)
		{
			$this->sendMail(8,$info);
		}
		else if($session_data["usertype"] == 3)
		{
			$this->sendMail(11,$info);
		}
		$this->session->set_flashdata('msg', 'Appointment Cancelled!');
		redirect('home/appointments', 'refresh');		
	}
	
	function delete_comment()
	{
		$id = $_GET["id"];
		$appointment_id = $_GET["appointment_id"];
				$data = array(
			"status" => "DELETED"
		);
		$this->schedule_model->delete_comment($id,$data);
		redirect('home/appointment_messages?id='.$appointment_id, 'refresh');
	}
	
	function delete_review()
	{
		$id = $_GET["id"];
		echo $id;
		$teacher_id = $_GET["teacher_id"];
		$data = array(
			"active" => 0
		);
		$this->list_model->delete_review($id,$data);
		redirect('home/my_reviews?id='.$teacher_id, 'refresh');
		
	}
	
	function delete_teacher()
	{
		$id = $_GET["id"];
		$data = array(
			"active" => 0
		);
		$this->list_model->delete_teacher($id,$data);
		redirect('home/teacher_list', 'refresh');		
	}

	function appointments_fullcalendar()
	{
		if(isset($_POST["set_date"]))
		{$data["set_date"] = $_POST["set_date"];}
		else
		{$data["set_date"] = date("Y-m-d");}
		$this->load->view('full_calendar',$data);
	}
	
	function json_appointments()
	{
		$session_data = $this->session->userdata('logged_in');
		if(isset($_POST["status"]))
		{$status = $_POST["status"];}
		else
		{$status = "";}
		$appointments = $this->list_model->get_appointments_json($session_data["id"],$session_data["usertype"],$status);
			$events = array();
			foreach($appointments as $row) {

			$time = explode("-",$row->time);
			$start_time = date("H:i:s", strtotime($time[0]));
			$end_time = date("H:i:s", strtotime($time[1]));			
			
			$start = $row->date."T".$start_time;
			$end = $row->date."T".$end_time;

			$e = array();
			
			$e['id'] = $row->appointment_id;
			$e['title'] = $row->status."\nT:".$row->teacher_last_name.",".$row->teacher_first_name."\nS:".$row->student_last_name.",".$row->student_first_name."\nPlace:".$row->place;
			$e['start'] = $start;
			$e['end'] = $end;
			
			if($row->status == "PENDING")
			{
				$e['color'] = "Blue";
			}
			elseif($row->status == "FINISHED")
			{
				$e['color'] = "Grey";
			}
			elseif($row->status == "CANCELLED")
			{
				$e['color'] = "Red";
			}
			elseif($row->status == "APPROVED")
			{
				$e['color'] = "Green";
			}
			elseif($row->status == "REJECTED")
			{
				$e['color'] = "Black";
			}
			$e['url'] = "appointment_messages?id=$row->appointment_id";
			$e['allDay'] = false;
			array_push($events, $e);
		}

		echo json_encode($events);
		exit();
	}
	
	function appointment_messages_by_id()
	{
		$id = $this->input->post("appointment_id");
		$info = $this->list_model->appointment_info($id);
		$messages = $this->message_model->get_messages_by_appointment_id($id);
		
		$data['info'] 		= $info;
		$data['messages'] 	= $messages;
		echo json_encode($data);
	}

	function get_teacher_schedule()
	{
		$id = $this->input->post("teacher_id");
		$teacher_sched 	= $this->list_model->schedule($id,'array');
		$sched_time 	= $this->list_model->schedule_time('array');
		$time_array 	= array();
		$arrange_array 	= array();
		foreach($teacher_sched as $key=>$value){
			foreach($value as $key2 => $value2){
				if($key2 != 'id' and $key2 != 'user_id'){
					$time_array=explode(",", $value2);
					
					foreach($time_array as $x => $y){
						foreach($sched_time as $k=>$v)
						{
							if($k == $y){
								$arrange_array[strtoupper($key2)][] = $v['time'];
							}
						}
					}
				}
			}
		}
		echo json_encode($arrange_array);
	}

	function edit_scheule(){
		$data = $this->input->post();

		$schedule = array();
			
		$id = $data['id'];
		unset($data['id']);

		foreach($data as $key => $value){
			$schedule[$key] = implode(",",$value);
		}	

		$this->list_model->edit_profile($id,$schedule);
		redirect('home/my_schedule','refresh');
	}

	function get_appointment_info(){

		$appointment_id = $this->input->post("id");
		$appointment_info = $this->list_model->get_appointments("","",$appointment_id);

		$messages = $this->list_model->appointment_messages($appointment_id);

		$return["appointment_info"] 	= $appointment_info;
		$return["appoinment_messages"] 	= $messages;

		

		echo json_encode($return);

	}

	public function long_polling_messages(){

		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];

		$appointment_id = $this->input->post("appointment_id");
		$last_id   		= $this->input->post("last_id");
		$result 		= $this->message_model->getAppointmentMessage($appointment_id,$id);
		$latest_id 		= $result['id'];

		while($last_id == $latest_id){
			usleep(1000);
			clearstatcache();
			$result 		= $this->message_model->getAppointmentMessage($appointment_id,$id);
			$latest_id 		= $result['id'];
		}

		
		echo json_encode($result);

	}

	public function get_appointments_for_calendar(){

		$session_data = $this->session->userdata('logged_in');

		$start_of_month 	= date("Y-m-d",strtotime($this->input->post("date")));
		$end_of_month 		= date("Y-m-t",strtotime($start_of_month));

		$get_appointments = $this->list_model->get_appointments($session_data["id"],$session_data['usertype'],'',$start_of_month,$end_of_month);


		$return = array();

		if(count($get_appointments) > 0){

			$return['status'] 		= true;
			$return['appointments']	= $get_appointments;

		}else{

			$return['status'] = false;

		}

		echo json_encode($return);

	}

	public function validate_appointment(){

		$session_data = $this->session->userdata('logged_in');

		$d = $this->input->post();

		$return = array();

		if($d['schedule_id'] != ""){	
			$valid = $this->list_model->check_appointment_validity($session_data['id'],$d['id'],$d['date_picked'],$d['schedule_id']);

			if($valid == false){
				$return['status'] = false;
			}else{
				$return['status'] = true;
			}
		}else{
			$return['status'] 	= false;
			$return['message'] 	= "You have no time for this day.<br>Edit your schedule first.";
		}

		echo json_encode($return);

	}

	public function get_news_feed(){

		$session_data = $this->session->userdata('logged_in');

		$notifications = $this->list_model->get_notifications($session_data['id']);

		echo json_encode($notifications);

		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['id'];

		$appointment_id = $this->input->post("appointment_id");
		$last_id   		= $this->input->post("last_id");
		$result 		= $this->message_model->getAppointmentMessage($appointment_id,$id);
		$latest_id 		= $result['id'];

		while($last_id == $latest_id){
			usleep(1000);
			clearstatcache();
			$result 		= $this->message_model->getAppointmentMessage($appointment_id,$id);
			$latest_id 		= $result['id'];
		}

		
		echo json_encode($result);

	}
}