<div id="page-wrapper">	
	<div class="graphs" style="float: left; width: 100%;">		
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;"> <div class="col-md-7 medium" style="margin-top: 10px;"><?php echo IMPORT_SECURYSAT;?> | <?php echo date("d/m/Y",strtotime($employees[0]->secury_file_date));//("d/m/Y");?></div>				
				
			</div>
			<?php
				$prev_user = $employees[0]->id;
				$next_user = (count($employees)>1) ? $employees[1]->id : $employees[0]->id;

			?>
			<div class="col-md-12 col-sm-12" style="margin-top: 10px; padding: 0px;">
				<div class="col-md-1" style="width:2%; padding: 0px;">
				<span class="schedule_prev" id="employee_prev" onclick="employee_prev(<?php echo $prev_user?>)"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
			</div>
			<div class="col-md-10" style="width:95%; padding: 0px;">
				<div class="table-responsive" id="scroll_div">
					<table class="table table-striped" id="secursat_user_table" style="width: 100%; margin-top: 0px;">
						<tr>
							<?php if($employees){
								foreach($employees as $key=>$data){
									//print_r($data['data'][0]['3']);exit;
									?>
									<td>
										<div class="worker_box <?php if($key==0){ echo 'active';} ?>" id="data_id_<?php echo $data->id; ?>" userid="<?php echo $data->id; ?>" onclick="get_user_data(<?php echo $data->id; ?>)" style="min-width: 200px;">
											<i class="fa fa-check-circle" aria-hidden="true" style="float: left;width: 13%; min-height: 16px; margin-top: 15px;"></i>					
											<span class="name" style="width: 83%; text-align: center;"><?php echo $data->user_name;?></span>
											<span class="profile"><?php echo ($data->type=='driver') ? 'Conducteur' : 'Passager';?></span>					

										</div>
									</td>
									<?php 
								}
							}
							?>									
						</tr>

					</table>
				</div><!-- /.table-responsive -->
			</div>
			<div class="col-md-1" style="width:3%; padding: 0px;">
				<span class="schedule_next" id="employee_next" onclick="employee_next(<?php echo $next_user?>)"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
			</div>
			</div>
			<div class="col-md-12 col-sm-12">				
				<form method="post" action="#" id="user_data_form">
					<div class="table-responsive">
						<table class="table table-striped" id="secursat_user_data" style="width: 100%; margin-top: 15px;">
							<thead>
								<tr class="warning">
									<th width="5%"><input type="checkbox" name="check_all" value="1"></th>							
									<th width="10%"> <?php echo DEPARTURE;?></th>
									<th width="10%"> <?php echo ARRIVAL;?></th>
									<th width="10%"> <?php echo DEPARTURE_PLACE;?></th>
									<th width="10%"> <?php echo ARRIVAL_PLACE;?></th>
									<th width="5%"> <?php echo DURATION;?></th>
									<th width="10%"> <?php echo DISTANCE;?></th>
									<th width="10%"> <?php echo WORKINGHOURS;?></th>
									<th width="10%"> <?php echo REAL_TIME;?></th>
									<th width="10%"> <?php echo COMPTA_TIME;?></th>
									<!-- <th> <?php //echo SUPP_TIME;?></th> -->
									<th width="10%"> <?php echo SITE;?></th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$previous_dpart_time = '';
								$total_working_hours = 0;
								$total_real_hours = 0;
								$total_accountable_hours = 0;
								if($employee_data){						
									foreach($employee_data as $key=>$data){
										if($key==0){
											$start_time = $data->arrival_time;
										}else{
											$start_time = $previous_dpart_time;
										}										
										$end_time = $data->departure_time;

									#==========================================#
									#------ Calculate time difference ---------#
										/*
											for first row no time will be calculated
											the start time for the second row will be arrival time of first row
											otherwise differnce will be cal with the prev row depart time and current row depart time;
										*/
									#==========================================#
											$dteStart = new DateTime($start_time); 
											$dteEnd   = new DateTime($end_time);
											$dteDiff  = $dteStart->diff($dteEnd); 
											$working_hours =  $dteDiff->format("%H:%I:%S");  
									/*
										remove 15 min between time 9:00 am to 9:15 am and 30 min 12:00 pm to 12:30 pm from working hours
									*/
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
										if($total_working_hours>0){
											$total_working_hours = sum_the_time($total_working_hours,$working_hours);
										}else{
											$total_working_hours= $working_hours;
										}
									#------------ real total hours-------------#
										if($total_real_hours>0){
											$total_real_hours = sum_the_time($total_real_hours,$real_hours);
										}else{
											$total_real_hours= $real_hours;
										}
									#------------ accountable total hours-----------#
										if($total_accountable_hours>0){
											$total_accountable_hours = sum_the_time($total_accountable_hours,$accountable_hours);
										}else{
											$total_accountable_hours= $accountable_hours;
										}


										?>
										<tr id="row_<?php echo $data->id;?>">
											<td><input type="checkbox" id="checkbox_<?php echo $data->id;?>" name="is_del" value="<?php echo $data->id;?>"></td>
											<td><?php echo $data->departure_time;?></td>
											<td><?php echo $data->arrival_time;?></td>
											<td><?php echo $data->depart_place;?></td>
											<td><?php echo $data->arrival_place;?></td>
											<td><?php echo $data->duration;?></td>
											<td><input type="number" min="0" step="0.5" class="form-control" name="distance[]" value="<?php echo $data->distance;?>" style="width:100%; padding:0px;" ></td>
											<td><?php echo ($key>0) ? '<input type="text" class="form-control working_hours" name="working_hours[]" value="'.$working_hours.'" style="width:100%; padding:0px;" onkeyup="sum_time_working()" />' : '';?></td>
											<td><?php echo ($key>0) ? '<input type="text" class="form-control real_hours" name="real_hours[]" value="'.$real_hours.'" style="width:100%; padding:0px;" onkeyup="sum_time_real()"/>' : '';?></td>
											<td><?php echo ($key>0) ? '<input type="text" class="form-control accountable_hours" name="accountable_hours[]" value="'.$accountable_hours.'" style="width:100%; padding:0px;" onkeyup="sum_time_accountable()" />' : '';?></td>
											<td><?php if($key>0){?><select class="form-control selectpicker" data-container="body" name="site[]" id="site" style="width:100%;" data-live-search="true" data-size="5" title="Sélectionnez" onchange="add_new_site(this.value,<?php echo $data->id;?>)">
												<option value=""></option>
												<?php if($working_sites){
													foreach($working_sites as $site){?>
													<option value="<?php echo $site->id;?>"><?php echo '#'.$site->reference_no.'-'.$site->description;?></option>
													<?php }}?>
													<option value="add_new_site" style="background: #444;color: #FFF;cursor:  pointer;
													"><?php echo NEW_CONSTRUCTION_SITE;?></option>
												</select><?php }?></td>								
											</tr>
											<?php 
											if($key==0){
												$previous_dpart_time = $data->arrival_time;
											}else{
												$previous_dpart_time = $data->departure_time;
											}
										}
									}?>

								</tbody>
								<tfoot>
									<tr class="warning">
										<td><strong>Total</strong></td>
										<td colspan="5"></td>
										<td></td>
										<td id="totalWorkingHour"><strong><?php echo $total_working_hours;?></strong><input type="hidden" name="total_working_hours" id="total_working_hours" value="<?php echo $total_working_hours;?>"></td>
										<td id="totalRealHour"><strong><?php echo $total_real_hours;?></strong><input type="hidden" name="total_real_hours" id="total_real_hours" value="<?php echo $total_real_hours;?>"></td>
										<td id="totalAccountableHour"><strong><?php echo $total_accountable_hours;?></strong><input type="hidden" name="total_accountable_hours" id="total_accountable_hours" value="<?php echo $total_accountable_hours;?>"></td>
										<td><input type="hidden" name="user_name" id="user_name" value=""></td>
									</tr>
								</tfoot>
							</table>
							<!-- ------------- comment field -------- -->
							<div class="col-md-12 col-sm-12" style="margin-top: 10px; margin-bottom: 10px;">
								<div class="col-md-2">
									Comment : 
								</div>
								<div class="col-md-10">
									<textarea name="comment" class="form-control"></textarea>
								</div>

							</div>  
						</div><!-- /.table-responsive -->
						<input type="hidden" name="work_date" value="<?php echo date("Y-m-d",strtotime($employees[0]->secury_file_date));?>">
					</form>
					
				</div>
				<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
					<input type="hidden" name="data_json_array" value="">
					
					<button type="button" class="btn-danger btn" style="float: left;" id="delete_worker_row_btn"><i class="fa fa-trash-o"></i> <?php echo DELETE_BTN;?></button>

					<button type="button" class="btn-warning btn" id="validate_btn" onclick="validate_securysat_row(<?php echo $employee_data[0]->user_id?>);"><?php echo VALIDATE_BTN;?></button>

					<button type="button" class="btn-success btn" id="absent_btn" onclick="add_absent(<?php echo $employee_data[0]->user_id?>);"><?php echo ABSENT;?></button>
					<a href="<?php echo SURL.HR?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
				</div>  
			</div>
		</div>
	</div>
</div>

