<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE); // I keep this here so I dont have to manualy edit each controller to see profiler or not        
	    //load helpers and everything here like form_helper etc
    }
	
	public $REGISTER_TEACHER_EMAIL = 1;
	public $REGISTER_STUDENT_EMAIL = 2;
	public $NEW_MESSAGE_TEACHER_EMAIL = 3;
	public $NEW_MESSAGE_STUDENT_EMAIL = 4;
	public $REQUEST_APPOINTMENT_EMAIL = 5;
	public $APPOINTMENT_APPROVED_EMAIL = 6;
	public $APPOINTMENT_REJECTED_EMAIL = 7;
	public $APPOINTMENT_TEACHER_CANCELLED_EMAIL = 8;
	public $APPOINTMENT_CHANGED_EMAIL = 9;
	public $FORGET_PASSWORD_EMAIL = 10;	
	public $APPOINTMENT_STUDENT_CANCELLED_EMAIL = 11;	
	public $ADMIN_MESSAGE_STUDENT = 12;	
	public $ADMIN_MESSAGE_TEACHER = 13;	
	public $APPOINTMENT_FINISHED_EMAIL = 14;	
	
	function sendMail($type,$info)
	{
		$this->load->library('email');

		$subject = $this->composeSubject($type,$info);
		$content = $this->composeContent($type,$info);
		 
		foreach($info as $i)
		{
			$this->email->from('no-reply@tutorme.com.tw');
			if($type == 12)
			{
				$this->email->to($i->student_email); 
			}
			else if($type == 13)
			{
				$this->email->to($i->teacher_email); 
			}
			else if($type == 14)
			{
				$this->email->to("mark@tmichines.com");
			}
			else
			{
				$this->email->to($i->email); 
			}
			$this->email->subject($subject);
			$this->email->message($content);	
		}
		$this->email->send();
	}
	
	function composeSubject($type,$info)
	{
		switch($type)
		{
			case $this->REGISTER_TEACHER_EMAIL:			
			case $this->REGISTER_STUDENT_EMAIL:
				return "TutorMe Account";			
			case $this->NEW_MESSAGE_TEACHER_EMAIL:		
			case $this->NEW_MESSAGE_STUDENT_EMAIL:
			case $this->ADMIN_MESSAGE_STUDENT:
			case $this->ADMIN_MESSAGE_TEACHER:
				return "New Message Recieved";
			case $this->REQUEST_APPOINTMENT_EMAIL:
				return "New Appointment Request";
			case $this->APPOINTMENT_APPROVED_EMAIL:
				return "Appointment Accepted";
			case $this->APPOINTMENT_REJECTED_EMAIL:
				return "Appointment Rejected!";
			case $this->APPOINTMENT_TEACHER_CANCELLED_EMAIL:
			case $this->APPOINTMENT_STUDENT_CANCELLED_EMAIL:
				return "Appointment Cancelled!";
			case $this->APPOINTMENT_CHANGED_EMAIL:
				return "***IMPORTANT: Appointment Changed***";
			case $this->FORGET_PASSWORD_EMAIL:
				return "Forgot Password";
			case $this->APPOINTMENT_FINISHED_EMAIL:
				foreach($info as $i)
				{
					return "Appointment Finished(Teacher:$i->teacher_last_name,$i->teacher_first_name=Student:$i->student_last_name,$i->student_first_name)";
				}
		}
	}
	
	function composeContent($type,$info)
	{
		foreach($info as $i)
		{
		$content = "";
		switch($type)
		{
			case $this->ADMIN_MESSAGE_STUDENT:
				$content = $content ."
				Hello $i->student_first_name $i->student_last_name!<br><br>
				You have received a new message from an Admin, We recommend replying quickly to message to ensure you get the appointment before anyone else books your timeslot. You can view or reply to your latest message(s) by clicking the below link<br><br>
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->student_email&password=$i->student_password&appointment_id=$i->appointment_id&action=view_appointment'>View Message</a>";
				break;
			case $this->ADMIN_MESSAGE_TEACHER:
				$content = $content ."
				Hello $i->teacher_first_name $i->teacher_last_name!<br><br>
				You have received a new message, we recommend replying quickly to message to ensure you get the tutoring Job before any of your colleagues.<br><br>
				You can view or reply to your latest message(s) by clicking the below link<br><br>
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->teacher_email&password=$i->teacher_password&appointment_id=$i->appointment_id&action=view_appointment'>View Message</a>";
				break;
			case $this->REGISTER_TEACHER_EMAIL:
				$content = $content ."
				Congratulations $i->first_name!<br><br>
				Your account profile has been received, within the next 24 Hours you will be able to schedule and meet new students who want to learn Chinese!<br><br>
				Please store your user name and password, Once your account is finalized we will send you and email and you can begin the TutorMe experience";
				break;
			case $this->REGISTER_STUDENT_EMAIL:
				$content = $content ."
				Congratulations  $i->first_name!<br><br>
				Your profile has now been published on the TutorME website, you can now begin your search for a qualified Tutor.<br><br>
				You can login  <a href='www.tutorme.com.tw'>here</a> or if you have forgotten you password you can get a password reminder <a href='www.tutorme.com.tw/index.php/login/retrieve_password'>here</a><br><br>
				We hope you enjoy your TutorMe Experience";
				break;
			case $this->NEW_MESSAGE_TEACHER_EMAIL:
				$content = $content ."
				Hello $i->teacher_first_name $i->teacher_last_name!<br><br>
				You have received a new message, we recommend replying quickly to message to ensure you get the tutoring Job before any of your colleagues.<br><br>
				You can view or reply to your latest message(s) by clicking the below link<br><br>
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=view_appointment'>View Message</a>";
				break;
			case $this->NEW_MESSAGE_STUDENT_EMAIL:
				$content = $content ."
				Hello $i->student_first_name $i->student_last_name!<br><br>
				You have received a new message from a tutor, We recommend replying quickly to message to ensure you get the appointment before anyone else books your timeslot. You can view or reply to your latest message(s) by clicking the below link<br><br>
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=view_appointment'>View Message</a>";
				break;
			case $this->REQUEST_APPOINTMENT_EMAIL:
				$content = $content ."
				Hello $i->teacher_first_name $i->teacher_last_name!<br><br>
				You have received a booking for a class. Please view the details of the new class below. You can now choose to accept or reject this appointment. <br>
				Class Details :<br>
				Date : ".date("m/d/Y",strtotime($i->date))." <br>
				Time : $i->time <br>
				Location : $i->place <br>
				Student : $i->student_first_name $i->student_last_name<br><br> |
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=approve_appointment'>Approve</a> | 
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=reject_appointment'>Reject</a> | 
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=view_appointment'>View Appointment</a> | 
				<br>";
				break;
			case $this->APPOINTMENT_APPROVED_EMAIL:
				$content = $content ."
				Congratulations $i->student_first_name!<br><br>
				Your tutor has agreed to meet you! You don't have to do anything else now, just show up at the time and location listed below. And remember if you can't make it or need to change time then please alter your booking to avoid the tutor making the journey to meet you. Please set a reminder or an alarm on your phone to remind you of the class!<br><br>
				Class Details: <br>
				Date : $i->date <br>
				Time : $i->time <br>
				Location : $i->place <br>
				Teacher : <a href=''> $i->teacher_first_name $i->teacher_last_name</a> <br><br> |
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=view_appointment'>View Appointment</a> | 
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=cancel_appointment'>Cancel Appointment<a/> |<br>";
				break;
			case $this->APPOINTMENT_REJECTED_EMAIL:
				$content = $content ."
				Hello $i->student_first_name!<br><br>
				We are afraid that your tutor rejected your request. However this is not the End! Your tutor may simply have another appointment scheduled for this time, we recommend trying to create a new appointment or to search for a new Tutor.<br><br>
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&action=view_teacher'>View Teachers List<a><br>";
				break;
			case $this->APPOINTMENT_TEACHER_CANCELLED_EMAIL:
				$content = $content ."
				Hello $i->teacher_first_name!
				We are afraid that your Student has Cancelled your next appointment. However this is not the End! Your Student may simply have other engagements at this time.
				Please Update your available schedule if it has changed since :<BR>
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&action=view_schedule'>My Schedule</a>
				Warm regards
				TutorMe Team
				";
				break;
			case $this->APPOINTMENT_CHANGED_EMAIL:
				$content = $content ."
				Hello $i->teacher_first_name $i->teacher_last_name!<br><br>
				We are sorry to inform you that your Student has changed their original appointment. Please login to your appointments or to manage and view the changes<br><br>

				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&appointment_id=$i->appointment_id&action=view_appointment'>View Appointment</a>
				";
				break;
			case $this->FORGET_PASSWORD_EMAIL:
				$content = $content ."
				Oppps  $i->first_name!!<br><br>
				Looks like you forgot your password, No Problem, Please find your username and password below<br><br>
				Email :  $i->email<br>
				Password : $i->password<br>
				";
				break;
			case $this->APPOINTMENT_STUDENT_CANCELLED_EMAIL:
				$content = $content ."
				Hello $i->student_first_name<br>
				We are afraid that your tutor as Cancelled your next appointment. However this is not the End! Your tutor may simply have another appointment scheduled for this time, we recommend trying to create a new appointment or to search for a new Tutor.
				<a href='www.tutorme.com.tw/index.php/login/email_action?email=$i->email&password=$i->password&action=view_teacher'>View Teachers</a>
				Warm regards
				TutorMe Team
				";
				break;
			case $this->APPOINTMENT_FINISHED_EMAIL:
				$content = $content ."
				This appointment is now finished. <br>
				Class Details :<br>
				Date : ".date("m/d/Y",strtotime($i->date))." <br>
				Time : $i->time <br>
				Location : $i->place <br>
				Teacher : $i->teacher_first_name $i->teacher_last_name <br>
				Student : $i->student_first_name $i->student_last_name<br>
				<br>";
				break;
		}
		}
		$content = $content . "<br><br>Warm Regards,<br><br>TutorME Team";
		return $content;
	}


	function render($page){

		$session_data = $this->session->userdata('logged_in');

		if($this->session->userdata('logged_in'))
		{

			$data["name"] = $session_data["fullname"];
			$data['user_info'] = $this->list_model->get_user_info($session_data["id"]);
			$data["usertype"] = $session_data["usertype"];
			$data["review_count"] = $this->list_model->review_count($session_data["id"]);		
		
			$this->load->view("menu/menu",$data);
			$this->load->view($page['page'],$page['data']);
		
		}else{

			redirect('login', 'refresh');
		
		}

	}

	function check_session(){
		$session_data = $this->session->userdata('logged_in');
		if(!$this->session->userdata('logged_in')){
			redirect('login', 'refresh');
		}
	}

}