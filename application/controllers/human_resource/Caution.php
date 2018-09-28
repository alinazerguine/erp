<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caution extends HrController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'HR Manager';
		$this->load->model('mod_caution');
	}

	public function sites()
	{
		#--------------- load view--------------#	
		$data['title'] = CUATION_SITE;
		$data["subview"] = "hr/caution";
		$this->load->view('hr_layout', $data);
	}

	public function get_sites()
	{
		$list = $this->mod_caution->get_sites();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			
			$no++;
			$row = array();

			if($value->duration_for_final_acceptance && $value->duration_for_final_acceptance<=1){
				$duration = $value->duration_for_final_acceptance. ' an';
			}elseif($value->duration_for_final_acceptance && $value->duration_for_final_acceptance>1){
				$duration = $value->duration_for_final_acceptance. ' ans';
			}else{
				$duration='';
			}
			
			$row[] = '#'.$value->reference_no.'<input type="hidden" id="row_id" value="'.$value->site_id.'" />';
			$row[] = $value->description;
			$row[] = $value->caution_reference;

			$row[] = ($value->admin_provional_accpt_date!='0000-00-00' && $value->admin_provional_accpt_date!='') ? date("d/m/Y",strtotime($value->admin_provional_accpt_date)) : '';

			$row[] = ($value->financial_provional_accpt_date!='0000-00-00' && $value->financial_provional_accpt_date!='') ? date("d/m/Y",strtotime($value->financial_provional_accpt_date)) : '';

			$row[] = $duration;

			$row[] = ($value->admin_final_accpt_date!='0000-00-00' && $value->admin_final_accpt_date!='') ? date("d/m/Y",strtotime($value->admin_final_accpt_date)) : '';

			$row[] = ($value->financial_final_accpt_date!='0000-00-00' && $value->financial_final_accpt_date!='') ? date("d/m/Y",strtotime($value->financial_final_accpt_date)) : '';
			
			//$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_caution->get_count_sites(),
			"recordsFiltered" => $this->mod_caution->get_count_sites(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function detail($id){
		$data['caution'] = $this->mod_caution->get_sites($id);
		#--------------- load view--------------#	
		$data['title'] = CUATION_SITE;
		$data["subview"] = "hr/caution_detail";
		$this->load->view('hr_layout', $data);
	}

	public function update(){
		$update = $this->mod_caution->update();
		redirect(SURL.'human_resource/caution/sites');
	}

	
	
}
