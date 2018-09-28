<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endconstruction extends AdminController {

	 function __construct() {
        // Call the Model constructor
        parent::__construct();
         $this->user = 'Administrator';
         $this->load->model('mod_endconstruction');
         $this->load->model('mod_common');
         ini_set('max_execution_time', 0); 
    }

	public function index()
	{
		#--------------- load view--------------#	
		$data['title'] = 'End Construction';
		$data["subview"] = "admin/end_construction/end_construction";
		$this->load->view('admin_layout', $data);
	}

	public function get_completed_sites()
	{
		$list = $this->mod_endconstruction->get_completed_sites();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {

			$action = '<ul class="for_editing_deleting">
			<li><a href="'.SURL.'admin/endconstruction/detail/'.$value->id.'"><i class="fa fa-eye" aria-hidden="true" title="detail"></i></a></li>                        
			</ul>';

			$no++;
			$row = array();
			
			$row[] = $value->reference_no.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
			$row[] = $value->description;
			$row[] = $value->company;
			$row[] = $value->market;
			$row[] = $value->client;
			$row[] = convertTime($value->working_hours);
			$row[] = numberFormat($value->sale_price).CURRENCY;		
			$row[] = $value->working_hours;  
			$row[] = $value->sale_price;                

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_endconstruction->get_count(),
			"recordsFiltered" => $this->mod_endconstruction->get_count(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);

	}

	
	public function detail($id)
	{
		$data['completed_site'] = $this->mod_endconstruction->get_completed_sites($id);
		$data['progress_bar'] = get_progress_bar($id);

		$get_last_upload=$this->mod_endconstruction->get_last_upload($id);
		
		if($get_last_upload){
			$data['upload_date'] = date("d/m/Y",strtotime($get_last_upload->upload_date));
			$data['upload_path'] = $get_last_upload->upload_path;
		}else{
			$data['upload_date'] = '';
			$data['upload_path'] = '';
		}	
		#--------------- load view--------------#	

		$data['title'] = 'Offer Detail';
		$data["subview"] = "admin/end_construction/detail";
		$this->load->view('admin_layout', $data);
	}

	public function import_status($id)
	{
		$file_path='';
		#------------------ for import data-------------------#
		if (isset($_FILES['import_data']['name']) && !empty($_FILES['import_data']['name'])) {
			 $file_path = $this->input->post('file_path');
			$file = $_FILES['import_data']['tmp_name'];
			//load the excel library
			$this->load->library('excel_reader');
			$this->excel_reader->read($file);
			if(count($this->excel_reader->sheets)>1){
			// Get the contents of the first worksheet
			$worksheet = $this->excel_reader->sheets[1];

			$numRows = $worksheet['numRows']; // ex: 14
			$numCols = $worksheet['numCols']; // ex: 4
			$cells = $worksheet['cells']; // the 1st row are usually the field's name

			$reference_string = $cells[2][2];
			$reference_arr = explode(' ', $reference_string);
			if(count($reference_arr)>1){
			$data['reference']= $reference_arr[count($reference_arr)-1];
			$client = explode(':',$cells[4][2]);
			$data['company']= utf8_encode($client[1]); 
			$data['progress_state']= $cells[1][28]; 
			$period= explode(' ', $cells[2][28]);
			$data['start_period']= checkValidDate($period[2]);
			$data['end_period']= checkValidDate($period[4]);
			$data['period_bill']= $cells[4][28];
			$data['forcasted']= $cells[6][11];
			$data['vat']= ($cells[4][28]*VAT_RATE)/100;
			$data['total_with_vat']= $cells[4][28] + (($cells[4][28]*VAT_RATE)/100);

			#------------- for progress page-------#
			$data['purchase'] = $cells[3][41] + $cells[3][49];
			$data['total_hours'] = $cells[3][45] * $cells[1][11];
			$data['hours'] = $cells[3][45];
			$data['hourly_rate'] = $cells[1][11];
			$data['general_fee'] = $cells[3][53];
			$data['selling_price'] = $cells[1][41];
			}else{
			$this->session->set_flashdata('err_message', "Il semblerait que vous ayez tenté d’importer un mauvais fichier Securysat. Veuillez recommencer avec un autre.");		
			$data['reference']= '';
			$data['company']= ''; 
			$data['progress_state']= ''; 
			$data['start_period']='';
			$data['end_period']= '';
			$data['period_bill']= '';
			$data['forcasted']= '';
			$data['vat']= '';
			$data['total_with_vat']= '';
			$data['purchase']='';
			$data['total_hours']='';
			$data['hours']='';
			$data['hourly_rate']='';
			$data['general_fee']='';
			$data['selling_price']='';
		}
	}else{
			$this->session->set_flashdata('err_message', "Il semblerait que vous ayez tenté d’importer un mauvais fichier Securysat. Veuillez recommencer avec un autre.");		
			$data['reference']= '';
			$data['company']= ''; 
			$data['progress_state']= ''; 
			$data['start_period']='';
			$data['end_period']= '';
			$data['period_bill']= '';
			$data['forcasted']= '';
			$data['vat']= '';
			$data['total_with_vat']= '';
			$data['purchase']='';
			$data['total_hours']='';
			$data['hours']='';
			$data['hourly_rate']='';
			$data['general_fee']='';
			$data['selling_price']='';
		}
			

		}else{
			$data['reference']= '';
			$data['company']= ''; 
			$data['progress_state']= ''; 
			$data['start_period']='';
			$data['end_period']= '';
			$data['period_bill']= '';
			$data['forcasted']= '';
			$data['vat']= '';
			$data['total_with_vat']= '';
			$data['purchase']='';
			$data['total_hours']='';
			$data['hours']='';
			$data['hourly_rate']='';
			$data['general_fee']='';
			$data['selling_price']='';
			
		}
		$data['completed_site'] = $this->mod_endconstruction->get_completed_sites($id);
		$last_progress = $this->mod_endconstruction->get_last_progress($id);
		if($last_progress){
			$data['upload_date'] = date("d/m/Y",strtotime($last_progress->upload_date));
			$data['upload_path'] = $last_progress->upload_path;
		}else{
			$data['upload_date'] = '';
			//$data['upload_path'] = '';
		}
		$data['upload_path'] = $file_path;
		#--------------- load view--------------#	
		$data['title'] = 'Import Status';
		$data["subview"] = "admin/end_construction/import_status";
		$this->load->view('admin_layout', $data);
	}

	public function save_invoice()
	{
		$save_invoice = $this->mod_endconstruction->save_invoice();

		if($save_invoice){
				$this->session->set_flashdata('ok_message', "-Progress status added successfully!");
				redirect(SURL.'admin/endconstruction/detail/'.$this->input->post('site_id'));
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
				redirect(SURL.'admin/endconstruction/detail/'.$this->input->post('site_id'));
			}
		
	}

	public function billing($id)
	{
		$data['offer'] = $this->mod_endconstruction->get_completed_sites($id);
		$data['billing'] = $this->mod_endconstruction->get_site_billing($id);
		$data['progress_bar'] = get_progress_bar($id);
		#--------------- load view--------------#	
		$data['title'] = 'Billing Detail';
		$data["subview"] = "admin/end_construction/billing_detail";
		$this->load->view('admin_layout', $data);
	}

	public function progress($id)
	{
		$data['offer'] = $this->mod_endconstruction->get_completed_sites($id);
		$data['progress'] = $this->mod_endconstruction->get_progress_data($id);
		$working_hour_site = $this->mod_endconstruction->working_hour_site($id);
		$data['working_hour_site'] = decimalHours($working_hour_site->total_worked_hours);
		#--------------- exact api call-----------------#
		/*$real_purchase=0;
		$this->mod_common->exact_purchase_api($data['offer']->reference_no,'',$real_purchase);*/
		 $data['real_purchase'] = $this->mod_endconstruction->get_exact_purchase($data['offer']->reference_no);
		$data['billing'] = $this->mod_endconstruction->get_site_billing($id);
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['title'] = 'Site Progress';
		$data["subview"] = "admin/end_construction/progress";
		$this->load->view('admin_layout', $data);
	}

	public function documents($id)
	{
		$data['offer'] = $this->mod_endconstruction->get_completed_sites($id);
		/*$purchase_entryId = array();
		$this->mod_common->exact_purchase_api_entryid($data['offer']->reference_no,'',$purchase_entryId); 

		$data['documents'] = $this->mod_common->exact_document_api($purchase_entryId);	*/
		$data['documents'] = get_exact_document($data['offer']->reference_no);	
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['reference_no'] = $data['offer']->reference_no;
		$data['title'] = DOCUMENTS;
		$data["subview"] = "admin/end_construction/documents";
		$this->load->view('admin_layout', $data);
	}

	

	
}
