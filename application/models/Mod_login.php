<?php


class Mod_login extends CI_Model {

	public function validate_user()
	{
		$email = $this->input->post('login_email');
		$password = $this->input->post('password');

		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("email",$email);
		$this->db->where("password",sha1($password));

		$query = $this->db->get();
		$result = $query->row();
		//print_r($result);exit;
		if(count($result)){

				$newdata = array(
					'user_id'  => $result->id,
					'email'  => $result->email,
					'user_name' => $result->name,
					'user_type' => $result->user_type,
					'user_image' => $result->image
					);
					
				$this->session->set_userdata($newdata);

				if($result->user_type==1){
					$this->session->set_userdata('designation', ADMIN_USER);
					}elseif($result->user_type==2){
					$this->session->set_userdata('designation', MANAGER_USER);
					}elseif($result->user_type==3){
					$this->session->set_userdata('designation', HR_USER);
					}


			return $result->user_type;
		}else{
			return false;
		}
	}

	public function send_password(){
		$email = $this->input->post('reg_email');

		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("email",$email);

		$query = $this->db->get();
		$result = $query->row();
		//print_r($result);exit;
		if(count($result)){
			$this->send_mail($email);
			return true;
		}else{
			return false;
		}

	}

	public function check_link($ref_link){
		
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("ref_link",$ref_link);

		$query = $this->db->get();
		$result = $query->row();
		//print_r($result);exit;
		if(count($result)){
			return true;
		}else{
			return false;
		}

	}

	public function update_password(){
		
		$password = $this->input->post('password');
		
		$this->db->where("email",hex2bin($this->input->post('ref_link')));
		$this->db->set("password",sha1($password));
		$this->db->set("ref_link",'');
		$this->db->update("users");
		return true;		

	}

	public function send_mail($email) { 
         $from_email = "your@example.com"; 
         $to_email = $email; 

         $encode = bin2hex($email);
		$VERIFYLINK = base_url('login/change_password/').$encode;

		$this->db->update('users',array('ref_link'=>$encode),array('email'=>$email));

         $message = '
         			<table>
         			<tr>
         			<td>Dear User,</td>
         			</tr>
         			<tr>
         			<td>You had requested the change of passowrd.</td>
         			</tr>
         			<tr>
         			<td>Click below link to change your password.</td>
         			</tr>
         			<tr>
         			<td><a href="'.$VERIFYLINK.'"></a></td>
         			</tr>
         			</table>
         ';
   
         //Load email library 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Forgot password '.DEFAULT_TITLE_ADMIN); 
         $this->email->message($message); 
   		$this->email->set_mailtype("html");
         //Send mail 
         if($this->email->send()) 
        	return true;
         else 
         return false;
      } 
}
