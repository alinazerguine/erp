<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends HrController {

	 function __construct() {
        // Call the Model constructor

        parent::__construct();
         $this->user = 'HR Manager'; 
         $this->load->model('mod_admin_dashboard');
    }

	public function index()
	{
		$data['notifications'] = $this->mod_admin_dashboard->get_notifications(1);
		#--------------- load view--------------#	
		$data['title'] = 'Dashboard';
		$data["subview"] = "hr/dashbaord";
		$this->load->view('hr_layout', $data);
	}

	public function unread_message($notify_to){

		$unread_message = $this->mod_admin_dashboard->unread_message($notify_to);
		echo json_encode($unread_message);
	}

	public function read_message($id){

		$unread_message = $this->mod_admin_dashboard->read_message($id);
	}

	
}
