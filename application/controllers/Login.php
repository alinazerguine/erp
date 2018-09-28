<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CommonController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->load->model('mod_login');     
	}

	public function index()
	{

		if($this->session->userdata('user_type')){
			if($this->session->userdata('user_type')==1){
				redirect(SURL.ADMIN);
			}elseif($this->session->userdata('user_type')==2){
				redirect(SURL.SITE_MANAGER);
			}elseif($this->session->userdata('user_type')==3){
				redirect(SURL.HR);
			}
		}else{
			$this->load->view('login');
		}
	}

	public function sign_in()
	{
		if($this->input->post()){
			$valid_user = $this->mod_login->validate_user();
			if($valid_user){
				if($valid_user==1){
					redirect(SURL.ADMIN);
				}elseif($valid_user==2){
					redirect(SURL.SITE_MANAGER);
				}elseif($valid_user==3){
					redirect(SURL.HR);
				}
			}else{
				$this->session->set_flashdata('err_message', "-Email or password does not match!");
				redirect(SURL);
			}
			
		}
		//echo $this->input->post('user_type');exit;
		
	}

	public function forgot_password()
	{
		if($this->input->post()){
				$valid_user = $this->mod_login->send_password();
				if($valid_user){
				$this->session->set_flashdata('ok_message', "-Change password link sent at this email!");
				redirect(SURL);
			}else{
				$this->session->set_flashdata('err_message', "-Email does not match!");
				redirect(SURL.'login/forgot_password');
			}
		}else{
			$this->load->view('forgot');
		}
		
	}

	public function change_password($ref_link)
	{
		if($ref_link){
				$valid_link = $this->mod_login->check_link($ref_link);
				if($valid_link){
				$data['ref_link'] = $ref_link;
				$this->load->view('change_password',$data);
			}else{				
			$this->session->set_flashdata('err_message', "-Invalid or expired reference link!");
				redirect(SURL);
		}
	}else{
		$this->session->set_flashdata('err_message', "-Invalid or expired reference link!");
				redirect(SURL);
	}
		
	}

	public function update_password()
	{
		if($this->input->post()){
				$valid_user = $this->mod_login->update_password();
				if($valid_user){
				$this->session->set_flashdata('ok_message', "-Password update successfully!");
				redirect(SURL);
			}else{
				$this->session->set_flashdata('err_message', "-Invalid reference link!");
				redirect(SURL);
			}
		}else{
			$this->session->set_flashdata('err_message', "-Something wrong with post data!");
				redirect(SURL);
		}
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(SURL);
	}
}
