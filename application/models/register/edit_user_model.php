<?php
Class Edit_user_model extends CI_Model
{
	function edit_teacher_photo($data,$id)
	{
		$this->db->where('id',$id);
        $this->db->update('resume_photo',$data);
	}
	
	function edit_teacher_profile($data,$id)
	{
		$this->db->where('id',$id);
        $this->db->update('user',$data);
	}
	
	function edit_teacher_schedule($data,$id)
	{
		$this->db->where('user_id',$id);
        $this->db->update('schedule',$data);
	}
}
?>
