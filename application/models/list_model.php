<?php
Class List_model extends CI_Model
{
	function count_user($usertype)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('usertype',$usertype);
		$this->db->where('active',true);
        $query = $this->db->get();
        return $query->num_rows();		
	}
	
	function teacher_list($teacher_id,$per_page,$offset)
	{
		
		$this->db->select('
			user.created_on,
			user.id,
			user.last_name,
			user.first_name,
			user.birthday,
			user.occupation,
			user.teaching_exp,
			user.current_location,
			user.current_location,
			user.gender,
			user.email,
			user.preferred_location,
			user.about_me,
			user.photo,
			(select count(*) from reviews where teacher_id = user.id and active = 1) as review_count,
			user.monday,
			user.tuesday,
			user.wednesday,
			user.thursday,
			user.friday,
			user.saturday,
			user.sunday,
			user.resume,
			(select (sum(quality)+sum(preparation)+sum(english_ability)+sum(friendliness)+sum(punctuality))/review_count/5 from reviews where teacher_id = user.id) as overall_rating
			');
		$this->db->from('user');
		$this->db->where('usertype',2);
		$this->db->where('active', true);
		if($teacher_id != "")
		{
			$this->db->where('id',$teacher_id);
		}
		else
		{
			$this->db->limit($per_page,$offset);
		}
		$this->db->order_by("first_name", "asc");
        
        $query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	function dropdown_user($usertype,$type = "")
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('usertype',$usertype);
		$this->db->order_by("first_name", "asc");


		$query = $this->db->get();

		if($type == ""){
        	return $query->result();	
		}else{
			return $query->result_array();	
		}
	}
	
	function student_list($student_id,$per_page,$offset)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('usertype',3);
		$this->db->where('active', true);
		if($student_id != "")
		{
			$this->db->where('id',$student_id);
		}
		else
		{
			$this->db->limit($per_page,$offset);
		}
		$this->db->order_by("last_name", "asc");
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	function get_user_info($id,$usertype=1)
	{
		$query_string = "SELECT * FROM user WHERE id = {$id}";
		$query = $this->db->query($query_string);
		$data =  $query->row_array();


		if($usertype != 1){
			unset($data["password"]);
		}

		return $data;
	}
	
	function user($usertype)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('usertype',$usertype);
        $query = $this->db->get();
        return $query->result();	
	}
	
	function schedule($id,$type='')
	{
		$this->db->select('*');
		$this->db->from('schedule');
		$this->db->where('user_id',$id);
        $query = $this->db->get();
        if($type == 'array'){
        	return $query->result_array();
        }else{
        	return $query->result();
        }
	}
	
	function schedule_time($type='')
	{
		$this->db->select('*');
		$this->db->from('schedule_time');
        $query = $this->db->get();
        if($type == 'array'){
        	return $query->result_array();
        }else{
        	return $query->result();
        }	
	}
	
	function mandarin_level()
	{
		$this->db->select('*');
		$this->db->from('mandarin_level');
        $query = $this->db->get();
        return $query->result();		
	}
	
	function check_schedule($id)
	{
		$this->db->select('*');
		$this->db->from('schedule');
		$this->db->where('user_id',$id);
        $query = $this->db->get();
        return $query->num_rows();			
	}
	
	function appointments($id,$usertype,$status,$per_page,$offset,$UPCOMING,$teacher,$student)
	{
		$this->db->limit($per_page,$offset);
		if($usertype == 1)
		{
			$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,
				(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
				(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name,
				(select photo from resume_photo where resume_photo.id = appointments.student_id) as student_photo,
				(select photo from resume_photo where resume_photo.id = appointments.teacher_id) as teacher_photo,
				(select count(*) from appointment_messages 
					where appointment_messages.appointment_id = appointments.id 
					and appointment_messages.status = "NEW") as new_message
			');
			
			if($teacher != FALSE)
			{
				$this->db->where('teacher_id',$teacher);	
			}
			
			if($student != FALSE)
			{
				$this->db->where('student_id',$student);	
			}
		}
		else if($usertype == 2)
		{
			$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,
				(select last_name from user where id = appointments.student_id and active = 1) as last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as first_name,
				(select photo from resume_photo where resume_photo.id = appointments.student_id) as photo,
				(select count(*) from appointment_messages 
					where appointment_messages.appointment_id = appointments.id 
					and appointment_messages.status = "NEW" 
					and appointment_messages.user_id != appointments.teacher_id) as new_message,
			');
			$this->db->where('teacher_id',$id);		
		}
		else if($usertype == 3)
		{
			$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,
				(select last_name from user where id = appointments.teacher_id and active = 1) as last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as first_name,
				(select photo from resume_photo where resume_photo.id = appointments.teacher_id) as photo,
				(select count(*) from appointment_messages 
					where appointment_messages.appointment_id = appointments.id 
					and appointment_messages.status = "NEW" 
					and appointment_messages.user_id != appointments.student_id) as new_message,
			');
			$this->db->where('student_id',$id);
		}
		$this->db->from('appointments');
		$this->db->join('schedule_time','schedule_time.id = appointments.time');
		if($status != FALSE)
		{
			$this->db->where('appointments.status',$status);	
		}
		$date = date("Y-m-d");
		
		$this->db->order_by("appointments.date", "asc");
		IF($UPCOMING == TRUE)
		{
			$this->db->where('date >= ', date('Y-m-d'));
        }
		$query = $this->db->get();
        return $query->result_array();
	}
	
	function count_myschedule_appointments_pagination($usertype,$id,$status,$UPCOMING)
	{
		$this->db->select('*');
		$this->db->from('appointments');
		if($usertype == 3)
		{
			$this->db->where('student_id',$id);
		}
		elseif($usertype == 2)
		{
			$this->db->where('teacher_id',$id);
		}
		$this->db->where('status',$status);
		IF($UPCOMING == TRUE)
		{
			$this->db->where('date >= ', date('Y-m-d'));
        }
		$query = $this->db->get();
        return $query->num_rows();
	}
	
	function check_appointments($id,$usertype,$status)
	{
		if($usertype != 1)
		{
			$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,user.first_name,user.last_name');
		}
		else
		{
			$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,
				(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name,
				(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
			');
		}
		
		$this->db->from('appointments');
		$this->db->join('schedule_time','schedule_time.id = appointments.time');
		if($usertype == 3)
		{
			$this->db->join('user','user.id = appointments.teacher_id');
			$this->db->where('appointments.student_id',$id);
        }
		else if($usertype == 2)
		{
			$this->db->join('user','user.id = appointments.student_id');
			$this->db->where('appointments.teacher_id',$id);			
		}
		
		if($usertype == 1 and $status != "0")
		{
			$this->db->where("status",$status);
		}
		
		$this->db->order_by('date','desc');
		$this->db->limit(0,5);
		$query = $this->db->get();
        return $query->result();
	}
	function upcomming_appointments_per_page($usertype,$id,$per_page,$offset)
	{
		$this->db->limit($per_page,$offset);
		$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,user.first_name,user.last_name');
		$this->db->from('appointments');
		if($usertype == 3)
		{
			$this->db->join('user','user.id = appointments.teacher_id');
			$this->db->where('appointments.student_id',$id);
		}
		elseif($usertype == 2)
		{
			$this->db->join('user','user.id = appointments.student_id');
			$this->db->where('appointments.teacher_id',$id);			
		}
		$this->db->join('schedule_time','schedule_time.id = appointments.time');
		$this->db->order_by('date','asc');
		$this->db->where('date >= ', date('Y-m-d'));
		$this->db->where("status","APPROVED");		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
		return $query->result();
		}
		else
		{
			return false;
		}
	}
	function past_teacher($id)
	{
		$this->db->select('user.id,user.first_name,user.last_name');
		$this->db->from('user');
		$this->db->join('appointments','appointments.teacher_id = user.id');
		$this->db->where('appointments.student_id',$id);
		$this->db->where('status','FINISHED');
		$this->db->where('user.id not in (select teacher_id from reviews where student_id='.$id.' and active = 1)');
		$this->db->group_by('user.id');
        $query = $this->db->get();
        return $query->result();		
	}
	
	function review($id)
	{
		$this->db->select('*,reviews.id as review_id');
		$this->db->from('reviews');
		$this->db->join('user','user.id = reviews.teacher_id');
		$this->db->where('student_id',$id);
		$this->db->where('reviews.active',1);
		$query = $this->db->get();
        return $query->result();				
	}
	
	function load_review($review_id)
	{
		$this->db->select('*,reviews.id as review_id');
		$this->db->from('reviews');
		$this->db->join('user','user.id = reviews.teacher_id');
		$this->db->where('reviews.id',$review_id);
		$this->db->where('reviews.active',1);
		$query = $this->db->get();
        return $query->result();			
	}
	
	function save_review($data,$review_id)
	{
		if($review_id == NULL)
		{
			$this->db->insert('reviews', $data);
		}
		else
		{
			$this->db->where('id',$review_id);
			$this->db->update('reviews',$data);
		}
	}
	
	function my_reviews($id)
	{
		$this->db->select('reviews.id as review_id,reviews.teacher_id,reviews.date_updated,user.id, user.last_name, user.first_name, quality, preparation, english_ability, friendliness, punctuality, comment, recommendation, user.photo');
		$this->db->from('reviews');
		$this->db->join('user','user.id = reviews.student_id');
		$this->db->where('teacher_id',$id);
		$this->db->where('reviews.active',1);
		$this->db->order_by("date_updated", "asc");
		$query = $this->db->get();
        return $query->result();
	}
	
	function get_count_reviews($id)
	{
		$this->db->select('count(id) as total');
		$this->db->from('reviews');
		$this->db->where('teacher_id',$id);
		$this->db->where('active',1);
		$query = $this->db->get();
		foreach($query->result() as $q)
		{
			return $q->total;
		}			
	}
	
	function overall_rating($id,$total)
	{
		$this->db->select('
						teacher_id,
						sum(quality)/'.$total.' as quality, 
						sum(preparation)/'.$total.' as preparation, 
						sum(english_ability)/'.$total.' as english_ability, 
						sum(friendliness)/'.$total.' as friendliness, 
						sum(punctuality)/'.$total.' as punctuality,
						((sum(quality)+sum(preparation)+sum(english_ability)+sum(friendliness)+sum(punctuality))/'.$total.' )/5 as overall_rating,
						(sum(recommendation)/'.$total.' )*100 as recommended
						');
		$this->db->from('reviews');
		$this->db->where('teacher_id',$id);
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result();		
	}
	
	function appointments_excel()
	{
		$this->db->select('*');
		$this->db->from('appointments');
        $query = $this->db->get();
        return $query->result();	
	}

	function review_count($id)
	{
		$this->db->select('*');
		$this->db->from('reviews');
		$this->db->where('seen',false);
		$this->db->where('teacher_id',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function review_edit($data,$id)
	{
		$this->db->where('teacher_id',$id);
        $this->db->update('reviews',$data);
	}
	
	function appointment_info($id)
	{
		$this->db->select('appointments.id,appointments.date,schedule_time.time,schedule_time.id as sched_time_id,appointments.place,appointments.status,
				(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
				(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name,
		');	

		$this->db->from('appointments');
		$this->db->join('schedule_time','schedule_time.id = appointments.time');
		$this->db->where('appointments.id',$id);
        $query = $this->db->get();
        return $query->result();	
	}
	
	function appointment_messages($id)
	{
		$query_string = "SELECT am.*,u.first_name,u.last_name,u.photo FROM appointment_messages am
						 LEFT JOIN user u ON u.id = am.user_id
						 WHERE appointment_id = {$id}";
		$query = $this->db->query($query_string);
		return $query->result_array();
	}
	
	function exist_appointment_check($student_id,$teacher_id)
	{
		$this->db->select('*');
		$this->db->from('appointments');
		$this->db->where('student_id',$student_id);
		$this->db->where('teacher_id',$teacher_id);
        $query = $this->db->get();
		return $query->result();
	}
	
	function edit_profile($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('user',$data);
	}
	
	function appointment_data($id,$usertype)
	{
		if($usertype != 1)
		{
		$this->db->select('appointments.id as appointment_id,user.email as email,user.password,appointments.date,schedule_time.time,appointments.place,
				(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
				(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name');
		}
		else
		{
		$this->db->select('appointments.id as appointment_id,appointments.date,schedule_time.time,appointments.place,
				(select email from user where id = appointments.student_id and active = 1) as student_email,
				(select email from user where id = appointments.teacher_id and active = 1) as teacher_email,
				(select password from user where id = appointments.student_id and active = 1) as student_password,
				(select password from user where id = appointments.teacher_id and active = 1) as teacher_password,
				(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
				(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name');			
		}
		$this->db->from('appointments');
	    $this->db->where('appointments.id',$id);
		$this->db->join('schedule_time','schedule_time.id = appointments.time');
		if($usertype == 2)
		{
			$this->db->join('user','user.id = appointments.student_id');
		}
		else if($usertype == 3)
		{
			$this->db->join('user','user.id = appointments.teacher_id');
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function delete_review($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('reviews',$data);	
	}
	
	function delete_teacher($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('user',$data);
	}
	
	function email_exist($email)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$query = $this->db->get();
		return $query->num_rows();		
	}

	function get_appointments_json($id,$usertype,$status)
	{
		$this->db->select('appointments.id as appointment_id,appointments.date,schedule_time.time,appointments.place,appointments.status,
				(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
				(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
				(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
				(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name');
		$this->db->from('appointments');
		$this->db->join('schedule_time','schedule_time.id = appointments.time');
		if($usertype == "2")
		{
			$this->db->where('teacher_id',$id);
		}
		elseif($usertype == "3")
		{
			$this->db->where('student_id',$id);
		}
		if($status != "")
		{
			$this->db->where('status',$status);
		}
		$query = $this->db->get();
		return $query->result();			
	}

	function appointments_pagination($id,$usertype,$status,$item_per_page,$position,$teacher,$student)
	{
		$this->db->limit($item_per_page,$position);
		$this->db->select('appointments.id,appointments.date,schedule_time.time,appointments.place,appointments.status,
			(select last_name from user where id = appointments.student_id and active = 1) as student_last_name,
			(select first_name from user where id = appointments.student_id and active = 1) as student_first_name,
			(select last_name from user where id = appointments.teacher_id and active = 1) as teacher_last_name,
			(select first_name from user where id = appointments.teacher_id and active = 1) as teacher_first_name,
			(select count(*) from appointment_messages 
				where appointment_messages.appointment_id = appointments.id 
				and appointment_messages.status = "NEW") as new_message
		');
		$this->db->from("appointments");
		
		if($teacher != "-")
		{
			$this->db->where('teacher_id',$teacher);	
		}
		
		if($student != "-")
		{
			$this->db->where('student_id',$student);	
		}

		$this->db->join("schedule_time","schedule_time.id = appointments.time");
		$this->db->order_by("appointments.date", "asc");

		if($status != "-"){
			$this->db->where('appointments.status',$status);	
		}

        if($usertype == 2){
        	$this->db->where('teacher_id',$id);
        }else if($usertype == 3){
        	$this->db->where('student_id',$id);
        }

		$result = $this->db->get();
		return $result->result_array();
	}

	function appointment_pagination_count($id,$usertype,$status,$teacher,$student){
		$this->db->select("*");
		$this->db->from("appointments");

		if($teacher != "-")
		{
			$this->db->where('teacher_id',$teacher);	
		}
		
		if($student != "-")
		{
			$this->db->where('student_id',$student);	
		}

		if($usertype == 2)
		{
			$this->db->where('teacher_id',$id);
		}
		else if($usertype == 3)
		{
			$this->db->where('student_id',$id);
		}

		if($status != "-"){
			$this->db->where('status',$status);	
		}
		$result = $this->db->get();
		return $result->num_rows();		
	}

	function check_availability($id,$date,$teacher_id){
		$query_string = "SELECT * FROM appointments WHERE date = '{$date}' AND teacher_id = {$teacher_id}";
		$query = $this->db->query($query_string);
		if($query->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function get_appointments($id="",$usertype,$appointment_id="",$start_of_month='',$end_of_month=''){
		$query_string = "SELECT a.*,
						t.id as teacher_id,
						t.first_name as teacher_fname,
		  				t.last_name as teacher_lname,
		  				t.photo as teacher_photo,
		  				s.id as student_id,
		  				s.first_name as student_fname,
		  				s.last_name as student_lname,
		  				s.photo as student_photo,
		  				st.time as schedule_time,
		  				(SELECT count(*) FROM appointment_messages am WHERE am.appointment_id = a.id and am.status = 0) as messages
		  				FROM appointments a 
						LEFT JOIN user as t ON t.id = a.teacher_id
						LEFT JOIN user as s ON s.id = a.student_id
						LEFT JOIN schedule_time st ON st.id = a.time ";
		
		if($appointment_id == ""){
			if($usertype != 1){
				$query_string .= " WHERE (a.teacher_id = {$id} OR a.student_id = {$id})";
			}else{
				$query_string .= " WHERE ";
			}
		}else{
			$query_string .= " WHERE a.id = {$appointment_id}";
		}

		if($start_of_month != "" && $end_of_month != ""){
			if($usertype != 1){	
				$query_string .= " AND date >= '{$start_of_month}' AND date <= '{$end_of_month}'";
			}else{
				$query_string .= " date >= '{$start_of_month}' AND date <= '{$end_of_month}'";
			}
		}

		$query_string .= " ORDER BY a.date";

				
		$query = $this->db->query($query_string);


		$result = $query->result_array();


		$events = array();
		if(count($result) > 0)
		{
			
			foreach($result as $key => $value){
				if($usertype == 1){
					$title = "Teacher : ".ucfirst($value['teacher_fname'])." ".ucfirst($value['teacher_lname'])." / Student : ".ucfirst($value['student_fname'])." ".ucfirst($value['student_lname']);
				}else if($usertype == 2){
					$title = "Student : ".ucfirst($value['student_fname'])." ".ucfirst($value['student_lname']);
				}else{
					$title = "Teacher : ".ucfirst($value['teacher_fname'])." ".ucfirst($value['teacher_lname']);
				}

				$time 		= explode("-",$value['schedule_time']);			

				$data['id'] 		= $value['id'];
				$data['title'] 		= $title;
				$data['start'] 		= str_replace(" ", "T", date("Y-m-d H:i:s",strtotime($value['date']." ".$time[0])));
				$data['end'] 		= str_replace(" ", "T", date("Y-m-d H:i:s",strtotime($value['date']." ".$time[1])));
				
				if($value['status'] == "PENDING"){
					$color = "#2980b9";//BELIZE HOLE
				}else if($value['status'] == "APPROVED"){
					$color = "#2ecc71";//EMERALD
				}else if($value['status'] == "FINISHED"){
					$color = "#8e44ad";//WISTERIA
				}else if($value['status'] == "REJECTED"){
					$color = "#34495e";//WET ASPHALT
				}else if($value['status'] == "CANCELLED"){
					$color = "#7f8c8d";//ASBESTOS
				}

				$data['status'] 		= $value["status"];
				$data['color'] 			= $color;
				$data['teacher_id'] 	= $value['teacher_id'];
				$data['student_id'] 	= $value['student_id'];
				$data['teacher_lname'] 	= ucfirst($value['teacher_lname']);
				$data['teacher_fname'] 	= ucfirst($value['teacher_fname']);
				$data['student_lname'] 	= ucfirst($value['student_fname']);
				$data['student_fname'] 	= ucfirst($value['student_fname']);
				$data['appointment_date'] 	= date("m-d-Y",strtotime($value['date']));	
				$data['schedule_time'] 		= $value['schedule_time'];
				$data['place'] 			= $value['place'];

				array_push($events,$data);
			}

			return $events;
		}


	}

	public function check_appointment_validity($id,$teacher_id,$date,$schedule_id){

		$query_string = "SELECT * FROM appointments WHERE student_id != {$id} 
							AND teacher_id = {$teacher_id} 
							AND date = '{$date}' 
							AND time = {$schedule_id} 
							AND status IN ('PENDING','APPROVED')";

		$query = $this->db->query($query_string);
		$result = $query->row_array();

		if(count($result) > 0){
			return false;
		}else{
			return true;
		}

	}

	public function get_notifications($user_id){
		$query_string = "SELECT * FROM notifications WHERE user_to = {$user_id} AND seen = 0";

		$query = $this->db->query($query_string);
		$result = $query->result_array();		

		return $result;
	}

}
?>