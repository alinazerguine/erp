<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importdata extends HrController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'HR Manager';
		$this->load->model('mod_import_data');
	}

	public function index()
	{
		
		$data['employees'] = $this->mod_import_data->get_import_temp();		
		$data['employee_data'] = $this->mod_import_data->get_importdata_temp($data['employees'][0]->id);
		$data['working_sites'] = $this->mod_import_data->get_all_working_sites();
		//print_r($data['employees']);exit;
		if(count($data['employees'])==0 && count($data['employee_data'])==0){
			$this->session->set_flashdata('err_message', "Il semblerait que vous ayez tenté d’importer un mauvais fichier Securysat. Veuillez recommencer avec un autre.");	
			redirect(SURL.'human_resource/importdata/securysat');exit;
		}
		#--------------- load view--------------#
			$data['title'] = 'Import Data';
			$data["subview"] = "hr/import";
			$this->load->view('hr_layout', $data);
	}


	public function securysat()
	{
		if (isset($_FILES['securysat']['name']) && !empty($_FILES['securysat']['name'])) {
			$file = $_FILES['securysat']['tmp_name'];
			
				$this->load->library('phpexcel');
			$this->load->library('PHPExcel/iofactory');

			$inputFileName = $file;  // File to read
			//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
			try {
				$objPHPExcel = IOFactory::load($inputFileName);
				//$objWriter->setPreCalculateFormulas(false);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}


			///echo '<hr />';
			//echo "<pre>";
			$worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			//print_r($sheetData); exit;
			
			// //load the excel library
			// $this->load->library('excel_reader');
			// $this->excel_reader->read($file);

			// // Get the contents of the first worksheet
			// $worksheet = $this->excel_reader->sheets[0];
	
			// $numRows = $worksheet['numRows']; // ex: 14
			// $numCols = $worksheet['numCols']; // ex: 4
			// $cells = $worksheet['cells']; // the 1st row are usually the field's name
			// $count =  count($cells);
			// $user_array = array();
		//	echo '<pre>';print_r($worksheet);exit();
		// 	$a = 0;
		// 	foreach ($worksheet as $key1 => $value) {
		// 		if ($key1 != 1) {
				 	

					
		// 		 	}
		// 	}
		


		// 	pfor($i=1; $i<=$a; $i++){				
		// 		 $key = array_search($cells[$i][1], array_column($user_array, 'name'));
		// 		if ($key!=null) {
		// 			$key = array_search($cells[$i][1], array_column($user_array, 'name'));
		// 			array_push($user_array[$key]['data'],$cells[$i]);
		// 			//echo '<re>';print_r($user_array[$key]['data']);exit;
		// 			//$user_array[$key]['data'][] = $cells[$i];
		// 		}else{
		// 		$data = array();
		// 		$name = $cells[$i][1];
		// 		$data[] = $cells[$i];
		// 		$user_array[] = array('name'=>$name,'data'=>$data);
		// 	}				
		// 	}
		// 	if($user_array[0]['name']='Personne'){
		// 	$remove_first_index = array_shift($user_array);
		// }echo '<pre>';print_r($user_array);exit();
		//echo '<pre>';print_r($worksheet);exit;
		#------------empty temp table before importing file ------------#
		$this->db->truncate('securysat');
        $this->db->truncate('securysat_data');
        
		$result = $this->mod_import_data->save_import_temp($worksheet);
		if($result=="OK"){
		redirect(SURL.HR.'/importdata');	
		}else{
			$this->session->set_flashdata('err_message', "Il semblerait que vous ayez tenté d’importer un mauvais fichier Securysat. Veuillez recommencer avec un autre.");			
		}	
		}
		#--------------- load view--------------#
			$data['title'] = 'Import Data';
			$data["subview"] = "hr/import_securysat";
			$this->load->view('hr_layout', $data);
	}

	public function get_user_data($userid){

		$employee_data = $this->mod_import_data->get_importdata_temp($userid);
		$working_sites = $this->mod_import_data->get_all_working_sites();

			$previous_dpart_time = '';
			$total_working_hours = 0;
			$tworking_hours = 0;
			$total_real_hours = 0;
			$total_accountable_hours = 0;
			$html='';

			foreach($employee_data as $key=>$data){
				if($key==0){
					$start_time = $data->arrival_time;
				}else{
					$start_time = $previous_dpart_time;
				}										
				$end_time = $data->departure_time;
			
			#==========================================#
			$dteStart = new DateTime($start_time); 
			$dteEnd   = new DateTime($end_time);
			$dteDiff  = $dteStart->diff($dteEnd); 
			$working_hours =  $dteDiff->format("%H:%I:%S");  
			#----------- morning break---------#
			$st_brk = "09:00:00";
			$end_brk = "09:15:00";
			#----------- lunch break---------#
			$st_brk1 = "12:00:00";
			$end_brk1 = "12:30:00";

			 if ($st_brk >=$start_time && $end_brk <=$end_time)  {						      
				     $real_hours= date("H:i:s",strtotime('-15 minutes '.$working_hours));
				    }
				    elseif ($st_brk1 >=$start_time && $end_brk1 <=$end_time)  {						      
				     $real_hours= date("H:i:s",strtotime('-30 minutes '.$working_hours));
				    }
				    else
				    {
				      $real_hours = $working_hours;
				    }
			
			$time = strtotime($real_hours);
			$round = 15*60;
			$rounded = round($time / $round) * $round;
			 $accountable_hours =  date("H:i:s", $rounded); 
			#------------ total working hopurs-----------#
			if(strtotime($total_working_hours)>0 && $key>1){
				 $tworking_hours = sum_the_time($total_working_hours,$working_hours);
				$total_working_hours = $tworking_hours;
			}else{				
				 $total_working_hours= $working_hours;
			}
			#------------ real total hours-------------#
			if(strtotime($total_real_hours)>0  && $key>1){
				$total_real_hours = sum_the_time($total_real_hours,$real_hours);
			}else{
				$total_real_hours= $real_hours;
			}
			#------------ accountable total hours-----------#
			if(strtotime($total_accountable_hours)>0  && $key>1){
				$total_accountable_hours = sum_the_time($total_accountable_hours,$accountable_hours);
			}else{
				$total_accountable_hours= $accountable_hours;
			}
			$select = '';
			if($key>0){
				$select ='<select class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5" title="Sélectionnez"  name="site[]" id="site" style="width:100%;" onchange="add_new_site(this.value,'.$data->id.')">
							<option value=""></option>';
					if($working_sites){
					foreach($working_sites as $site){
					$select .='<option value="'.$site->id.'">#'.$site->reference_no.'-'.$site->description.'</option>';
					}
					$select .='<option value="add_new_site" style="background: #444;color: #FFF;cursor:  pointer;
					">'.NEW_CONSTRUCTION_SITE.'</option>
				</select>';
				 }
			}

			$html .= '<tr id="row_'.$data->id.'">
			<td><input type="checkbox" id="checkbox_'.$data->id.'" name="is_del" value="'.$data->id.'"></td>
			<td>'.$data->departure_time.'</td>
			<td>'.$data->arrival_time.'</td>
			<td>'.$data->depart_place.'</td>
			<td>'.$data->arrival_place.'</td>
			<td>'.$data->duration.'</td>
			<td><input type="number" min="0" step="0.5" class="form-control" name="distance[]" value="'.$data->distance.'" style="width:100%; padding:0px;" ></td>
			<td>';
			$html .=($key>0) ? '<input type="text" class="form-control working_hours" onkeyup="sum_time_working()" name="working_hours[]" value="'.$working_hours.'" style="width:100%; padding:0px;" />' : "";
			$html .='</td><td>';
			$html .=($key>0) ? '<input type="text" class="form-control real_hours" name="real_hours[]" value="'.$real_hours.'" style="width:100%; padding:0px;" onkeyup="sum_time_real()"/>' : "";
			$html .='</td><td>';
			$html .=($key>0) ? '<input type="text" class="form-control accountable_hours" name="accountable_hours[]" value="'.$accountable_hours.'" style="width:100%; padding:0px;" onkeyup="sum_time_accountable()"/>' : "";
			$html .='</td>
			<td>'.$select.'</td>								
			</tr>';
			
			if($key==0){
					$previous_dpart_time = $data->arrival_time;
				}else{
					$previous_dpart_time = $data->departure_time;
				}
		}

		$tfooter = '<tr class="warning">
									<td><strong>Total</strong></td>
									<td colspan="5"></td>
									<td></td>
									<td id="totalWorkingHour"><strong>'.$total_working_hours.'</strong><input type="hidden" name="total_working_hours" id="total_working_hours" value="'.$total_working_hours.'"></td>
									<td id="totalRealHour"><strong>'.$total_real_hours.'</strong><input type="hidden" name="total_real_hours" id="total_real_hours" value="'.$total_real_hours.'"></td>
									<td id="totalAccountableHour"><strong>'.$total_accountable_hours.'</strong><input type="hidden" name="total_accountable_hours" id="total_accountable_hours" value="'.$total_accountable_hours.'"></td>
									<td><input type="hidden" name="user_name" id="user_name" value=""></td>
								</tr>';

		echo json_encode(array('html'=>$html,'tfooter'=>$tfooter));
		//echo $html;

	}

	public function remove_employee_row(){
		//echo $this->input->post('checked_rows');exit;
		$this->mod_import_data->remove_employee_row();
	}

	public function post_user_data(){

		$this->mod_import_data->post_user_data();
	}

	public function add_absent(){

		$this->mod_import_data->add_absent();
	}

	public function delete_temp_data(){

		$this->mod_import_data->delete_temp_data();
	}

	public function get_next_site_refernce(){

		$this->mod_import_data->get_next_site_refernce();
	}

	public function add_new_site(){

		$this->mod_import_data->add_new_site();
	}

	

	
}
