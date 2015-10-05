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
				
				$this->load->view("menu/menu",$data);
				
				$data["appointment_list"] = $this->list_model->check_appointments($session_data['id'],$session_data["usertype"],$status);
				
				if($session_data["usertype"] == 3)
				{
					$this->load->view("student/student_appointment",$data);
				}
				elseif($session_data["usertype"] == 2)
				{
					$data["review_count"] = $this->list_model->review_count($session_data["id"]);
					$this->load->view("teacher_appointment",$data);
				}
				elseif($session_data["usertype"] == 1)
				{
					$this->load->view("admin_home_page",$data);
				}
				