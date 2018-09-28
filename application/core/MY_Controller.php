<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class CommonController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->lang->load('text_lang');
		$this->config->set_item('language', 'french');
    }
}
class AdminController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
		$this->checkLoginStatus();	

    }

    protected function checkLoginStatus() {
       if (!($this->session->userdata('user_id')) || $this->session->userdata('user_type')!=1) {    
            redirect(SURL.'login');
        }
    }
	
}

class ManagerController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLoginStatus();    

    }

    protected function checkLoginStatus() {
     if (!($this->session->userdata('user_id')) || $this->session->userdata('user_type')!=2) {    
            redirect(SURL.'login');
        }
    }

}

class HrController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    $this->checkLoginStatus();  

    }

    protected function checkLoginStatus() {
       if (!($this->session->userdata('user_id')) || $this->session->userdata('user_type')!=3) {      
            redirect(SURL.'login');
        }
    }
	
}


?>