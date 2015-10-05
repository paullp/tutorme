<?php
Class Register_model extends CI_Model
{
	function register_user($data)
	{
		$this->db->insert('user', $data);
		return mysql_insert_id();
	}
	
	function register_appointment($data){
		$this->db->insert('appointments', $data);
		return mysql_insert_id();		
	}

	function notification_insert($data){
		$this->db->insert('notifications', $data);
	}

	function register_schedule($data)
	{
		$this->db->insert('schedule', $data);
	}
	
	function save_files($data)
	{
		$this->db->insert('resume_photo', $data);
	}

	function update($user_id,$data){
		$this->db->where('id', $user_id);
		$this->db->update('user', $data); 
	}
}
?>
