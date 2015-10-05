<?php
Class Message_model extends CI_Model
{
	function distinct_from($id)
	{
		$this->db->select('from_id');
		$this->db->from('user');
		$this->db->join('message', 'message.from_id = user.id');
		$this->db->where('to_id',$id);
		$this->db->order_by('sent_on', 'desc');
		$this->db->group_by('from_id'); 
        $query = $this->db->get();
        return $query->result();		
	}

	function message_content($from_id,$to_id)
	{
		$this->db->select('resume_photo.photo,message.from_id,message.content,user.first_name,user.last_name');
		$this->db->from('message');
		$this->db->join('user','user.id = message.from_id');
		$this->db->join('resume_photo','resume_photo.id = message.from_id');
		$this->db->where('message.to_id',$to_id);
		$this->db->where('message.from_id',$from_id);
		$this->db->order_by('sent_on', 'desc');
		$this->db->limit(1);
        $query = $this->db->get();
        return $query->result();		
	}
		
	function messages($from_id,$id)
	{
		$this->db->select('*,user.first_name,user.last_name');
		$this->db->from('message');
		$this->db->join('user','user.id = message.from_id');
		$query_or_1 = "(to_id = '$id' AND from_id ='$from_id') OR (to_id = '$from_id' AND from_id ='$id')";
		$this->db->where($query_or_1);
		$this->db->order_by('sent_on', 'asc');
        $query = $this->db->get();
        return $query->result();	
	
	}
	function send_message($data)
	{
		$this->db->insert('appointment_messages', $data);
	}
	
	function edit_message_status($from_id,$to_id,$data)
	{
		$this->db->where('from_id',$from_id);
		$this->db->where('to_id',$to_id);
        $this->db->update('message',$data);
	}

	function get_messages_by_appointment_id($appointment_id)
	{
		$this->db->select('appointment_messages.user_id,appointment_messages.message,user.first_name,user.last_name');
		$this->db->from('appointment_messages');
		$this->db->join('user','user.id = appointment_messages.user_id');
		$this->db->where('appointment_id',$appointment_id);
		$this->db->order_by('appointment_messages.id', 'ASC'); 
        $query = $this->db->get();
        return $query->result();		
	}
	
	function getAppointmentMessage($appointment_id){

		$query_string = "SELECT * FROM appointment_messages WHERE appointment_id = '{$appointment_id}' ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($query_string);
		$result = $query->row_array();	
		
		return $result;


	}


}
?>
