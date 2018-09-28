<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends HrController {

	 function __construct() {
        // Call the Model constructor
        parent::__construct();
         $this->user = 'HR Manager';
         $this->load->model('mod_employees');
    }

	public function index()
	{
		#--------------- load view--------------#	
		$data['title'] = 'Employees';
		$data["subview"] = "hr/employees/index";
		$this->load->view('hr_layout', $data);
	}

	public function get_employees()
	{
		$list = $this->mod_employees->get_employees();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {

        	$action = '<ul class="for_editing_deleting">
                        <li><a href="'.SURL.HR.'/employees/edit/'.$value->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" title="edit"></i></a></li>
                        <li><a onclick="confirm_delete(\''.SURL.HR.'/employees/delete/'.$value->id.'\')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i></a></li>
                        </ul>';

            $no++;
            $row = array();
			
            $row[] = $no.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
            $row[] = $value->fname;
            $row[] = $value->lname;
            $row[] = $value->user_status;


 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mod_employees->get_count(),
                        "recordsFiltered" => $this->mod_employees->get_count(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

	}

	public function add()
	{
		if($this->input->post()){
			$add_employee = $this->mod_employees->add_employee();
			if($add_employee){
				$this->session->set_flashdata('ok_message', "-Employee record added successfully!");
					redirect(SURL.HR.'/employees');
			}else{
				$this->session->set_flashdata('err_message', "Something went wrong.");
					redirect(SURL.HR.'/employees/add');
			}
		}else{
		#--------------- load view--------------#	
		$data['title'] = 'Add employee';
		$data["subview"] = "hr/employees/add";
		$this->load->view('hr_layout', $data);
	}
	}

	public function edit($id)
	{
		$data['employee'] = $this->mod_employees->get_employees($id);
		#--------------- load view--------------#	
		$data['title'] = 'Edit employee';
		$data["subview"] = "hr/employees/edit";
		$this->load->view('hr_layout', $data);
	}
	public function update($id)
	{
		if($this->input->post()){
			$update_employee = $this->mod_employees->update_employee($id);
			if($update_employee){
				$this->session->set_flashdata('ok_message', "-Employee record updated successfully!");
					redirect(SURL.HR.'/employees');
			}else{
				$this->session->set_flashdata('err_message', "Something went wrong.");
					redirect(SURL.HR.'/employees/edit/'.$id);
			}
		}else{
				$this->session->set_flashdata('err_message','Post data not found');
					redirect(SURL.HR.'/employees/edit/'.$id);
	}
	}

	public function delete($id)
	{
		if($id &&  is_numeric($id)){
			$delete_employee = $this->mod_employees->delete_employee($id);
			if($delete_employee){
				$this->session->set_flashdata('ok_message', "-Employee record deleted successfully!");
					redirect(SURL.HR.'/employees');
			}else{
				$this->session->set_flashdata('err_message', "Something went wrong.");
					redirect(SURL.HR.'/employees');
			}
		}else{
				$this->session->set_flashdata('err_message','Id not correct.');
					redirect(SURL.HR.'/employees');
	}
	}


	
}
