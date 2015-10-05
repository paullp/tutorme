<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_user extends CI_Controller {
	 function __construct()
	 {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('register/edit_user_model','edit_user',TRUE);
		$this->load->model('register/register_model','register');
		$this->load->model('list_model');
		$this->load->helper('url');
	 }
	 
	 function edit_teacher_profile()
	 {
		if($this->session->userdata('logged_in'))
		{
			$id = $_POST["id"];
			$resume = $_POST["resume"];
			$delete_photo = $_POST["old_photo"];
			$old_lastname = $_POST["old_lastname"];
			
			$data = array(
				'created_on' => $_POST["created_on"],
				'active' => true,
				'first_name' => $_POST["firstname"],
				'last_name' => $_POST["lastname"],
				'email' => $_POST["email"],
				'password' => $_POST["password"],
				'usertype' => 2,
				'gender' => $_POST["gender"],	
				'current_location' => $_POST["current_location"],
				'lesson_frequency' => NULL,
				'birthday' => $_POST["year"]."/".$_POST["month"]."/".$_POST["day"],
				'native_language' => NULL,
				'mandarin_level' => NULL,
				'preferred_location' => $_POST["preferred_location"],
				'teaching_exp' => $_POST["teaching_exp"],
				'occupation' => $_POST["occupation"],
				'about_me' => $_POST["about_me"],
				'comment_teacher' => NULL
			);
			
			$this->edit_user->edit_teacher_profile($data,$id);
			
			if(is_uploaded_file($_FILES['photo']['tmp_name']) or $old_lastname != $_POST["lastname"])
			{
				$del = $delete_photo;
				@unlink($del);
				$oldpath = $_FILES['photo']['tmp_name'];
				$ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
				$newpath ="images/teacher/".$_POST["lastname"]."_".$id."photo.".$ext;
				$photo = $newpath;
				
				move_uploaded_file($oldpath,$newpath);
				
				$data = array(
						'id' => $id,
						'resume' => $resume,
						'photo' => $photo			
					);
					$this->edit_user->edit_teacher_photo($data,$id);
			}
			
			$m_time = "";
			$t_time = "";
			$w_time = "";
			$th_time = "";
			$f_time = "";
			$s_time = "";
			$sun_time = "";
			
			if(isset($_POST["schedule"]))
			{
			foreach ($_POST["schedule"] as $a=>$b){
					$time="";
					$s_day = "";
					foreach($b as $c=>$d) {
						$time.= $d.",";
					};
					$time = rtrim($time, ",");
					if($a == 0)
					{
						$m_time.= $time;
					}
					else if($a == 1)
					{
						$t_time.= $time;
					}
					else  if($a == 2)
					{
						$w_time.= $time;
					}
					else if($a == 3)
					{
						$th_time.= $time;
					}
					else if($a == 4)
					{
						$f_time.= $time;
					}
					else if($a == 5)
					{
						$s_time.= $time;
					}
					else if($a == 6)
					{
						$sun_time.= $time;
					}
			}
				$data = array(
					'user_id' => $id,
					'monday' => $m_time,
					'tuesday' => $t_time,
					'wednesday' => $w_time,
					'thursday' => $th_time,
					'friday' => $f_time,
					'saturday' => $s_time,
					'sunday' => $sun_time,
					'other_time' => NULL,
				);
			}
			else
			{
				$data = array(
					'user_id' => $id,
					'monday' => NULL,
					'tuesday' => NULL,
					'wednesday' => NULL,
					'thursday' => NULL,
					'friday' => NULL,
					'saturday' => NULL,
					'sunday' => NULL,
					'other_time' => NULL,
				);				
			}
			$this->edit_user->edit_teacher_schedule($data,$id);
			redirect('home/teacher_list', 'refresh');
			
		}
	 }
}