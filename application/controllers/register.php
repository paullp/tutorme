<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {
	 function __construct()
	 {
		parent::__construct();
		$this->load->model('register/register_model','register');

		$this->check_session();
	 }
	
	function handle_resume_upload()
	{
		if (isset($_FILES['resume']) && !empty($_FILES['resume']['name']))
		{
			$f = $_FILES['resume'];
			$allowedTypes = array("doc","docx","pdf");
			$detectedType = pathinfo($f['name'], PATHINFO_EXTENSION);
			if(in_array($detectedType, $allowedTypes))
			{
				return true;
			}
			else 
			{
				$this->form_validation->set_message('handle_resume_upload', '<span style="color:red">');
				return false;
			}
		}
		else
		{
			$this->form_validation->set_message('handle_resume_upload', '<span style="color:red">');
			return false;			
		}
	}
	
	function email_exist()
	{
		$email_exist = $this->list_model->email_exist($this->input->post("email"));
		if($email_exist != 0)
		{
			$this->form_validation->set_message('email_exist', '<b>email</b> already exist.<br>');
			return false;
		}
		else
		{
			return true;			
		}
	}
	
	function welcome_page(){
		$this->load->view("welcome_user_page");
	}
	
	function register_student()
	{ 
		$config['upload_path'] = 'images/student/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		if($this->input->post() != NULL){
			$r = $this->set_validations_for_student();
			$this->form_validation->set_rules($r);
		}

		if ($this->form_validation->run() == FALSE)
		{
			$data["schedule_time"] = $this->list_model->schedule_time();
			$data['errors'] = validation_errors();
			$this->load->view('register/register_student',$data);
		}
		else
		{
			$data = $this->input->post();

			if (!empty($_FILES['photo']['name']))
			{	
				$config['upload_path'] = 'images/student/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload',$config);
				$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $data['first_name'].$data['last_name']).".".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo'))
				{
					$photo_name = $config['upload_path'].$config['file_name'];
				}
			}else{
				if($this->input->post("gender") == "Male"){
					$photo_name = "images/student/default-male.jpg";
				}else{
					$photo_name = "images/student/default-female.jpg";
				}			
			}
			// echo $photo_name;

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['usertype'] = 3;
			$data['active'] = true;
			$data['birthday'] = date("Y-m-d",strtotime($data['birthday']));
			$data['resume'] = NULL;
			$data['photo'] = $photo_name;

			unset($data['confirm_password']);
			
			$this->register->register_user($data);
			redirect('register/welcome_page','refresh');
			// echo "<pre>";
			// print_r($d);
			// echo "</pre>";
		}	
	}
	
	function register_teacher()
	{
		$session_data = $this->session->userdata('logged_in');

		if($this->input->post() != NULL){
			$r = $this->set_validations_for_teacher();
			$this->form_validation->set_rules($r);
		}
		if ($this->form_validation->run() == FALSE)
		{

			$this->session->set_flashdata('msg', "<span style='color:red;'>Please fill all the fields</span>");
			$data["name"] = $session_data["fullname"];
			$data["usertype"] = $session_data["usertype"];
			$data["review_count"] = $this->list_model->review_count($session_data["id"]);
			$data["schedule_time"] = $this->list_model->schedule_time();
			$data['errors'] = json_encode(validation_errors());

			$page_info = array(
				"page" => "register/register_teacher",
				"data" => $data
			);

			$this->render($page_info);

		}
		else
		{
			$data = $this->input->post();
			
			if (!empty($_FILES['photo']['name']))
			{	
				$config['upload_path'] = 'images/teacher/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '5120';
				$this->load->library('upload',$config);
				$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $data['first_name'].$data['last_name']).".".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo'))
				{
					$photo_name = $config['upload_path'].$config['file_name'];
				}
			}else{
				if($this->input->post("gender") == "Male"){
					$photo_name = "images/student/default-male.jpg";
				}else{
					$photo_name = "images/student/default-female.jpg";
				}			
			}

			if (!empty($_FILES['resume']['name']))
			{
				$config['upload_path'] = 'resume/';
				$config['allowed_types'] = 'doc|docx|pdf';
				$this->load->library('upload',$config);	
				$ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $data['first_name'].$data['last_name'])."_resume.".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload("resume"))
				{
					$resume_name = $config['upload_path'].$config['file_name'];
				}else{
					echo $this->upload->display_errors();
					exit;
				}
			}else{
				$resume_name = NULL;
			}

			$data['created_on'] = date('Y-m-d H:i:s');
			$data['usertype'] = 2;
			$data['active'] = true;
			$data['birthday'] = date("Y-m-d",strtotime($data['birthday']));
			$data['monday'] = (isset($data['monday']) ? implode(',',$data['monday']) : NULL);
			$data['tuesday'] = (isset($data['tuesday']) ? implode(',',$data['tuesday']) : NULL);
			$data['wednesday'] = (isset($data['wednesday']) ? implode(',',$data['wednesday']) : NULL);
			$data['thursday'] = (isset($data['thursday']) ? implode(',',$data['thursday']) : NULL);
			$data['friday'] = (isset($data['friday']) ? implode(',',$data['friday']) : NULL);
			$data['saturday'] = (isset($data['saturday']) ? implode(',',$data['saturday']) : NULL);
			$data['sunday'] = (isset($data['sunday']) ? implode(',',$data['sunday']) : NULL);
			$data['resume'] = $resume_name;
			$data['photo'] = $photo_name;

			unset($data['confirm_password']);

			$this->register->register_user($data);
			redirect('home/teacher_list', 'refresh');
		}
	}
	
function register_teacher_by_url()
	{
			$this->form_validation->set_rules('email','email','trim|required|valid_email|xss_clean|callback_email_exist');
			$this->form_validation->set_rules('password','password','trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[8]|matches[password]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|max_length[50]');
			$this->form_validation->set_rules('firstname','firstname','trim|required|max_length[50]');
			$this->form_validation->set_rules('current_location','current location','trim|required|max_length[50]');
			$this->form_validation->set_rules('gender','gender','required');
			$this->form_validation->set_rules('birthday','birthday','required');
			$this->form_validation->set_rules('occupation','occupation','required');
			$this->form_validation->set_rules('teaching_experience','teaching_experience','required|xss_clean');
			$this->form_validation->set_rules('resume','resume','callback_handle_resume_upload');
			$this->form_validation->set_rules('preferred_location','preferred location','required');
			$this->form_validation->set_rules('monday'   , 'monday'   , 'xss_clean');
			$this->form_validation->set_rules('tuesday'  , 'tuesday'  , 'xss_clean');
			$this->form_validation->set_rules('wednesday', 'wednesday', 'xss_clean');
			$this->form_validation->set_rules('thursday' , 'thursday' , 'xss_clean');
			$this->form_validation->set_rules('friday'   , 'friday'   , 'xss_clean');
			$this->form_validation->set_rules('saturday' , 'saturday' , 'xss_clean');
			$this->form_validation->set_rules('sunday'   , 'sunday'   , 'xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('msg', "<span style='color:red;'>Please fill all the fields</span>");
				$data["name"] = "";
				$data["usertype"] = "";
				$data["review_count"] = "";
				$data["schedule_time"] = $this->list_model->schedule_time();
				$this->load->view("menu/menu",$data);
				$data["schedule_time"] = $this->list_model->schedule_time();
				$this->load->view('register/register_teacher',$data);
			}
			else
			{
				$data = array(
					'created_on'         => date('Y-m-d H:i:s'),
					'active'             => true,
					'first_name'         => $this->input->post("firstname"),
					'last_name'          => $this->input->post("lastname"),
					'email'              => $this->input->post("email"),
					'password'           => $this->input->post("password"),
					'usertype'           => 2,
					'gender'             => $this->input->post("gender"),	
					'current_location'   => $this->input->post("current_location"),
					'birthday'           => date("m/d/y",strtotime($this->input->post("birthday"))),
					'native_language'    => NULL,
					'mandarin_level'     => NULL,
					'preferred_location' => $this->input->post("preferred_location"),
					'teaching_exp'       => $this->input->post("teaching_experience"),
					'occupation'         => $this->input->post("occupation"),
					'about_me'           => $this->input->post("about_me"),
					'comment_teacher'    => NULL
				);
				$id = $this->register->register_user($data);
				
				if($this->input->post("monday")){$monday = implode(',',$this->input->post("monday"));}else{$monday=NULL;}
				if($this->input->post("tuesday")){$tuesday = implode(',',$this->input->post("tuesday"));}else{$tuesday=NULL;}
				if($this->input->post("wednesday")){$wednesday = implode(',',$this->input->post("wednesday"));}else{$wednesday=NULL;}
				if($this->input->post("thursday")){$thursday = implode(',',$this->input->post("thursday"));}else{$thursday=NULL;}
				if($this->input->post("friday")){$friday = implode(',',$this->input->post("friday"));}else{$friday=NULL;}
				if($this->input->post("saturday")){$saturday = implode(',',$this->input->post("saturday"));}else{$saturday=NULL;}
				if($this->input->post("sunday")){$sunday = implode(',',$this->input->post("sunday"));}else{$sunday=NULL;}
				
				$data = array(
					'user_id'    => $id,
					'monday'     => $monday,
					'tuesday'    => $tuesday,
					'wednesday'  => $wednesday,
					'thursday'   => $thursday,
					'friday'     => $friday,
					'saturday'   => $saturday,
					'sunday'     => $sunday
				);
				$this->register->register_schedule($data);
				
				
				if (!empty($_FILES['photo']['name']))
				{	
					$config['upload_path'] = 'images/teacher/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload',$config);
					$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
					$config['file_name'] = $this->input->post("lastname")."_".$id.".".$ext;
					$this->upload->initialize($config);
					if ($this->upload->do_upload('photo'))
					{
						$photo_name = $config['upload_path'].$config['file_name'];
					}
				}else{

					if($this->input->post("gender") == "male"){
						$photo_name = "images/student/default-male.jpg";
					}else{
						$photo_name = "images/student/default-female.jpg";
					}			
				}
							
				if (!empty($_FILES['resume']['name']))
				{
					$config['upload_path'] = 'resume/';
					$config['allowed_types'] = 'doc|docx|pdf';
					$this->load->library('upload',$config);	
					$ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
					$config['file_name'] = $this->input->post("lastname")."_".$id."_resume.".$ext;
					$this->upload->initialize($config);
					if ($this->upload->do_upload("resume"))
					{
						$resume_name = $config['upload_path'].$config['file_name'];
					}else{
						echo $this->upload->display_errors();
					}
				}
				
				$data = array(
							'id' => $id,
							'resume' => $resume_name,
							'photo' => $photo_name
						);
				
				$this->register->save_files($data);
				$data['username'] = $this->input->post('email');
				$data['password'] = $this->input->post("password");
				redirect('register/welcome_page','refresh');
			}
	}

	function check_schedule()
	{
		if($this->input->post('schedule_validation') == "false")
		{
			$this->form_validation->set_message('check_schedule', '<span style="color:red">Schedule is already taken.</span>');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function get_sched_time()
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data["id"];
		$name_day = $this->input->post("name_day");
		$teacher_id = $this->input->post("teacher_id");

		$validity = $this->list_model->check_availability($id,$name_day,$teacher_id);
		echo $validity;
		return $validity;
	}
	
	function create_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		
		$this->form_validation->set_rules('teacher_id','teacher_id','required');
		$this->form_validation->set_rules('schedule_date','schedule_date','required|callback_check_schedule');
		$this->form_validation->set_rules('schedule_validation','schedule_validation','callback_check_schedule');
		$this->form_validation->set_rules('place','place','required');			
		
		if ($this->form_validation->run() == FALSE)
		{
			$data["name"] = $session_data["fullname"];
			$data["usertype"] = $session_data["usertype"];
			$id = $session_data["id"];

			if(isset($_POST["teacher_id"]))
			{	
				$teacher_id = $_POST["teacher_id"];
			}
			else if(isset($_GET["teacher_id"]))
			{	
				$teacher_id = $_GET["teacher_id"];
			}	
			
			if($session_data["usertype"] == 3)
			{
				$data["teacher_profile"] = $this->list_model->teacher_list($teacher_id,1,1);
			}	
			$data['student_profile'] = $this->list_model->get_user_info($id);
			$data["schedule_time"] = $this->list_model->schedule_time("array");
			$this->load->view("menu/menu",$data);
			$this->load->view("student/send_message",$data);
		}
		else
		{
			$data = array(
				'created_on' => date('Y/m/d H:i:s'),
				'date' => date("Y-m-d", strtotime($this->input->post('schedule_date'))),
				'time' => $this->input->post('schedule_time_id'),
				'place' => $this->input->post('place'),
				'teacher_id' => $this->input->post('teacher_id'),
				'student_id' => $session_data["id"],
				'status' => "PENDING",
				'reason' => NULL,
				'cancelled_by' => NULL
			);
			 $id = $this->schedule_model->create_appointment($data);
			
			$date = date('Y-m-d H:i:s');
			if($this->input->post('message') != "" or $this->input->post('message') != NULL)
			{
				$data2 = array(
					'created_on' => $date,
					'appointment_id' => $id,
					'user_id' => $session_data["id"],
					'message' => $this->input->post('message')
				);
				$this->schedule_model->appointment_messages($data2);
			}
			$info = $this->list_model->appointment_data($id,$session_data["usertype"]);
			$this->sendMail(5,$info);
			$this->session->set_flashdata('msg', 'Appointment Requested!');
			redirect('home/appointments', 'refresh');
		}
	}
	function thank_you()
	{
		$this->load->view("thanks_page.php");
	}

	function ajax_submit_student(){

		$d = $this->input->post();

		$error_string = "";

		if($d['email'] == ""){
			$error_string .= "<p><b>Email</b> is required.</p>";
		}else{
			$email_exist = $this->list_model->email_exist($d['email']);
			if($email_exist != 0){
				$error_string .= "<p><b>Email</b> already exist.</p>";
			}
		}

		if($d['password'] == ""){
			$error_string .= "<p><b>Password</b> is required.</p>";
		}else{
			if(strlen($d['password']) < 8){
				$error_string .= "<p><b>Password</b> must be 8 characters or more.</p>";
			}
		}		

		if($d['confirm_password'] == ""){
			$error_string .= "<p><b>Confirm Password</b> is required.</p>";
		}else{
			if($d['password'] != $d['confirm_password']){
				$error_string .= "<p><b>Confirm Password</b> does not match <b>Password</b>.</p>";
			}				
		}

		if($d['first_name'] == ""){
			$error_string .= "<p><b>First Name</b> is required.</p>";
		}

		if($d['last_name'] == ""){
			$error_string .= "<p><b>Last Name</b> is required.</p>";
		}

		if($d['current_location'] == ""){
			$error_string .= "<p><b>Current Location</b> is required.</p>";
		}

		if($d['gender'] == ""){
			$error_string .= "<p><b>Gender</b> is required.</p>";
		}

		if($d['birthday'] == ""){
			$error_string .= "<p><b>Birthday</b> is required.</p>";
		}

		if($d['native_language'] == ""){
			$error_string .= "<p><b>Native Language</b> is required.</p>";
		}

		if($d['mandarin_level'] == ""){
			$error_string .= "<p><b>Mandarin Level</b> is required.</p>";
		}

		if($d['lesson_frequency'] == ""){
			$error_string .= "<p><b>Lesson Frequency</b> is required.</p>";
		}	

		if(strlen($error_string) <= 0){

			if (!empty($_FILES['photo']['name']))
			{	
				$config['upload_path'] = 'images/student/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload',$config);
				$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $d['first_name'].$d['last_name']).".".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo'))
				{
					$d["photo"] = $config['upload_path'].$config['file_name'];
				}
			}else{

				if($d["gender"] == "Male"){
					$d["photo"] = "images/student/default-male.jpg";
				}else{
					$d["photo"] = "images/student/default-female.jpg";
				}
			}

			$d["birthday"] 		= date("Y-m-d",strtotime($d['birthday']));
			$d['usertype'] 		= 3;
			$d['active'] 		= 1;
			// $this->kprint($d);
			// exit;

			unset($d['confirm_password']);

			$this->register->register_user($d);

			$return['status'] 	= true;

		}else{

			$return['message'] 	= $error_string;
			$return['status'] 	= false;

		}
		
		echo json_encode($return);

	}

	function ajax_submit_teacher(){

		$d = $this->input->post();

		$error_string = "";

		if($d['email'] == ""){
			$error_string .= "<p><b>Email</b> is required.</p>";
		}else{
			$email_exist = $this->list_model->email_exist($d['email']);
			if($email_exist != 0){
				$error_string .= "<p><b>Email</b> already exist.</p>";
			}
		}

		if($d['password'] == ""){
			$error_string .= "<p><b>Password</b> is required.</p>";
		}else{
			if(strlen($d['password']) < 8){
				$error_string .= "<p><b>Password</b> must be 8 characters or more.</p>";
			}
		}

		if($d['confirm_password'] == ""){
			$error_string .= "<p><b>Confirm Password</b> is required.</p>";
		}else{
			if($d['password'] != $d['confirm_password']){
				$error_string .= "<p><b>Confirm Password</b> does not match <b>Password</b>.</p>";
			}				
		}

		if($d['first_name'] == ""){
			$error_string .= "<p><b>First Name</b> is required.</p>";
		}

		if($d['last_name'] == ""){
			$error_string .= "<p><b>Last Name</b> is required.</p>";
		}

		if($d['current_location'] == ""){
			$error_string .= "<p><b>Current Location</b> is required.</p>";
		}

		if($d['gender'] == ""){
			$error_string .= "<p><b>Gender</b> is required.</p>";
		}

		if($d['birthday'] == ""){
			$error_string .= "<p><b>Birthday</b> is required.</p>";
		}

		if($d['occupation'] == ""){
			$error_string .= "<p><b>Occupation</b> is required.</p>";
		}

		if($d['teaching_exp'] == ""){
			$error_string .= "<p><b>Teaching Experience</b> is required.</p>";
		}

		if(strlen($error_string) <= 0){

			if (!empty($_FILES['photo']['name']))
			{	
				$config['upload_path'] = 'images/teacher/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload',$config);
				$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $d['first_name'].$d['last_name']).".".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo'))
				{
					$d["photo"] = $config['upload_path'].$config['file_name'];
				}
			}else{

				if($d["gender"] == "Male"){
					$d["photo"] = "images/student/default-male.jpg";
				}else{
					$d["photo"] = "images/student/default-female.jpg";
				}
			}

			if (!empty($_FILES['resume']['name']))
			{
				$config['upload_path'] = 'resume/';
				$config['allowed_types'] = 'doc|docx|pdf';
				$this->load->library('upload',$config);	
				$ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $d['first_name'].$d['last_name'])."_resume.".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload("resume"))
				{
					$d['resume'] = $config['upload_path'].$config['file_name'];
				}
			}else{
				$d['resume'] = NULL;
			}

			$d['birthday'] 		= date("Y-m-d",strtotime($d['birthday']));
			$d['monday'] 		= (isset($d['monday']) ? implode(',',$d['monday']) : NULL);
			$d['tuesday'] 		= (isset($d['tuesday']) ? implode(',',$d['tuesday']) : NULL);
			$d['wednesday'] 	= (isset($d['wednesday']) ? implode(',',$d['wednesday']) : NULL);
			$d['thursday'] 		= (isset($d['thursday']) ? implode(',',$d['thursday']) : NULL);
			$d['friday'] 		= (isset($d['friday']) ? implode(',',$d['friday']) : NULL);
			$d['saturday'] 		= (isset($d['saturday']) ? implode(',',$d['saturday']) : NULL);
			$d['sunday'] 		= (isset($d['sunday']) ? implode(',',$d['sunday']) : NULL);
			$d['usertype'] 		= 2;
			$d['active'] 		= 1;

			unset($d['confirm_password']);

			$this->register->register_user($d);

			$return['message'] 	= "Teacher Successfully Added.";
			$return['status'] 	= true;

		}else{
			
			$return['message'] 	= $error_string;
			$return['status'] 	= false;

		}	

		echo json_encode($return);

	}

	function set_validations_for_student(){
		$data = $this->input->post();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$rules = array();
		foreach($data as $key => $value){
			if( $key != "about_me" and $key != "comment_teacher"){	
				if($key == "email"){
					$r = "required|valid_email|callback_email_exist";
				}elseif($key == "confirm_password"){
					$r = "required|matches[password]";
				}elseif($key == "photo"){
					$r = "callback_handle_upload";
				}elseif($key == "monday" OR $key == "tuesday" OR $key == "wednesday" OR $key == "thursday" OR $key == "friday" OR $key == "saturday" OR $key == "sunday"){
					$r = "callback_return_true";
				}else{
					$r = "required";
				}
				$r = array(
					'field' => $key,
					'label' => ucwords(str_replace("_"," ",$key)),
					'rules' => $r
				);
				array_push($rules,$r);
			}
		}

		return $rules;
	}

	function set_validations_for_teacher(){
		$data = $this->input->post();

		$rules = array();
		foreach($data as $key => $value){
			if( $key != "about_me"){	
				if($key == "email"){
					$r = "required|valid_email|callback_email_exist";
				}elseif($key == "confirm_password"){
					$r = "required|matches[password]";
				}elseif($key == "photo"){
					$r = "callback_handle_upload";
				}else{
					$r = "required";
				}
				$r = array(
					'field' => $key,
					'label' => ucwords(str_replace("_"," ",$key)),
					'rules' => $r
				);
				array_push($rules,$r);
			}
		}
		return $rules;
	}

	function edit_user_info($user_id,$user_type){

		if($user_type == "teacher"){
			$path = "images/teacher/";
		}else{
			$path = "images/student/";
		}
		$config['upload_path'] = $path;
		$config['overwrite'] = TRUE;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload');
		$this->upload->initialize($config);

		$r = $this->set_validations_for_edit_teacher();
		$this->form_validation->set_rules($r);
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = "failed";
			$data['message'] = validation_errors();
			echo json_encode($data);

		}else{

			$user_info = $this->list_model->get_user_info($user_id);
			$d = $this->input->post();
			
			if(isset($d['confirm_password']))//remove the confirm password in 
			{
				unset($d["confirm_password"]);
			}

			if (!empty($_FILES['photo']['name']))
			{	
				if($user_info['first_name'] != $d['first_name'] or $user_info['last_name'] != $d['last_name']){
					unlink($user_info['photo']);
				}
				$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = str_replace(' ', '_', $d['first_name'].$d['last_name']).".".$ext;
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo')){
					$d['photo'] = $config['upload_path'].$config['file_name'];
				}else{

					$data['status'] = "failed";
					$data['message'] = $this->upload->display_errors();
					echo json_encode($data);
					exit;
				}
			}

			$this->register->update($user_id,$d);
			$data['status'] = "success";
			$data['message'] = "Edit Successful";
			$data['user_info'] = $this->list_model->get_user_info($user_id);
			echo json_encode($data);
		}
	}

	function set_validations_for_edit_teacher(){
		$data = $this->input->post();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$rules = array();
		foreach($data as $key => $value){
			if( $key != "about_me"){	
				if($key == "email"){
					$r = "required|valid_email|callback_email_exist";
				}elseif($key == "password"){
					$r = "required|min_length[8]";
				}elseif($key == "confirm_password"){
					$r = "required|matches[password]";
				}elseif($key == "monday" OR $key == "tuesday" OR $key == "wednesday" OR $key == "thursday" OR $key == "friday" OR $key == "saturday" OR $key == "sunday"){
					$r = "callback_return_true";
				}else{
					$r = "required";
				}

				$r = array(
					'field' => $key,
					'label' => ucwords(str_replace("_"," ",$key)),
					'rules' => $r
				);
				array_push($rules,$r);
			}
		}
		// echo "<pre>";
		// print_r($rules);
		// echo "</pre>";	
		return $rules;
	}

	function return_true(){
		return true;
	}

	public function request_appointment(){

		$session_data = $this->session->userdata('logged_in');

		$d = $this->input->post();

		$data = array();
		$data['created_on'] = date('Y-m-d H:i:s');
		$data['date'] 		= $d['date'];
		$data['time'] 		= $d['time'];
		$data['place'] 		= $d['place'];
		$data['teacher_id'] = $d['teacher_id'];
		$data['student_id'] = $session_data['id'];
		$data['status'] 	= "PENDING";

		$message = $d['message'];

		$appointment_id = $this->register->register_appointment($data);


		$notif = array();
		$notif['user_to']  					= $d['teacher_id'];
		$notif['user_from'] 				= $session_data['id'];
		$notif['type'] 				 		= 0;
		$notif['appointment_id'] 	 		= $appointment_id;
		$notif['appointment_message_id']	= 0;
		$notif['seen'] 						= 0;
		

		$this->register->notification_insert($notif);

		$appointment_info = $this->list_model->get_appointments('','',$appointment_id);

		$return['appointment_info'] = $appointment_info;
		$return['status'] = true;

		echo json_encode($return);

	}
}