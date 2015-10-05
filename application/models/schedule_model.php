<?php
Class Schedule_model extends CI_Model
{
	function schedule($id)
	{
		$this->db->select('*');
		$this->db->from('schedule');
		$this->db->where('user_id',$id);
        $query = $this->db->get();
        return $query->result();		
	}
	
	function get_teacher_list()
	{
		$this->db->select('*,user.first_name,user.last_name,user.id,user.usertype,resume_photo.photo,(select count(*) from reviews where teacher_id = user.id) as review_count');
		$this->db->from('schedule');
		$this->db->join('user','user.id = schedule.user_id');
		$this->db->join('resume_photo','resume_photo.id = user.id');
		$this->db->where('user.usertype',2);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function review_count($id)
	{
		$this->db->select('reviews.date_updated, user.last_name, user.first_name, quality, preparation, english_ability, friendliness, punctuality, comment, recommendation, photo');
		$this->db->from('reviews');
		$this->db->join('user','user.id = reviews.student_id');
		$this->db->join('resume_photo','resume_photo.id = reviews.student_id');
		$this->db->where('teacher_id',$id);
		$this->db->where('reviews.active',1);
		$this->db->order_by("date_updated", "asc");
		$query = $this->db->get();
        return $query->result();
	}
	
	function time_of_sched($id)
	{
		$this->db->select("*");
		$this->db->from('schedule');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	function sched_time($id)
	{
		$this->db->select("*");
		$this->db->from('schedule_time');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function schedule_check($id,$date,$time)
	{
		$this->db->select("*");
		$this->db->from('appointments');
		$this->db->where('student_id != ',$id);
		$this->db->where('date',$date);
		$this->db->where('time',$time);
		$this->db->where('status != ',"CANCELLED");
		$query = $this->db->get();
		return $query->result();		
	}
	
	function edit_schedule($query,$id)
	{
		$this->db->where('id',$id);
        $this->db->update('user',$query);
	}
	
	function create_appointment($data)
	{
		$this->db->insert('appointments',$data);
		return $this->db->insert_id();
	}
	
	function edit_appointment($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('appointments',$data);		
	}
	
	function appointment_messages($data2)
	{
		$this->db->insert('appointment_messages',$data2);
	}
	
	function change_appointment_status($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('appointments',$data);
	}
	
	function change_comment_status($user_id,$appointment_id,$arr)
	{
		$this->db->where('appointment_id',$appointment_id);
		$this->db->where('status !=', 'DELETED');
		$this->db->where('user_id !=',$user_id);
        $this->db->update('appointment_messages',$arr);
	}
	
	function delete_comment($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('appointment_messages',$data);		
	}
}
?>
