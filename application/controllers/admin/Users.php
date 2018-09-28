<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends AdminController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'Administrator';
		$this->load->model('mod_users');
	}

	public function index()
	{
		#--------------- load view--------------#	
		$data['title'] = 'Users';
		$data["subview"] = "admin/users/index";
		$this->load->view('admin_layout', $data);
	}

	public function get_users()
	{
		$list = $this->mod_users->get_users();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {

        	$action = '<ul class="for_editing_deleting">
                        <li><a href="'.SURL.'/admin/users/edit/'.$value->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" title="edit"></i></a></li>                        
                        </ul>';

        	$user_image = ($value->image) ? base_url('assets/images/users/thumbnail/'.$value->image) : base_url('assets/images/default_user.jpg');
        	$user_type= '';
        	if($value->user_type==1){
        		$user_type = 'Administrator';
        	}elseif($value->user_type==2){
        		$user_type = 'Site Manager';
        	}elseif($value->user_type==3){
        		$user_type = 'HR Manager';
        	}
        	
            $no++;
            $row = array();
			
            $row[] = $no.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
            $row[] = $value->name;
            $row[] = $value->email;
            $row[] = $value->designation;
            $row[] = '<img src="'.$user_image.'" style="width:70px;" />';
            // $row[] = $action;

 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mod_users->get_count(),
                        "recordsFiltered" => $this->mod_users->get_count(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

	}

	public function add()
	{
		if($this->input->post()){
			$add_user = $this->mod_users->add_user();
			if($add_user){
				$this->session->set_flashdata('ok_message', "-User created successfully!");
					redirect(SURL.'admin/users');
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
					redirect(SURL.'admin/users/add');
			}

		}else{
		#--------------- load view--------------#	
			$data['title'] = 'Add User';
			$data["subview"] = "admin/users/add";
			$this->load->view('admin_layout', $data);
		}
	}

	public function edit($id)
	{
		$data['user'] = $this->mod_users->get_users($id);
		#--------------- load view--------------#	
		$data['title'] = 'Edit User';
		$data["subview"] = "admin/users/edit";
		$this->load->view('admin_layout', $data);
	}

	public function update($id)
	{
		if($id && is_numeric($id)){
			$update_user = $this->mod_users->update_user($id);
			if($update_user){
				$this->session->set_flashdata('ok_message', "-User update successfully!");
					redirect(SURL.'admin/users');
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
					redirect(SURL.'admin/users/edit/'.$id);
			}

		}else{
					$this->session->set_flashdata('err_message', 'Invalid Id.');
					redirect(SURL.'admin/users/edit/'.$id);
		}
	}


	
}
