<div id="page-wrapper">	
	<div class="graphs" style="float: left; width: 100%;">	
		<?php
		if ($this->session->flashdata('err_message')) { ?>
		<div class="alert alert-danger"> <?php echo $this->session->flashdata('err_message'); ?> </div>
		<?php
	}
	if ($this->session->flashdata('ok_message')) {
		?>
		<div class="alert alert-success alert-dismissable"> <?php echo $this->session->flashdata('ok_message'); ?> </div>
		<?php
	}
	?>	
	<div class="xs tabls">			
		<div class="bs-example4" data-example-id="simple-responsive-table">
			<div class="col-md-12 col-sm-12 upper_bar"> <div class="col-md-12 medium"><span style="float: left;margin-top: 6px;"><?php echo SCHEDULE;?></span> 
				<div class="float-right">
          			<div class="add-block"><button type="button" class="btn-success btn" onclick="print_schedule('print_schedule')"><i class="fa fa-print" aria-hidden="true"></i> Imprimer planning</button></div>       
        </div>   </div>				

		</div>
		<div class="col-md-12 col-sm-12" style="margin-top: 10px; padding:0px; ">
			<div class="col-md-1" style="width:2%; padding: 0px;">
				<span class="schedule_prev" id="schedule_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
			</div>
			<div class="col-md-10" style="width:95%; padding: 0px;">
				<div class="table-responsive">
					<table class="table table-striped" id="schedule_calendar" style="width: 100%; margin-top: 0px;">
						<tr>
							<?php if($weeks_n_dates){
								$records = count($weeks_n_dates);
								$i=1;
								foreach($weeks_n_dates as $week=>$data){?>
								<td>
									<div class="worker_box <?php if($i==1){ echo "active";}?>" onclick="load_schedule(this,<?php echo $data['week'];?>,<?php echo $data['year'];?>)">	
										<input type="hidden" name="week" class="week <?php if($i==1){ echo 'current';}elseif($i==$records){echo 'last';}?>" value="<?php echo $data['week'];?>">
										<input type="hidden" name="year" class="year <?php if($i==1){ echo 'current';}elseif($i==$records){echo 'last';}?>" value="<?php echo $data['year'];?>">				
										<span class="name"><?php echo $data['label'];?></span>
										<span class="profile"><?php echo $data['dates'];?></span>					

									</div>
								</td>
								<?php 
								$i++;}
							}
							?>								
						</tr>

					</table>
				</div><!-- /.table-responsive -->
			</div>
			<div class="col-md-1" style="width:3%; padding: 0px;">
				<span class="schedule_next" id="schedule_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
			</div>
		</div>
		<form method="post" action="<?php echo SURL.'human_resource/working_hours/save_schedule'?>" id="schedule_form">
			<div class="col-md-12 col-sm-12">
				<div class="wrapper1">
					<div class="div1"></div>
				</div>
				<div class="wrapper2">
					<div class="div2" id="print_schedule">
				<!-- <div class="table-responsive1" id="print_schedule"> -->
					<table class="table table-striped employee_hour_table" id="employee_schedule_table" style="width: 100%; margin-top: 10px;">
						<thead>
							<tr class="warning">
								<th width="20%"><?php echo EMPLOYEE;?></th>
								<th width="10%"><?php echo MONDAY;?></th>
								<th width="10%"><?php echo TUESDAY;?></th>
								<th width="10%"><?php echo WEDNESDAY;?></th>
								<th width="10%"><?php echo THURSDAT;?></th>
								<th width="10%"><?php echo FRIDAY;?></th>
								<th width="10%"><?php echo SATURDAY;?></th>
								<th width="10%"><?php echo SUNDAY;?></th>	
								<th width="10%"></th>						
							</tr>
						</thead>
						<tbody>
							<?php if($user_schedule){
								foreach($user_schedule as $emp){
								//print_r($emp['user_schedule']);exit;?>
								<!-- --------- morning schedules------------------ -->
								<tr id="row_<?php echo $emp['id'];?>_0">
									<td rowspan="2"><?php echo $emp['employee_name'];?><input type="hidden" name="employee_id[]" id="employee_id_<?php echo $emp['id'];?>" value="<?php echo $emp['id'];?>"></td>
									<?php foreach($emp['user_schedule'] as $schedule){
										$user_schedule = $schedule['schedule'];
										
										if($user_schedule){
											$morning_schedule = $user_schedule->morning_schedule;
										}else{
											$morning_schedule='';
										}
										?>
										<td><?php echo get_schedule_site_dropdown('morning_schedule['.$emp['id'].']',$working_sites,$morning_schedule);?></td>
										<?php }?>	
										<td><span class="copy_paste" onclick="copy_schedule(<?php echo $emp['id'];?>)" data-toggle="tooltip" title="Copy"><i class="fa fa-files-o" aria-hidden="true"></i></span> <span class="copy_paste" onclick="paste_schedule(<?php echo $emp['id'];?>)" data-toggle="tooltip" title="Paste"><i class="fa fa-clipboard" aria-hidden="true"></i></span></td>																							
									</tr>
									<!-- --------- afternoon schedules------------------ -->
									<tr id="row_<?php echo $emp['id'];?>_1">
										<!-- <td></td> -->
										<?php foreach($emp['user_schedule'] as $schedule){
											$user_schedule = $schedule['schedule'];

											if($user_schedule){
												$afternoon_schedule = $user_schedule->afternoon_schedule;
											}else{
												$afternoon_schedule='';
											}
											?>
											<td><?php echo get_schedule_site_dropdown('afternoon_schedule['.$emp['id'].']',$working_sites,$afternoon_schedule);?></td>
											<?php }?>	
											<td></td>												
										</tr>
										<?php }
									}
									?>
								</tbody>

							</table>

						<!-- </div> --><!-- /.table-responsive -->
					</div>
				</div>
					</div>
					<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
						<input type="hidden" name="week_number" id="week_number" value="<?php echo $current_week;?>">
						<input type="hidden" name="current_year" id="current_year" value="<?php echo $current_year;?>">
						<button type="submit" class="btn-success btn" id="validate_btn"><?php echo SAVE_BTN;?></button>
						<a href="<?php echo SURL.HR;?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
					</div>  
				</form> 
				<input type="hidden" name="copied_id" id="copied_id" value="">
			</div>
		</div>
	</div>
</div>

