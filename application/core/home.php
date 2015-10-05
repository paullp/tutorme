<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('table');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('register/register_model','register');
		$this->load->model('message_model');
		$this->load->model('schedule_model');
		$this->load->model('list_model');
		$this->load->model('verifylogin','verifylogin');
		$this->load->helper('url');
		$this->load->library('email');
	}
	
		// template
		// if($this->session->userdata('logged_in'))
		// {
		// }
		// else
		// {
			// redirect('login', 'refresh');
		// }
	
	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in'))
		{
			if($session_data["usertype"] == 1)//ADMIN
			{
			redirect('home/appointments', 'refresh');
			}
			else if($session_data["usertype"] == 2)//TEACHER
			{
				redirect('home/my_schedule','refresh');
			}
			else if($session_data["usertype"] == 3)//STUDENT
			{
				redirect('home/my_schedule', 'refresh');
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	function admin_page()
	{
		$session_data = $this->session->userdata('logged_in');
		$data["name"] = $session_data["fullname"];
		$data["usertype"] = $session_data["usertype"];
		$this->load->view("menu/menu",$data);
	}
	
	function my_schedule()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in'))
		{
			$data["id"] = $session_data["id"];
			$data["name"] = $session_data["fullname"];
			$data["usertype"] = $session_data["usertype"];
			$data["schedule_time"] = $this->list_model->schedule_time();
			$data["schedule"] = $this->list_model->get_schedule($session_data["id"]);
			$data["review_count"] = $this->list_model->review_count($session_data["id"]);
			$this->load->view("menu/menu",$data);
			$UPCOMING = true;
			//PAGINATION FOR UPCOMING APPOINTMENTS
			$config = array();
			$teacher = false;
			$student = false;
			$status = "APPROVED";
			$config["base_url"] = base_url() . "index.php/home/my_schedule";
			$config["total_rows"] = $this->list_model->count_myschedule_appointments_pagination($session_data["usertype"],$session_data["id"],$status,$UPCOMING,$teacher,$student);
			$data["total_rows"] = $config["total_rows"];
			$config["per_page"] = 5;
			$config["uri_segment"] = 3;		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["results"] = $this->list_model->appointments($session_data["id"],$session_data["usertype"],$status,$config["per_page"],$page,$UPCOMING,$teacher,$student);
			$data["links"] = $this->pagination->create_links();
			$data["total_rows"] = $config["total_rows"];
			$data["per_page"] = $config["per_page"];
			//PAGINATION FOR UPCOMING APPOINTMENTS
			
			if($session_data["usertype"] == 2)
			{
				$this->load->view("teacher/teacher_schedule",$data); 
			}
			else if($session_data["usertype"] == 3)
			{
				$this->load->view("student/student_schedule",$data); 
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
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
		$data["schedule_time"] = $this->list_model->schedule_time();
		$data["schedule"] = $this->list_model->get_schedule($id);
		$data["review_count"] = $this->list_model->review_count($id);
		$this->load->view("menu/menu",$data);
		//for edit
		$edit_profile = false;
		if(isset($_GET["edit_profile"]))
		{
			$edit_profile = true;
		}
		$data["edit_profile"] = $edit_profile;
		//if ADMIN
		$data["user_info"] = $this->list_model->get_user_info($id);
		
		$view_profile = "";
		if(isset($_GET["view_profile"]))
		{
			$view_profile = $_GET["view_profile"];
		}
		if($this->session->userdata('logged_in'))
		{
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
	
	function photo_change($new,$old,$last_name,$id,$usertype)
	{
		 if (file_exists($old)) {
			unlink($old);
		}
		if($usertype == 2)
		{
			$title = "teacher";
		}
		else
		{
			$title = "student";
		}
		$oldpath = $new;
		$ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		$newpath ="images/$title/".$last_name."_".$id."photo.".$ext;
		$photo = $newpath;
		move_uploaded_file($oldpath,$newpath);
	}
	
	function edit_profile()
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $_POST["user_id"];
		$m_time = "";
		$t_time = "";
		$w_time = "";
		$th_time = "";
		$f_time = "";
		$s_time = "";
		$sun_time = "";
		$my_schedule = false;
		if(isset($_POST["my_schedule"]))
		{
			$my_schedule = true;
		}
		if($session_data["usertype"] == 1 or $session_data["usertype"] == 3)
		{
			if(is_uploaded_file($_FILES['photo']['tmp_name']))
			{
				$this->photo_change($_FILES['photo']['tmp_name'],$_POST["previous_photo"],$_POST["last_name"],$id,$_POST["usertype"]);
			}
			$native_language  = NULL;
			$mandarin_level   = NULL;
			$lesson_frequency = NULL;
			$teaching_exp     = NULL;
			$occupation       = NULL;
			$rate_per_hour    = NULL;
			
			if($_POST["usertype"] == 2)
			{
				$teaching_exp  = $_POST["teaching_exp"];
				$occupation    = $_POST["occupation"];
				$rate_per_hour = $_POST["rate_per_hour"];
			}
			else if($_POST["usertype"] == 3)
			{
				$native_language  = $_POST["native_language"];
				$mandarin_level   = $_POST["mandarin_level"];
				$lesson_frequency = $_POST["lesson_frequency"];
			}
			
			$data = array(
				"first_name" => $_POST["first_name"],
				"last_name" => $_POST["last_name"],
				"email" => $_POST["email"],
				"password" => $_POST["password"],
				"gender" => $_POST["gender"],
				"current_location" => $_POST["current_location"],
				"lesson_frequency" => $lesson_frequency,
				"birthday" => date("Y-m-d",strtotime($_POST["birthday"])),
				"native_language" => $native_language,
				"mandarin_level" => $mandarin_level,
				"preferred_location" => $_POST["preferred_location"],
				"teaching_exp" => $teaching_exp,
				"occupation" => $occupation,
				"about_me" => $_POST["about_me"],
				"rate_per_hour" => $rate_per_hour
			);
			$this->list_model->edit_profile($id,$data);
		}
			$usertype = "";
			if(isset($_POST["usertype"]))
			{
				$usertype = $_POST["usertype"];
			}
			if($usertype == 2 or $session_data["usertype"] == 2)
			{
				if(isset($_POST["schedule"]))
				{
					foreach ($_POST["schedule"] as $a=>$b){
						$time="";
						foreach($b as $c=>$d) {
							$time.= $d.",";
						};
						if($time == ""){$time = NULL;}
						else{$time = rtrim($time, ",");}
						if($a == 0){$m_time.= $time;}
						else if($a == 1){$t_time.= $time;}
						else  if($a == 2){$w_time.= $time;}
						else if($a == 3){$th_time.= $time;}
						else if($a == 4){$f_time.= $time;}
						else if($a == 5){$s_time.= $time;}
						else if($a == 6){$sun_time.= $time;}
					}
				}
				$data = array(
					'user_id'   => $id,
					'monday'    => $m_time,
					'tuesday'   => $t_time,
					'wednesday' => $w_time,
					'thursday'  => $th_time,
					'friday'    => $f_time,
					'saturday'  => $s_time,
					'sunday'    => $sun_time,
					'other_time'=> NULL,
				);
			}
			if($usertype == 3 or $session_data["usertype"] == 3)
			{
				$data = array(
					'user_id'   => $id,
					'monday'    => $_POST["m_time"],
					'tuesday'   => $_POST["t_time"],
					'wednesday' => $_POST["w_time"],
					'thursday'  => $_POST["th_time"],
					'friday'    => $_POST["f_time"],
					'saturday'  => $_POST["s_time"],
					'sunday'    => $_POST["sun_time"],
					'other_time'=> NULL,
				);				
			}
			$this->schedule_model->edit_schedule($data,$id);
		
		
		if($usertype == 2)
		{
			$view_profile = "teacher";
			$this->session->set_flashdata('msg', 'Teacher edited!');
		}
		else if($usertype == 3)
		{
			$view_profile = "student";
			$this->session->set_flashdata('msg', 'Student edited!');
		}
			
		if($my_schedule == false)
		{
			
			header('Location: '.base_url().'index.php/home/my_profile?id='.$id.'&view_profile='.$view_profile, 'refresh');
			exit;
		}
		else
			redirect('home/my_schedule','refresh');
	}
	
	function appointments()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in'))
		{
			$data["name"] = $session_data["fullname"];
			$data["usertype"] = $session_data["usertype"];
			$data["review_count"] = $this->list_model->review_count($session_data["id"]);
			$data["dropdown_teacher"] = $this->list_model->dropdown_user(2);
			$data["dropdown_student"] = $this->list_model->dropdown_user(3);
			$this->load->view("menu/menu",$data);		
			
			$teacher = FALSE;
			$data["teacher"] = "";
			$student = FALSE;
			$data["student"] = "";
			$status = FALSE;
			$data["status"] = "";
			$UPCOMING = FALSE;
			
			//PAGINATION FOR TEACHER LIST

			$config = array();
			$config["base_url"] = base_url() . "index.php/home/appointments";
			//if url will pass a variable
			if (count($_GET) > 0)
			{
				$config['suffix'] = '?' . http_build_query($_GET, '', "&");
				if(isset($_GET["teacher"]) and $_GET["teacher"] != "-")
				{
					$teacher = $_GET["teacher"];
					$data["teacher"] = $teacher;
				}
				else
				{
					$teacher = FALSE;
				}
				
				if(isset($_GET["student"]) and $_GET["student"] != "-")
				{
					$student = $_GET["student"];
					$data["student"] = $student;
				}
				else
				{
					$student = FALSE;
				}
				
				if(isset($_GET["status"]) and $_GET["status"] != "-")
				{
					$status = $_GET["status"];
					$data["status"] = $status;
				}
				else
				{
					$status = FALSE;
				}
				$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
			}
			
			$config["total_rows"] = $this->list_model->count_appointments_pagination($session_data["usertype"],$session_data["id"],$status,$UPCOMING,$teacher,$student);
			$data["total_rows"] = $config["total_rows"];
			$config["per_page"] = 5;
			$data["per_page"] = $config["per_page"];
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data["total_rows"] = $config["total_rows"];
			$data["per_page"] = $config["per_page"];
			//PAGINATION FOR TEACHER LIST
			
			if($session_data["usertype"] == 1)
			{
				$data["appointments"] = $this->list_model->appointments($session_data["id"],$session_data["usertype"],$status,$config["per_page"],$page,$UPCOMING,$teacher,$student);
			}
			else if($session_data["usertype"] == 2)
			{
				$data["appointments"] = $this->list_model->appointments($session_data["id"],$session_data["usertype"],$status,$config["per_page"],$page,$UPCOMING,$teacher,$student);
			}
			else if($session_data["usertype"] == 3)
			{
				//$data["appointments"] = $this->list_model->appointments($session_data["id"],$session_data["usertype"],$status);
				$data["appointments"] = $this->list_model->appointments($session_data["id"],$session_data["usertype"],$status,$config["per_page"],$page,$UPCOMING,$teacher,$student);
			}
			
			$this->load->view("appointments",$data);
		}
		else
		{
			redirect('login', 'refresh');
		}
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
			$this->load->view("menu/menu",$data);
			//PAGINATION FOR TEACHER LIST
			$config = array();
			$config["base_url"] = base_url() . "index.php/home/teacher_list";
			$config["total_rows"] = $this->list_model->count_teacher();
			$config["per_page"] = 5;
			$config["uri_segment"] = 3;		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["teacher_list"] = $this->list_model->teacher_list($teacher_id,$config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data["total_rows"] = $config["total_rows"];
			$data["per_page"] = $config["per_page"];
			//PAGINATION FOR TEACHER LIST
			$data["schedule_time"] =$this->list_model->schedule_time();
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
			$data["student_list"] = $this->list_model->student_list($student_id);
			
			$this->load->view("menu/menu",$data);
			$this->load->view("student_list",$data);
		}	
		else
		{
			redirect('login', 'refresh');
		}		
	}
	
	function edit_teacher_profile()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in') and $session_data["usertype"] == "1")
		{
			$teacher_id = $_GET["id"];
			$data["teacher_profile"] = $this->list_model->teacher_list($teacher_id,1,1);
			$data["schedule"] = $this->list_model->schedule($teacher_id);
			if($data["schedule"] != NULL)
			{
				$null_all = 0;
				foreach($data["schedule"] as $sched)
				{
					if($sched->monday != NULL){$s[0] = explode(",", $sched->monday);}else{$null_all++;}
					if($sched->tuesday != NULL){$s[1] = explode(",", $sched->tuesday);}else{$null_all++;}
					if($sched->wednesday != NULL){$s[2] = explode(",", $sched->wednesday);}else{$null_all++;}
					if($sched->thursday != NULL){$s[3] = explode(",", $sched->thursday);}else{$null_all++;}
					if($sched->friday != NULL){$s[4] = explode(",", $sched->friday);}else{$null_all++;}
					if($sched->saturday != NULL){$s[5] = explode(",", $sched->saturday);}else{$null_all++;}
					if($sched->sunday != NULL){$s[6] = explode(",", $sched->sunday);}else{$null_all++;}
				}
				if($null_all != 7)
				{
					$data["sched"] = $s;
				}
				else
				{
					$data["sched"] = NULL;
				}
			}
			$data["schedule_time"] = $this->list_model->schedule_time();
			$this->load->view("register/edit_teacher_profile",$data);
		}
		else
		{
			redirect('login', 'refresh');
		}			
	}
	
	function edit_student_profile()
	{
		$session_data = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in') and $session_data["usertype"] == "1")
		{
			$student_id = $_GET["id"];
			$data["teacher_profile"] = $this->list_model->teacher_list($student_id);
			$data["schedule"] = $this->list_model->schedule($student_id);
			foreach($data["schedule"] as $sched)
			{
				if($sched->monday != "")($s[0] = explode(",", $sched->monday));
				if($sched->tuesday != "")($s[1] = explode(",", $sched->tuesday));
				if($sched->wednesday != "")($s[2] = explode(",", $sched->wednesday));
				if($sched->thursday != "")($s[3] = explode(",", $sched->thursday));
				if($sched->friday != "")($s[4] = explode(",", $sched->friday));
				if($sched->saturday != "")($s[5] = explode(",", $sched->saturday));
				if($sched->sunday != "")($s[6] = explode(",", $sched->sunday));
			}
			$data["sched"] = $s;
			$data["schedule_time"] = $this->list_model->schedule_time();
			$this->load->view("register/edit_teacher_profile",$data);
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
		if($_POST["monday"] != "e"? $monday = $_POST["monday"]: $monday = NULL);
		if($_POST["tuesday"]!= "e"? $tuesday = $_POST["tuesday"]: $tuesday = NULL);
		if($_POST["wednesday"]!= "e"? $wednesday = $_POST["wednesday"]: $wednesday = NULL);
		if($_POST["thursday"]!= "e"? $thursday = $_POST["thursday"]: $thursday = NULL);
		if($_POST["friday"]!= "e"? $friday = $_POST["friday"]: $friday = NULL);
		if($_POST["saturday"]!= "e"? $saturday = $_POST["saturday"]: $saturday = NULL);
		if($_POST["sunday"]!= "e"? $sunday = $_POST["sunday"]: $sunday = NULL);
		
		$query = array(
			'monday' => $monday, 
			'tuesday' => $tuesday,
			'wednesday' => $wednesday,
			'thursday' => $thursday,
			'friday' => $friday,
			'saturday' => $saturday,
			'sunday' => $sunday
		);
		$this->schedule_model->edit_schedule($query,$id);
		//echo $data= $monday  ."=". $tuesday ."=". $wednesday ."=". $thursday ."=". $friday ."=". $saturday ."=". $sunday;
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
		$arr = array(
			"status" => "READ"
		);
		$this->schedule_model->change_comment_status($session_data["id"],$_GET["id"],$arr);
		
		//appointment information
		$data["schedule_time"] = $this->list_model->schedule_time();
		$data["schedule"] = $this->list_model->get_schedule($session_data["id"]);
		$data["appointment_info"] = $this->list_model->appointment_info($id,$session_data["usertype"]);
		$this->load->view("appointment_info",$data);
		
		//appointment messages
		$data["appointment_messages"] = $this->list_model->appointment_messages($id);
		$this->load->view("appointment_messages",$data);
	}
	
	function approve_appointment()
	{
		$session_data = $this->session->userdata('logged_in');
		$data = array(
			"status" => "APPROVED"
		);
		$this->schedule_model->change_appointment_status($_GET["id"],$data);
		
		$data = array(
			"created_on" => date('Y/m/d H:i:s'),
			"appointment_id" => $_GET["id"],
			"user_id" => $session_data["id"],
			"message" => "Approved Date : ". date('m/d/Y'),
			"status" => "NEW"
		);
		$this->schedule_model->appointment_messages($data);
		
		$info = $this->list_model->appointment_data($_GET["id"],$session_data["usertype"]);
		$this->sendMail(6,$info);
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
}	