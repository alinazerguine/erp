<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends AdminController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'Administrator';
		$this->load->model('mod_offers');
	}

	public function index()
	{
		#--------------- load view--------------#	
		$data['title'] = 'Offers';
		$data["subview"] = "admin/offer/offers";
		$this->load->view('admin_layout', $data);
	}

	public function get_offers()
	{
		$list = $this->mod_offers->get_offers();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {

			$action = '<ul class="for_editing_deleting">
			<li><a href="'.SURL.'admin/offers/detail/'.$value->id.'"><i class="fa fa-eye" aria-hidden="true" title="detail"></i></a></li>                        
			</ul>';

			$no++;
			$row = array();
			
			$row[] = '<input data="'.$value->id.'" class="checkbox" type="checkbox" name="delete_all[]" id="delete_all_'.$value->id.'" value="1" /><input type="hidden" id="row_id" value="'.$value->id.'" /><input type="hidden" id="is_new" value="'.$value->is_new.'" />';
			$row[] = $value->reference_no;
			$row[] = $value->description;
			$row[] = $value->company;
			$row[] = $value->market;
			$row[] = $value->client;
			$row[] = $value->offer;
			$row[] = date("d/m/Y",strtotime($value->created_at));
			$row[] = numberFormat($value->sale_price).CURRENCY;
			$row[] = $value->status;
			$row[] = '<textarea name="comment" data-toggle="tooltip" title="'.$value->comment.'" id="comment_'.$value->id.'" style="width: 85%;" onblur="save_comment('.$value->id.',this.value)">'.$value->comment.'</textarea>';
			//$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_offers->get_count(),
			"recordsFiltered" => $this->mod_offers->get_count(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);

	}

	public function add()
	{
		#------------------ for import data-------------------#
		if (isset($_FILES['import_data']['name']) && !empty($_FILES['import_data']['name'])) {
			$file = $_FILES['import_data']['tmp_name'];
			//load the excel library
			$this->load->library('excel_reader');
			$this->excel_reader->read($file);

			// Get the contents of the first worksheet
			//print_r($this->excel_reader->sheets);exit;
			$worksheet = $this->excel_reader->sheets[0];

			$numRows = $worksheet['numRows']; // ex: 14
			//echo $numRows;
			$numCols = $worksheet['numCols']; // ex: 4
			$cells = $worksheet['cells']; // the 1st row are usually the field's name
			
			//echo '<pre>';print_r($cells);exit;
			$count_rows = count($cells);
			$vat_text = explode(' ', $cells[$count_rows][2]);
			if(count($vat_text)>1){
			if($vat_text[1]!='cocontractant'){
				$tva_rate = str_replace('%', '', $vat_text[1]);
			}else{
				$tva_rate=0;
			}
			$data['tva_rate'] = $tva_rate;
			$reference_string = $cells[2][2];
			$reference_arr = explode(' ', $reference_string);

			$data['reference']= $reference_arr[count($reference_arr)-1];
			$client = explode(':',$cells[4][2]);
			$data['company']= utf8_encode($client[1]);	
			$description = 	explode(':',$cells[6][2]);	
			$data['description']= utf8_encode($description[1]); 
			$data['general_fee']= $cells[1][19];
			$data['hourly_rate']= $cells[1][11];
			$data['working_hours']= $cells[2][11];
			$data['purchase']= $cells[3][11];
			$data['subcontractors']= $cells[4][11];
			$data['cost_price']= $cells[5][11];
			$data['margin']= $cells[5][14];
			$data['sale_price']= $cells[6][11];
			//echo '<pre>';print_r($cells);
		}else{
			$this->session->set_flashdata('err_message', "Il semblerait que vous ayez tenté d’importer un mauvais fichier d’offre. Veuillez recommencer avec un autre.");		
			$data['tva_rate'] = '';
			$data['reference']= '';
			$data['company']= ''; 
			$data['description']= ''; 
			$data['general_fee']= '';
			$data['hourly_rate']= '';
			$data['working_hours']= '';
			$data['purchase']= '';
			$data['subcontractors']= '';
			$data['cost_price']= '';
			$data['margin']= '';
			$data['sale_price']= '';	
		}

		}else{
			$data['tva_rate'] = '';
			$data['reference']= '';
			$data['company']= ''; 
			$data['description']= ''; 
			$data['general_fee']= '';
			$data['hourly_rate']= '';
			$data['working_hours']= '';
			$data['purchase']= '';
			$data['subcontractors']= '';
			$data['cost_price']= '';
			$data['margin']= '';
			$data['sale_price']= '';
		}
		$data['site_managers'] = $this->mod_offers->get_site_managers();
		#--------------- load view--------------#	
		$data['title'] = 'Add Offers';
		$data["subview"] = "admin/offer/add_offer";
		$this->load->view('admin_layout', $data);

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

	public function save(){
		//print_r($this->input->post());exit;
		if($this->input->post()){
			$save_offer = $this->mod_offers->save_offer();
			if($save_offer){
				$this->session->set_flashdata('ok_message', "-Offer created successfully!");
				redirect(SURL.ADMIN.'/offers');
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
				redirect(SURL.'admin/offers/add');
			}
		}
	}

	public function add1()
	{
		if (isset($_FILES['import_data']['name']) && !empty($_FILES['import_data']['name'])) {

			$data['imported_data'] = $this->uploadData();			

		}

	}

	public function uploadData(){
		
		$file = $_FILES['import_data']['tmp_name'];
		//load the excel library
		$this->load->library('excel_reader');
		//read file from path
		/*$objPHPExcel = PHPExcel_IOFactory::load($file);
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		// var_dump($cell_collection);
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
		 $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		 $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		 $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

		 var_dump($data_value);
		 //header will/should be in row 1 only. 
		 if ($row == 1) {
		 $header[$row][$column] = $data_value;
		 } else {
		 $arr_data[$row][$column] = $data_value;
		 }
		}*/

		$this->excel_reader->read($file);

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];

		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		echo 'Refference No: '.utf8_encode($cells[2][2]);
		echo '<br>Company: '.$cells[5][2];
		echo '<br>Description: '.utf8_encode($cells[7][2]);
		echo '<br>General fees: '.$cells[1][19];
		echo '<br>Hourly Rate: '.$cells[1][11];
		echo '<br>Hours worked: '.$cells[2][11];
		echo '<br>Purchase: '.$cells[3][11];
		echo '<br>Subcontractors: '.$cells[4][11];
		echo '<br>Cost price: '.$cells[5][11];
		echo '<br>Margin: '.$cells[5][14];
		echo '<br>Sale price: '.$cells[6][11];

		
		echo '<br><br><br> Progress state<br>';
		echo '<br>State of progress: '.$cells[1][28];
		echo '<br>Period: '.$cells[2][28];
		echo '<br>bill: '.$cells[4][28];
		echo '<br>Forcasted: '.$cells[6][11];
		
		echo '<br>';print_r(explode(' ', $cells[2][28]));

		//echo '<br>'.isset($cells[9]);
		/*echo '<table>
		<thead>
		<tr>
		<th>'.$cells[8][2].'</th>
		<th>'.$cells[8][17].'</th>
		<th>'.$cells[8][20].'</th>
		<th>'.$cells[8][22].'</th>
		</tr>
		<theahd>
		<tbody>';
		for($i=11; $i<=20; $i++){
			//echo count($cells[$i]);
			if(count($cells[$i])>=20){
				echo '<tr>
				<th>'.$cells[$i][2].'</th>
				<th>'.$cells[$i][17].'</th>
				<th>'.$cells[$i][20].'</th>
				<th>'.$cells[$i][22].'</th>
				</tr>';
			}
			
		}
		echo '</tbody></table>';*/
		echo '<pre>';print_r($cells);

	}

	public function detail($id)
	{
		$data['offer_detail'] = $this->mod_offers->get_offers($id);
		#--------------- load view--------------#	
		$data['title'] = 'Offer Detail';
		$data["subview"] = "admin/offer/offer_detail";
		$this->load->view('admin_layout', $data);
	}

	public function modify($id)
	{
		$data['offer_detail'] = $this->mod_offers->get_offers($id);
		#------------------ for import data-------------------#
		if (isset($_FILES['import_data']['name']) && !empty($_FILES['import_data']['name'])) {
			$file = $_FILES['import_data']['tmp_name'];
			//load the excel library
			$this->load->library('excel_reader');
			$this->excel_reader->read($file);

			// Get the contents of the first worksheet
			$worksheet = $this->excel_reader->sheets[0];

			$numRows = $worksheet['numRows']; // ex: 14
			$numCols = $worksheet['numCols']; // ex: 4
			$cells = $worksheet['cells']; // the 1st row are usually the field's name

			$count_rows = count($cells);
			$vat_text = explode(' ', $cells[$count_rows][2]);
			//print_r($vat_text[1]);
			if($vat_text[1]!='cocontractant'){
				$tva_rate = str_replace('%', '', $vat_text[1]);
			}else{
				$tva_rate=0;
			}
			$data['tva_rate'] = $tva_rate;

			$reference_string = $cells[2][2];
			$reference_arr = explode(' ', $reference_string);

			$data['reference']= $reference_arr[count($reference_arr)-1];
			$client = explode(':',$cells[4][2]);
			$data['company']= utf8_encode($client[1]);	
			$description = 	explode(':',$cells[6][2]);	
			$data['description']= utf8_encode($description[1]); 
			$data['general_fee']= $cells[1][19];
			$data['hourly_rate']= $cells[1][11];
			$data['working_hours']= $cells[2][11];
			$data['purchase']= $cells[3][11];
			$data['subcontractors']= $cells[4][11];
			$data['cost_price']= $cells[5][11];
			$data['margin']= $cells[5][14];
			$data['sale_price']= $cells[6][11];
			//echo '<pre>';print_r($cells);

		}else{
			$data['reference']= $data['offer_detail']->reference_no;
			$data['company']= $data['offer_detail']->company; 
			$data['description']= $data['offer_detail']->description; 
			$data['general_fee']= $data['offer_detail']->general_fee;
			$data['hourly_rate']= $data['offer_detail']->hourly_rate;
			$data['working_hours']= $data['offer_detail']->working_hours;
			$data['purchase']= $data['offer_detail']->purchase;
			$data['subcontractors']= $data['offer_detail']->subcontractors;
			$data['cost_price']= $data['offer_detail']->cost_price;
			$data['margin']= $data['offer_detail']->margin;
			$data['sale_price']= $data['offer_detail']->sale_price;
			$data['tva_rate']= $data['offer_detail']->tva_rate;
		}
		$data['site_managers'] = $this->mod_offers->get_site_managers();

		#--------------- load view--------------#	
		$data['offer_id'] = $id;
		$data['title'] = 'Modifiy Offer';
		$data["subview"] = "admin/offer/edit_offer";
		$this->load->view('admin_layout', $data);
	}

	public function update($id){
		//print_r($this->input->post());exit;
		if($this->input->post()){
			$update_offer = $this->mod_offers->update_offer($id);
			if($update_offer){
				$this->session->set_flashdata('ok_message', "-Offer created successfully!");
				redirect(SURL.'admin/offers/detail/'.$id);
			}else{
				$this->session->set_flashdata('err_message', 'Something wrong.');
				redirect(SURL.'admin/offers/modify/'.$id);
			}
		}
	}

	public function update_comment(){
		$update = $this->mod_offers->update_comment();
		echo $update;
	}

	public function delete_offer(){

		//echo $this->input->post('offer_ids');
		$update = $this->mod_offers->delete_offer();
		echo $update;
	}

	public function update_status(){
		$update = $this->mod_offers->update_status();
		echo $update;
	}

	public function price_sheet($id)
	{
		$data['offer_detail'] = $this->mod_offers->get_offers($id);
		#--------------- load view--------------#	
		$data['title'] = PRICE_SHEET_BTN;
		$data["subview"] = "admin/offer/price_sheet";
		$this->load->view('admin_layout', $data);
	}


	
}
