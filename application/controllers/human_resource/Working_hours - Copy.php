<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Working_hours extends HrController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'HR Manager';
		$this->load->model('mod_working_hours');
	}

	public function sites()
	{
		#--------------- load view--------------#	
		$data['title'] = 'Import Data';
		$data["subview"] = "hr/sites";
		$this->load->view('hr_layout', $data);
	}

	public function get_sites()
	{
		$list = $this->mod_working_hours->get_sites();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			
			$no++;
			$row = array();
			
			$row[] = '#'.$value->reference_no.'<input type="hidden" id="row_id" value="'.$value->site_id.'" />';
			$row[] = $value->description;
			$row[] = $value->manager_name;
			$row[] = $value->schedule_hours;
			$row[] = decimalHours($value->total_worked_hours);
			$row[] = $value->schedule_hours - decimalHours($value->total_worked_hours);
			
			//$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_working_hours->get_count_sites(),
			"recordsFiltered" => $this->mod_working_hours->get_count_sites(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function site_hours($site_id)
	{
		$today = date("Y-m-d");
		$current_week = weekOfMonth($today);
		$current_year = date("Y");
		$total_weeks = getIsoWeeksInYear($current_year);
		//$week_dates =  getStartAndEndDate($current_week,$current_year);
		$limit = $current_week+5;
		$week_dates_array = array();
		for($i=$current_week; $i<=$limit;$i++){

			$week_dates_array[$i]['label'] = WEEK.' '.$i;
			$week_dates_array[$i]['week'] = $i;
			$week_dates_array[$i]['year'] = $current_year;
			$week_dates_array[$i]['dates'] = getStartAndEndDate($i,$current_year);

		}
		$data['weeks_n_dates'] =  $week_dates_array;

		#--------------- user data----------------#
		$current_week_dates =  get_week_dates($current_week,$current_year);
		
		$dates_arr = explode('_', $current_week_dates);
		$start_date = $dates_arr[0];
		$end_date = $dates_arr[1];
		$site_data =array();
		$site_users = $this->mod_working_hours->get_site_users($site_id,$start_date,$end_date);

		#-------------create array for the dates and get the data for each date----------#		
		foreach($site_users as $key=>$site){
			$site_data[$key] = $site;
			$dates=array();
			for($i=0; $i<=6;$i++){
				$next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));			
				$user_hours = $this->mod_working_hours->get_site_hours($site['employee_id'],$site_id,$next_date);
				$dates[] = array('date'=>$next_date,'data'=>$user_hours);
			}

			$site_data[$key]['user_hours'] = $dates;
		}
		//echo '<pre>';print_r($site_data);exit;
		$data['site_data'] = $site_data;
		$data['site_info'] = $this->mod_working_hours->get_sites($site_id);
		#--------------- load view--------------#	
		$data['title'] = 'Import Data';
		$data["subview"] = "hr/site_hours";
		$this->load->view('hr_layout', $data);
	}

	public function load_weekly_sitedata($site_id,$current_week,$current_year){
		#--------------- user data----------------#
		$current_week_dates =  get_week_dates($current_week,$current_year);
		
		$dates_arr = explode('_', $current_week_dates);
		$start_date = $dates_arr[0];
		$end_date = $dates_arr[1];
		$site_data =array();
		$site_users = $this->mod_working_hours->get_site_users($site_id,$start_date,$end_date);

		#-------------create array for the dates and get the data for each date----------#		
		foreach($site_users as $key=>$site){
			$site_data[$key] = $site;
			$dates=array();
			for($i=0; $i<=6;$i++){
				$next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));			
				$user_hours = $this->mod_working_hours->get_site_hours($site['employee_id'],$site_id,$next_date);
				$dates[] = array('date'=>$next_date,'data'=>$user_hours);
			}

			$site_data[$key]['user_hours'] = $dates;
		}
		//echo '<pre>';print_r($site_data);exit;
		$data['site_data'] = $site_data;
		$html = '';
		$grand_total = 0;
		$grand_total_0 = 0;
		$grand_total_1 = 0;
		$grand_total_2 = 0;
		$grand_total_3 = 0;
		$grand_total_4 = 0;
		$grand_total_5 = 0;
		$grand_total_6 = 0;
		if($site_data){								
			foreach($site_data as $data){
				$user_hours = $data['user_hours'];
				$html.='<tr>
				<td>'.$data['employee_name'].'</td>';
				$total_user_hours = 0;
				foreach($user_hours as $key=>$hour){

					$hour_data = $hour['data'];
					$worked_hours = ($hour_data) ? decimalHours($hour_data->worked_hours) : '';
					if($worked_hours){
						$total_user_hours+=$worked_hours;
						${'grand_total_'.$key}+=$worked_hours;										
					}
					$html.='<td>'.$worked_hours.'</td>';
				}
				$grand_total+=$total_user_hours;
				$html.='<td>'.$total_user_hours.'</td>													
				</tr>';
			}
		}else{
			$html = '<tr><td colspan="9">'.NO_DATA_AVAILABLE.'</td></tr>';
		}
		$footer='';
		$footer.='<tr class="warning">
		<td>Total</td>
		<td>';
		$footer.=($grand_total_0>0) ? $grand_total_0 : '';
		$footer.='</td><td>';
		$footer.=($grand_total_1>0) ? $grand_total_1 : '';
		$footer.='</td><td>';
		$footer.=($grand_total_2>0) ? $grand_total_2 : '';
		$footer.='</td><td>';
		$footer.=($grand_total_3>0) ? $grand_total_3 : '';
		$footer.='</td><td>';
		$footer.=($grand_total_4>0) ? $grand_total_4 : '';
		$footer.='</td><td>';
		$footer.=($grand_total_5>0) ? $grand_total_5 : '';
		$footer.='</td><td>';
		$footer.=($grand_total_6>0) ? $grand_total_6 : '';
		$footer.='</td><td>';
		$footer.=($grand_total>0) ? $grand_total : '';
		$footer.='</td>
		</tr>';

		echo json_encode(array('html'=>$html,'footer'=>$footer));
	}

	public function employees()
	{
		#--------------- load view--------------#	
		$data['title'] = 'Import Data';
		$data["subview"] = "hr/employees";
		$this->load->view('hr_layout', $data);
	}
	public function get_employees()
	{
		$list = $this->mod_working_hours->get_employees();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			
			$no++;
			$row = array();
			
			$row[] = $value->id.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
			$row[] = $value->employee_name;
			$row[] = $value->working_sites;
			$row[] = $value->total_real_hours;
			$row[] = $value->total_accountable_hours;
			
			//$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_working_hours->get_count(),
			"recordsFiltered" => $this->mod_working_hours->get_count(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function employee_hours($userid)
	{
		#----------------- calendar-----------#
		$today = date("Y-m-d");
		$current_week = weekOfMonth($today);
		$current_year = date("Y");
		$total_weeks = getIsoWeeksInYear($current_year);
		//$week_dates =  getStartAndEndDate($current_week,$current_year);
		$limit = $current_week+5;
		$week_dates_array = array();
		for($i=$current_week; $i<=$limit;$i++){

			$week_dates_array[$i]['label'] = WEEK.' '.$i;
			$week_dates_array[$i]['week'] = $i;
			$week_dates_array[$i]['year'] = $current_year;
			$week_dates_array[$i]['dates'] = getStartAndEndDate($i,$current_year);

		}
		$data['weeks_n_dates'] =  $week_dates_array;
		#--------------- user data----------------#
		$current_week_dates =  get_week_dates($current_week,$current_year);
		
		$dates_arr = explode('_', $current_week_dates);
		$start_date = $dates_arr[0];
		$end_date = $dates_arr[1];
		$user_data =array();
		$user_sites = $this->mod_working_hours->get_user_site($userid,$start_date,$end_date);
		#-------------create array for the dates and get the data for each date----------#		
		foreach($user_sites as $key=>$site){
			$user_data[$key] = $site;
			$dates=array();
			for($i=0; $i<=6;$i++){
				$next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));			
				$user_hours = $this->mod_working_hours->get_user_hours($userid,$next_date);
				$dates[] = array('date'=>$next_date,'data'=>$user_hours);
			}

			$user_data[$key]['user_hours'] = $dates;
		}
		//print_r($user_data);
		$data['user_data'] = $user_data;
		$data['user_info'] = $this->mod_working_hours->get_employees($userid);
		#--------------- load view--------------#	
		$data['title'] = 'Import Data';
		$data["subview"] = "hr/employee_hours";
		$this->load->view('hr_layout', $data);
	}

	public function load_weekly_userdata($userid,$current_week,$current_year){
		#--------------- user data----------------#
		$current_week_dates =  get_week_dates($current_week,$current_year);
		
		$dates_arr = explode('_', $current_week_dates);
		$start_date = $dates_arr[0];
		$end_date = $dates_arr[1];
		$user_data =array();
		$user_sites = $this->mod_working_hours->get_user_site($userid,$start_date,$end_date);
		#-------------create array for the dates and get the data for each date----------#		
		foreach($user_sites as $key=>$site){
			$user_data[$key] = $site;
			$dates=array();
			for($i=0; $i<=6;$i++){
				$next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));			
				$user_hours = $this->mod_working_hours->get_user_hours($userid,$next_date);
				$dates[] = array('date'=>$next_date,'data'=>$user_hours);
			}

			$user_data[$key]['user_hours'] = $dates;
		}
		$Grand_total_RH = 0;
		$Grand_total_RC = 0;
		$html='';
		if($user_data){								
			foreach($user_data as $data){
				$html.='<tr>
				<td rowspan="2">'.$data['site_name'].'</td>
				<td style="border-right: 1px solid #444; border-left: 1px solid #444;">HR</td>';
				$user_hours =$data['user_hours'];
				$totalReal = 0;
				foreach($user_hours as $hour){
					$hour_data = $hour['data'];
					$real_hour = ($hour_data) ? decimalHours($hour_data->HR) : '';
					if($real_hour){
						$totalReal +=$real_hour;
						$Grand_total_RH += $totalReal;
					}
					$html.='<td>'.$real_hour.'</td>';
				}								
				$html.='<td>'.$totalReal.'</td>															
				</tr>
				<tr>
				<td style="border-right: 1px solid #444; border-left: 1px solid #444;">HC</td>';
				$user_hours =$data['user_hours'];
				$totalAccountable = 0;
				foreach($user_hours as $hour){
					$hour_data = $hour['data'];
					$acc_hour = ($hour_data) ? decimalHours($hour_data->HC) : '';
					if($acc_hour){
						$totalAccountable +=$acc_hour;
						$Grand_total_RC += $totalAccountable;
					}
					$html.='<td>'.$acc_hour.'</td>';
				}
				$html.='<td>'.$totalAccountable.'</td>															
				</tr>';
			}
		}else{
			$html='<tr><td colspan="10">'.NO_DATA_AVAILABLE.'</td></tr>';
		}

		$footer='<tr>
		<td rowspan="2" style="vertical-align: middle; text-align: center;">'.TOTAL.'</td>
		<td align="center">'.HR_TEXT.'</td>								
		<td align="center"><strong>'.$Grand_total_RH.'</strong></td>															
		</tr>
		<tr>
		<td align="center">'.HC_TEXT.'</td>								
		<td align="center"><strong>'.$Grand_total_RC.'</strong> <input type="hidden" name="userid" id="userid" value="'.$userid.'"></td>									
		</tr>';

		echo json_encode(array('html'=>$html,'footer'=>$footer));
	}

	public function schedule()
	{
		$today = date("Y-m-d");
		$current_week = weekOfMonth($today);
		$current_year = date("Y");
		$total_weeks = getIsoWeeksInYear($current_year);
		//$week_dates =  getStartAndEndDate($current_week,$current_year);
		$limit = $current_week+5;
		$week_dates_array = array();
		for($i=$current_week; $i<=$limit;$i++){

			$week_dates_array[$i]['label'] = WEEK.' '.$i;
			$week_dates_array[$i]['week'] = $i;
			$week_dates_array[$i]['year'] = $current_year;
			$week_dates_array[$i]['dates'] = getStartAndEndDate($i,$current_year);

		}
		$data['weeks_n_dates'] =  $week_dates_array;
		$data['current_week'] = $current_week;
		$data['current_year'] = $current_year;
		#-------------- get all working sites---------#
		$data['working_sites'] = $this->mod_working_hours->get_all_working_sites();

		#------------------ get schedules--------------#
		$current_week_dates =  get_week_dates($current_week,$current_year);
		
		$dates_arr = explode('_', $current_week_dates);
		$start_date = $dates_arr[0];
		$end_date = $dates_arr[1];
		$user_schedule =array();
		
		$scheduled_employees = $this->mod_working_hours->get_all_employees();
		#-------------create array for the dates and get the data for each date----------#		
		foreach($scheduled_employees as $key=>$employee){
			$user_schedule[$key] = $employee;
			$dates=array();
			for($i=0; $i<=6;$i++){
				$next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));			
				$user_site = $this->mod_working_hours->get_current_week_schedule($employee['id'],$next_date);
				$dates[] = array('date'=>$next_date,'schedule'=>$user_site);
			}

			$user_schedule[$key]['user_schedule'] = $dates;
		}
	//echo '<pre>';print_r($user_schedule);exit;
		$data['user_schedule'] = $user_schedule;
		#--------------- load view--------------#	
		$data['title'] = SCHEDULE;
		$data["subview"] = "hr/schedule";
		$this->load->view('hr_layout', $data);
	}

	public function save_schedule(){
		$save_schedule = $this->mod_working_hours->save_schedule();
		if($save_schedule){
			$this->session->set_flashdata('ok_message', "-Schedule added successfully!");
			redirect(SURL.'human_resource/working_hours/schedule');
		}else{
			$this->session->set_flashdata('err_message', "Something went wrong.");
			redirect(SURL.'human_resource/working_hours/schedule');
		}
	}

	public function load_schedule($current_week,$current_year){
		#------------------ get schedules--------------#
		$current_week_dates =  get_week_dates($current_week,$current_year);
		
		$dates_arr = explode('_', $current_week_dates);
		$start_date = $dates_arr[0];
		$end_date = $dates_arr[1];
		$user_schedule =array();
		
		$scheduled_employees = $this->mod_working_hours->get_all_employees();
		#-------------create array for the dates and get the data for each date----------#		
		foreach($scheduled_employees as $key=>$employee){
			$user_schedule[$key] = $employee;
			$dates=array();
			for($i=0; $i<=6;$i++){
				$next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));			
				$user_site = $this->mod_working_hours->get_current_week_schedule($employee['id'],$next_date);
				$dates[] = array('date'=>$next_date,'schedule'=>$user_site);
			}

			$user_schedule[$key]['user_schedule'] = $dates;
		}
		//print_r($user_schedule);exit;
			$html='';
			$working_sites = $this->mod_working_hours->get_all_working_sites();
			if($user_schedule){
				foreach($user_schedule as $emp){				
				#-- --------- morning schedules------------------ -#
				$html.='<tr>
					<td rowspan="2">'.$emp['employee_name'].'<input type="hidden" name="employee_id[]" id="employee_id_'.$emp['id'].'" value="'.$emp['id'].'"></td>';
						foreach($emp['user_schedule'] as $schedule){
							$user_schedule = $schedule['schedule'];
							
							if($user_schedule){
								$morning_schedule = $user_schedule->morning_schedule;
							}else{
								$morning_schedule='';
							}

						$html.='<td>'.get_schedule_site_dropdown('morning_schedule['.$emp['id'].']',$working_sites,$morning_schedule).'</td>';
							 }																								
						$html.='</tr>						
							<tr>';
							foreach($emp['user_schedule'] as $schedule){
											$user_schedule = $schedule['schedule'];

											if($user_schedule){
												$afternoon_schedule = $user_schedule->afternoon_schedule;
											}else{
												$afternoon_schedule='';
											}
										$html.='<td>'.get_schedule_site_dropdown('afternoon_schedule['.$emp['id'].']',$working_sites,$afternoon_schedule).'</td>';
											 }													
										$html.='</tr>';
				}
			}

			echo $html;
	}

	public function schedule_next()
	{
		$current_week = $this->input->post('current_week');
		$last_week = $this->input->post('last_week');
		$current_year = $this->input->post('year');
		$total_weeks = getIsoWeeksInYear($current_year);
		if($last_week>=$total_weeks){
			$current_year++;
			$current_week = 1;
		}else{
			$current_week = $last_week +1;
		}
		//echo $current_week;exit;
		
		$limit = $current_week+5;
		$week_dates_array = array();
		$j=1;
		for($i=$current_week; $i<=$limit;$i++){
			//$new_year = ($i <= 52) ?  $current_year :  $current_year+1;
				#----- if the number of weeks exceed from 52 , reset count to 1#
			$week = ($i<=52) ? $i : $j;

			$week_dates_array[$i]['label'] = WEEK.' '.$week;
			$week_dates_array[$i]['week'] = $week;
			$week_dates_array[$i]['year'] = getYear($i,$current_year);
			$week_dates_array[$i]['dates'] = getStartAndEndDate($i,$current_year);

			if($i>52) {$j++;}
		}

		echo json_encode($week_dates_array);
		
	}

	public function schedule_prev()
	{
		$current_week = $this->input->post('current_week');
		$last_week = $this->input->post('last_week');
		$current_year = $this->input->post('year');
		$total_weeks = getIsoWeeksInYear($current_year);
		if($current_week<1){
			$current_year--;
			$current_week = 52;
		}else{
			$current_week = $current_week -1;
		}
		//echo $current_year;exit;
		
		$limit = $current_week-5; 

		$week_dates_array = array();
		$j=52;
		if($limit>0){
			for($i=$current_week; $i>=$limit;$i--){
				//$new_year = ($i <= 52) ?  $current_year :  $current_year+1;
					#----- if the number of weeks exceed from 52 , reset count to 1#

				$week = ($i>=1) ? $i : $i+$j;

				$week_dates_array[$i]['label'] = WEEK.' '.$week;
				$week_dates_array[$i]['week'] = $week;
				$week_dates_array[$i]['year'] = getYear_prev($i,$current_year);
				$week_dates_array[$i]['dates'] = getStartAndEndDate($i,$current_year);

				if($i>52 || $i<1) {$j--;}
			}
		}else{
			
			for($i=$limit; $i<=$current_week;$i++){
				//$new_year = ($i <= 52) ?  $current_year :  $current_year+1;
					#----- if the number of weeks exceed from 52 , reset count to 1#
					//echo $i.'-';
				$week = $i+52;
				$week_number = ($i<1) ? $i+52 : $i;
				$week_dates_array[$week]['label'] = WEEK.' '.$week_number;
				$week_dates_array[$week]['week'] = $week_number;
				if($i<1){
					$week_dates_array[$week]['year'] = getYear_prev($i,$current_year);
				}else{
					$week_dates_array[$week]['year'] = getYear_prev($i,$current_year);
				}
				$week_dates_array[$week]['dates'] = getStartAndEndDate($i,$current_year);

				if($i<1) {$j--;}
			}
		}
		//print_r($week_dates_array);
		echo json_encode($week_dates_array);
		
	}


	public function schedule2()
	{
		$today = date("Y-m-d");
		$current_week = weekOfMonth($today);
		$current_year = date("Y");
		$total_weeks = getIsoWeeksInYear($current_year);
		//$week_dates =  getStartAndEndDate($current_week,$current_year);
		$limit = $current_week+5;
		$week_dates_array = array();
		for($i=$current_week; $i<=$limit;$i++){

			$week_dates_array[$i]['label'] = WEEK.' '.$i;
			$week_dates_array[$i]['week'] = $i;
			$week_dates_array[$i]['year'] = $current_year;
			$week_dates_array[$i]['dates'] = getStartAndEndDate($i,$current_year);

		}
		$data['weeks_n_dates'] =  $week_dates_array;
		#--------------- load view--------------#	
		$data['title'] = 'Import Data';
		$data["subview"] = "hr/schedule2";
		$this->load->view('hr_layout', $data);
	}

	
	

	
}
