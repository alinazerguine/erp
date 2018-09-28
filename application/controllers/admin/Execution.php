<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Execution extends AdminController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'Administrator';
		$this->load->model('mod_execution');
		$this->load->model('mod_common');
		 ini_set('max_execution_time', 0); 
	}

	public function index()
	{		
		#--------------- load view--------------#	
		$data['title'] = 'Execution';
		$data["subview"] = "admin/execution/execution";
		$this->load->view('admin_layout', $data);
		
	}

	public function get_executed_offers()
	{		
		$progress_col = $_POST['columns'][5]['search']['value']; 
		$list = $this->mod_execution->get_executed_offers();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			#--------------- exact api call-----------------#
			//$real_purchase=0;//$this->mod_common->exact_purchase_api($value->reference_no);	
			$real_purchase=$this->mod_execution->get_exact_purchase($value->reference_no);		
			#---------------- get progress data----------#
			$progress_data = $this->mod_execution->get_progress_data($value->id);
			#---------------- get site working hours----------#
			$working_hour_site = $value->total_worked_hours;//$this->mod_execution->working_hour_site($value->id);
			$working_hour = decimalHours($working_hour_site);

			if($progress_data){
					//$real_purchase = 0; // this will come from exactonline
                    $resultant1 =  $progress_data->purchase - $real_purchase;
                    $resultant2 = $progress_data->total_hours - ($working_hour * $progress_data->hourly_rate);
                     $total_work_progress = $resultant1 + $resultant2;
                    $total_in_progress = round(($total_work_progress / $value->sale_price)*100,2);
                   
                  }else{
                  	$resultant1 =  0 - $real_purchase;
                    $resultant2 = 0 - ($working_hour * $value->hourly_rate);
                  	 $total_work_progress = $resultant1 + $resultant2;
                    $total_in_progress = ($value->sale_price) ? round(($total_work_progress/ $value->sale_price)*100,2) : 0; 
                  }
            #---------------- get progress bar----------#     
			$progress = get_progress_bar($value->id);
  //echo $progress.'-';
			$progressbar = '<div class="progress">
					        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'.$progress.'%;">
					          <span class="show">'.numberFormat($progress).'%</span>
					        </div>
					      </div>';
			

			 $smiley_string = '';
			  $smiley_text = '';
			  // echo $total_in_progress.'-';
			 if($total_in_progress>=0){
			 	$smiley_text = 'green';
			 	$smiley_string = '<span class="green_smiley"><img src="'.SURL.'assets/images/green.png" /></span>';
			 }else if($total_in_progress<0 && $total_in_progress>(-10)){
			 	$smiley_text = 'orange';
			 	$smiley_string = '<span class="orange_smiley"><img src="'.SURL.'assets/images/yellow.png" /></span>';
			 }else if($total_in_progress<(-10)){
			 	$smiley_text = 'red';
			 	$smiley_string = '<span class="red_smiley"><img src="'.SURL.'assets/images/red.png" /></span>';
			 }            

			$no++;
			$row = array();
			
			if($progress_col!=''){
			if($progress_col==$smiley_text){
			$remaining_bill = $value->sale_price - $value->total_bill;
			
			$row[] = $value->reference_no.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
			$row[] = $value->description;
			$row[] = $value->company;
			$row[] = $value->market;
			$row[] = $value->client;
			$row[] = $smiley_string;
			$row[] = numberFormat(($remaining_bill>0) ? $remaining_bill : 0).CURRENCY;
			$row[] = $progressbar;
			$row[] = $remaining_bill;

			$data[] = $row;
		}
			}else{
				$remaining_bill = $value->sale_price - $value->total_bill;
				
				$row[] = $value->reference_no.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
				$row[] = $value->description;
				$row[] = $value->company;
				$row[] = $value->market;
				$row[] = $value->client;
				$row[] = $smiley_string;
				$row[] = numberFormat(($remaining_bill>0) ? $remaining_bill : 0).CURRENCY;
				$row[] = $progressbar;
				$row[] = $remaining_bill;

				$data[] = $row;
			}
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_execution->get_count(),
			"recordsFiltered" => $this->mod_execution->get_count(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);

	}

	
	public function detail($id)
	{
		
		$executed_sites = $this->mod_execution->get_executed_offers($id);	
		$data['executed_sites'] =	$executed_sites;
		$data['progress_bar'] = get_progress_bar($id);
		
		#---------------- get progress data----------#
			$progress_data = $this->mod_execution->get_progress_data($id);
			#---------------- get site working hours----------#
			$working_hour_site = $this->mod_execution->working_hour_site($id);
			$working_hour = decimalHours($working_hour_site->total_worked_hours);

			if($progress_data){
					#--------------- exact api call-----------------#
					$real_purchase=$this->mod_execution->get_exact_purchase($executed_sites->reference_no);	
					//$this->mod_common->exact_purchase_api($executed_sites->reference_no,'',$real_purchase);	
                    $resultant1 =  $progress_data->purchase - $real_purchase;
                    $resultant2 = $progress_data->total_hours - ($working_hour * $progress_data->hourly_rate);

                    $total_in_progress = round((($resultant1 + $resultant2) / $executed_sites->sale_price)*100,2);
                   
                  }else{
                    $total_in_progress = 0;
                  }            
			 
		$data['total_in_progress']=$total_in_progress;
		$get_last_upload=$this->mod_execution->get_last_upload($id);

		if($get_last_upload){
			$data['upload_date'] = date("d/m/Y",strtotime($get_last_upload->upload_date));
			$data['upload_path'] = $get_last_upload->upload_path;
		}else{
			$data['upload_date'] = '';
			$data['upload_path'] = '';
		}	
		
		#--------------- load view--------------#	
		$data['title'] = 'Offer Detail';
		$data["subview"] = "admin/execution/order_detail";
		$this->load->view('admin_layout', $data);
	}

	public function import_status($id)
	{

		$file_path='';
		#------------------ for import data-------------------#
		if (isset($_FILES['import_data']['name']) && !empty($_FILES['import_data']['name'])) {
			 $file_path = $this->input->post('file_path');
			//printme($_SERVER);exit;
			//print_r($_FILES);exit;
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
			//print_r($reference_arr);exit;
			if(count($reference_arr)>1){
			$data['reference']= $reference_arr[count($reference_arr)-1];
			$client = explode(':',$cells[4][2]);
			$data['company']= utf8_encode($client[1]); 
			$data['progress_state']= $cells[1][28]; 
			$period= explode(' ', $cells[2][28]);
			//print_r($period);exit;
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
			$file_path = '';
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
		
		//$upload_path = ($this->input->post('file_path')) ? $this->input->post('file_path') : '';
		$data['executed_sites'] = $this->mod_execution->get_executed_offers($id);
		$last_progress = $this->mod_execution->get_last_progress($id);
		if($last_progress){
			$data['upload_date'] = date("d/m/Y",strtotime($last_progress->upload_date));
			$data['upload_path'] = $last_progress->upload_path;
		}else{
			$data['upload_date'] = '';
			//$data['upload_path'] = $file_path;
		}
		$data['upload_path'] = $file_path;
		//print_r($data['last_progress']);exit;
		#--------------- load view--------------#	
		$data['title'] = 'Import Status';
		$data["subview"] = "admin/execution/import_status";
		$this->load->view('admin_layout', $data);
	}

	public function save_invoice()
	{
		$save_invoice = $this->mod_execution->save_invoice();

		if($save_invoice){
				$this->session->set_flashdata('ok_message', "-Progress status added successfully!");
				redirect(SURL.'admin/execution/detail/'.$this->input->post('site_id'));
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
				redirect(SURL.'admin/execution/detail/'.$this->input->post('site_id'));
			}
		
	}

	public function billing($id)
	{
		$data['offer'] = $this->mod_execution->get_executed_offers($id);
		$data['billing'] = $this->mod_execution->get_site_billing($id);
		$data['progress_bar'] = get_progress_bar($id);
		$data['invoices'] = $this->mod_execution->get_invoices($data['offer']->reference_no);
		//print_r($data['invoices']);
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['title'] = 'Billing Detail';
		$data["subview"] = "admin/execution/billing_detail";
		$this->load->view('admin_layout', $data);
	}

	public function progress($id)
	{
		$data['offer'] = $this->mod_execution->get_executed_offers($id);
		$data['progress'] = $this->mod_execution->get_progress_data($id);
		$working_hour_site = $this->mod_execution->working_hour_site($id);
		$data['working_hour_site'] = decimalHours($working_hour_site->total_worked_hours);
		#--------------- exact api call-----------------#
		/*$real_purchase=0;
		$this->mod_common->exact_purchase_api($data['offer']->reference_no,'',$real_purchase);*/
		 $data['real_purchase'] = $this->mod_execution->get_exact_purchase($data['offer']->reference_no);
		$data['billing'] = $this->mod_execution->get_site_billing($id);
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['title'] = 'Offer Progress';
		$data["subview"] = "admin/execution/progress";
		$this->load->view('admin_layout', $data);
	}

	public function documents($id)
	{
		$data['offer'] = $this->mod_execution->get_executed_offers($id);
		//$data['documents'] = get_exact_document($data['offer']->reference_no);	
		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['reference_no'] = $data['offer']->reference_no;
		$data['title'] = DOCUMENTS;
		$data["subview"] = "admin/execution/documents";
		$this->load->view('admin_layout', $data);
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
		$this->mod_execution->end_site($id);
		redirect(SURL.'admin/endconstruction/detail/'.$id);
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

	
}
