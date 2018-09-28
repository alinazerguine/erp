<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sites extends ManagerController {

	 function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->user = 'Site Manager';
        $this->load->model('mod_sites');
        $this->load->model('mod_common');
        ini_set('max_execution_time', 0); 
    }

	public function index()
	{
		/*$this->mod_common->exact_connect();
		$total_sales_invoices=0;
		$this->mod_common->exact_turnOver_api('',$total_sales_invoices);*/

		$data['total_turnover'] = $this->mod_sites->total_turnover();
		$data['total_inprogress'] = $this->mod_sites->total_inprogress();
		$data['total_sites'] = $this->mod_sites->total_sites();
		$data['offer_pending'] = $this->mod_sites->count_offer_by_status("En attente");
		$data['offer_accepted'] = $this->mod_sites->count_offer_by_status("Accepté");
		$data['offer_canceled'] = $this->mod_sites->count_offer_by_status("Annulé");
		$data['offer_rejected'] = $this->mod_sites->count_offer_by_status("Rejeté");
		#-------------- market -----------------#
		$data['general_companies'] = $this->mod_sites->count_client_type("Entreprise générale");
		$data['public_entities'] = $this->mod_sites->count_client_type("Pouvoir public");
		$data['private_companies'] = $this->mod_sites->count_client_type("Privé - Entreprise");
		$data['private_person'] = $this->mod_sites->count_client_type("Privé - Particulier");
		#-------------- get all Notification -----------------#
		$data['notifications'] = $this->mod_sites->get_notifications();
		#--------------- load view--------------#	
		$data['title'] = 'End Construction';
		$data["subview"] = "site_manager/dashbaord";
		$this->load->view('manager_layout', $data);
	}

	public function my_projects()
	{
		#--------------- load view--------------#	
		$data['title'] = MY_CONSTRUCTION_SITES;
		$data["subview"] = "site_manager/sites";
		$this->load->view('manager_layout', $data);
	}

	public function get_manager_sites()
	{
		$progress_col = $_POST['columns'][5]['search']['value']; 
		$list = $this->mod_sites->get_manager_sites();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {

			#---------------- get progress data----------#
			$progress_data = $this->mod_sites->get_progress_data($value->id);
			#---------------- get site working hours----------#
			//$working_hour_site = $this->mod_sites->working_hour_site($value->id);
			$working_hour = decimalHours($value->total_worked_hours);

			if($progress_data){
					#--------------- exact api call-----------------#
					$real_purchase=$this->mod_sites->get_exact_purchase($value->reference_no);	
                    $resultant1 =  $progress_data->purchase - $real_purchase;
                    $resultant2 = $progress_data->total_hours - ($working_hour * $progress_data->hourly_rate);

                    $total_in_progress = abs(round((($resultant1 + $resultant2) / $value->sale_price)*100,2));
                   
                  }else{
                   $total_in_progress = abs(round(($real_purchase/ $value->sale_price)*100,2));;
                  }
            
			 $smiley_string = '';
			 $smiley='';
			
			 if($total_in_progress==0){
			 	$smiley_string = '<span class="green_smiley"><img src="'.SURL.'assets/images/green.png" /></span>';
			 	$smiley = 'green';
			 }else if($total_in_progress<10){
			 	$smiley_string = '<span class="orange_smiley"><img src="'.SURL.'assets/images/yellow.png" /></span>';
			 	$smiley = 'orange';
			 }else if($total_in_progress>10){
			 	$smiley_string = '<span class="red_smiley"><img src="'.SURL.'assets/images/red.png" /></span>';
			 	$smiley = 'red';
			 }            
			
			$no++;
			$row = array();
			if($progress_col!=''){
			if($progress_col==$smiley){

			$row[] = '#'.$value->reference_no.'<input type="hidden" id="row_id" value="'.$value->site_id.'" />';
			$row[] = $value->description;
			$row[] = convertTime($value->schedule_hours);
			$row[] = convertTime(decimalHours($value->total_worked_hours));
			$row[] = convertTime($value->schedule_hours - decimalHours($value->total_worked_hours));
			$row[] = $smiley_string;
			
			//$row[] = $action;
			$data[] = $row;
			}
			}else{
				$row[] = '#'.$value->reference_no.'<input type="hidden" id="row_id" value="'.$value->site_id.'" />';
				$row[] = $value->description;
				$row[] = convertTime($value->schedule_hours);
				$row[] = convertTime(decimalHours($value->total_worked_hours));
				$row[] = convertTime($value->schedule_hours - decimalHours($value->total_worked_hours));
				$row[] = $smiley_string;
			
			//$row[] = $action;
			$data[] = $row;
			}

		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_sites->get_count(),
			"recordsFiltered" => $this->mod_sites->get_count(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);

	}

	
	public function detail($id)
	{
		$executed_sites = $this->mod_sites->get_manager_sites($id);
		$data['executed_sites'] =$executed_sites;		
		$data['progress_bar'] = get_progress_bar($id);
		#---------------- get progress data----------#
			$progress_data = $this->mod_sites->get_progress_data($id);
			#---------------- get site working hours----------#
			$working_hour_site = $this->mod_sites->working_hour_site($id);
			$working_hour = decimalHours($working_hour_site->total_worked_hours);

			if($progress_data){
					#--------------- exact api call-----------------#
					$real_purchase=$this->mod_sites->get_exact_purchase($executed_sites->reference_no);	
                    $resultant1 =  $progress_data->purchase - $real_purchase;
                    $resultant2 = $progress_data->total_hours - ($working_hour * $progress_data->hourly_rate);

                    $total_in_progress = round((($resultant1 + $resultant2) / $executed_sites->sale_price)*100,2);
                   
                  }else{
                    $total_in_progress = 0;
                  }            
			 
		$data['total_in_progress']=$total_in_progress;
		$get_last_upload=$this->mod_sites->get_last_upload($id);
		
		if($get_last_upload){
			$data['upload_date'] = date("d/m/Y",strtotime($get_last_upload->upload_date));
			$data['upload_path'] = $get_last_upload->upload_path;
		}else{
			$data['upload_date'] = '';
			$data['upload_path'] = '';
		}	
		#--------------- load view--------------#	
		$data['title'] = 'Offer Detail';
		$data["subview"] = "site_manager/detail";
		$this->load->view('manager_layout', $data);
	}

	public function import_status($id)
	{
		$file_path='';
		#------------------ for import data-------------------#
		if (isset($_FILES['import_data']['name']) && !empty($_FILES['import_data']['name'])) {
			//print_r($_FILES);exit;
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

			//echo '<pre>';print_r($cells);exit;

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
		$data['executed_sites'] = $this->mod_sites->get_manager_sites($id);
		$last_progress = $this->mod_sites->get_last_progress($id);
		if($last_progress){
			$data['upload_date'] = date("d/m/Y",strtotime($last_progress->upload_date));
			$data['upload_path'] = $last_progress->upload_path;
		}else{
			$data['upload_date'] = '';
			$data['upload_path'] = '';
		}
		$data['upload_path'] = $file_path;
		#--------------- load view--------------#	
		$data['title'] = 'Import Status';
		$data["subview"] = "site_manager/import_status";
		$this->load->view('manager_layout', $data);
	}

	public function documents($id)
	{
		$data['offer'] = $this->mod_sites->get_manager_sites($id);
		/*$purchase_entryId = array();
		$this->mod_common->exact_purchase_api_entryid($data['offer']->reference_no,'',$purchase_entryId); 
		$data['documents'] = $this->mod_common->exact_document_api($purchase_entryId);	*/
		//$data['documents'] = get_exact_document($data['offer']->reference_no);	
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['reference_no'] = $data['offer']->reference_no;
		$data['title'] = DOCUMENTS;
		$data["subview"] = "site_manager/documents";
		$this->load->view('manager_layout', $data);
	}

	public function get_documents($referenceNo)
	{

		$list = get_exact_document_dt($referenceNo);	
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {			   

			$no++;
			$row = array();
			
			
			$row[] = $value->supplier_name;
			$row[] = '<a href="'.$value->document_url.'" target="_blank"><img src="'.SURL.'assets/images/pdf.png" style="width: 10%;"></a>';
			$row[] = date("d/m/Y",strtotime($value->created));
			$row[] = numberFormat($value->purchase).CURRENCY;

			$data[] = $row;
		}
			
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => count_exact_document($referenceNo),
			"recordsFiltered" => count_exact_document($referenceNo),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function end_site($id)
	{
		$this->mod_sites->end_site($id);
		redirect(SURL.'site_manager/sites/detail/'.$id);
	}

	public function reminder(){
		$cookie= array(
 
           'name'   => 'rule_reminder',
 
           'value'  => 1,
 
           'expire' => '300',
 
       );
 
       $this->input->set_cookie($cookie);
 
       echo "Congragulatio Cookie Set";
	}

	public function save_invoice()
	{
		$save_invoice = $this->mod_sites->save_invoice();

		if($save_invoice){
				$this->session->set_flashdata('ok_message', "-Progress status added successfully!");
				redirect(SURL.'site_manager/sites/detail/'.$this->input->post('site_id'));
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
				redirect(SURL.'site_manager/sites/detail/'.$this->input->post('site_id'));
			}
		
	}

	public function billing($id)
	{
		$data['offer'] = $this->mod_sites->get_manager_sites($id);
		$data['billing'] = $this->mod_sites->get_site_billing($id);
		$data['progress_bar'] = get_progress_bar($id);
		$data['invoices'] = $this->mod_sites->get_invoices($data['offer']->reference_no);
		#--------------- load view--------------#	
		$data['title'] = BILLING_DETAIL;
		$data["subview"] = "site_manager/billing_detail";
		$this->load->view('manager_layout', $data);
	}

	public function progress($id)
	{
		$data['offer'] = $this->mod_sites->get_manager_sites($id);
		$data['progress'] = $this->mod_sites->get_progress_data($id);
		$working_hour_site = $this->mod_sites->working_hour_site($id);
		$data['working_hour_site'] = decimalHours($working_hour_site->total_worked_hours);
		#--------------- exact api call-----------------#
		//$real_purchase=0;//$this->mod_common->exact_purchase_api($data['offer']->reference_no);
		//$this->mod_common->exact_purchase_api($data['offer']->reference_no,'',$real_purchase);	

		 $data['real_purchase'] =$this->mod_sites->get_exact_purchase($data['offer']->reference_no);	
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['title'] = PROGRESS;
		$data["subview"] = "site_manager/progress";
		$this->load->view('manager_layout', $data);
	}
	

	
}
