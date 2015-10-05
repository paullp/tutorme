<?php
Class Verifylogin extends CI_Model
{
	function check_database($email,$password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get();
		if($query -> num_rows() == 1)
		{
		 return $query->result();
		}
		else
		{
		 return false;
		}
	}
	
	function retrieve_password($email,$birthday)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('birthday',$birthday);
		$query = $this->db->get();
		if($query -> num_rows() == 1)
		{
		 return $query->result();
		}
		else
		{
		 return false;
		}		
	}
}
?>
