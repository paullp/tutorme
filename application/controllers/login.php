<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('table');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('verifylogin','verifylogin');
		$this->load->model('list_model');
		$this->load->helper('url');
	}
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('home', 'refresh');
		}
		else
		{
			$this->load->view("login_page.php");
		}
	}
	function check_database()
	{
		$this->form_validation->set_rules('email','Email','trim|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|xss_clean|callback_confirm_user');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("login_page.php");
		}
		else
		{
			redirect('home', 'refresh');
		}
	}
	
	function email_action()
	{
		$email = $_GET["email"];
		$password = $_GET["password"];
		$action = $_GET["action"];
		$user = $this->verifylogin->check_database($email,$password);
		if($user == false)
		{
			redirect('login', 'refresh');
			return false;
		}
		else
		{
			$sess_array = array();
			foreach($user as $row)
			{
				$fullname = $row->last_name.", ".$row->first_name;
				$sess_array = array(
				'id' => $row->id,
				'fullname' => $fullname,
				'email' => $row->email,
				'usertype' => $row->usertype
				);
				$this->session->set_userdata('logged_in', $sess_array);
				$session_data = $this->session->userdata('logged_in');
			}
			if($action == "approve_appointment")
			{
				$id = $_GET["appointment_id"];
				redirect('home/approve_appointment?id='.$id,'refresh');
			}
			elseif($action == "reject_appointment")
			{
				$id = $_GET["appointment_id"];
				redirect('home/reject_appointment?id='.$id,'refresh');				
			}
			elseif($action == "cancel_appointment")
			{
				$id = $_GET["appointment_id"];
				redirect('home/cancel_appointment?id='.$id,'refresh');
			}
			elseif($action == "view_appointment")
			{
				$id = $_GET["appointment_id"];
				redirect('home/appointment_messages?id='.$id,'refresh');
			}
			
		}
	}

	
	function confirm_user($password)
	{
		$email = $this->input->post('email');
		$user = $this->verifylogin->check_database($email,$password);
		if($user == false)
		{
			$this->form_validation->set_message('confirm_user', 'Invalid Username/Password');
			return false;
		}
		else
		{
			$sess_array = array();
			foreach($user as $row)
			{
				$fullname = $row->last_name.", ".$row->first_name;
				$sess_array = array(
				'id' => $row->id,
				'fullname' => $fullname,
				'email' => $row->email,
				'usertype' => $row->usertype
				);
				$this->session->set_userdata('logged_in', $sess_array);
				$session_data = $this->session->userdata('logged_in');
			}
			return true;
		}
	}
	
	function check_email()
	{
		$email = $this->input->post('email');
		$user = $this->list_model->email_exist($email);
		if($user == false)
		{
			$this->form_validation->set_message('check_email', '<span style="color:red">Email not in database.</span>');
			return false;
		}
		else
		{
			if(isset($_POST["birthday"]))
			{
				$user = $this->verifylogin->retrieve_password($email,date("Y-m-d", strtotime($this->input->post('birthday'))));
				if($user != NULL)
				{
					return true;
				}
				else
				{
						$this->form_validation->set_message('check_email', '<span style="color:red">Wrong birthday!</span>');
					return false;			
				}
			}
			else
			{
				return false;
			}
		}
	}
	
	function retrieve_password()
	{
		$this->form_validation->set_rules('email','email','required|valid_email|callback_check_email');
		$this->form_validation->set_rules('birthday','birthday','required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("forget_password");
		}
		else
		{
			$info = $this->verifylogin->retrieve_password($this->input->post('email'),date("Y-m-d", strtotime($this->input->post('birthday'))));
			$this->sendMail(10,$info);
			$this->session->set_flashdata('msg', 'Password Sent!');
			redirect('login', 'refresh');
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	

}