<div id="page-wrapper">	
	<div class="graphs" style="float: left; width: 100%;">		
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="col-md-12 col-sm-12 upper_bar"> 
					<div class="col-md-12 medium" style="margin-top: 10px;"><?php echo MONITORING_HOURS;?> | #<?php echo $site_info->reference_no;?> <?php echo $site_info->description;?> | <?php echo MANAGER;?> : <?php echo $site_info->manager_name;?></div>				
				
			</div>
			<div class="col-md-12 col-sm-12" style="margin-top: 10px; padding:0px; ">
				<!-- <div class="col-md-1" style="width:2%; padding: 0px;">
				<span class="schedule_prev" id="site_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
				</div> -->
				<div class="col-md-12" style="padding: 0px;">
				<div class="table-responsive">
					<table class="table table-striped" id="site_calendar">
						<tr>
							<?php if($weeks_n_dates){
								$records = count($weeks_n_dates);
								$i=1;
								foreach($weeks_n_dates as $week=>$data){?>
							<td>
								<div class="worker_box <?php if($i==1){ echo "active";}?>" onclick="load_weekly_sitedata(this,<?php echo $data['week'];?>,<?php echo $data['year'];?>)">	
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
			<!-- <div class="col-md-1" style="width:3%; padding: 0px;">
				<span class="schedule_next" id="site_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
				</div> -->
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped" id="site_hour_table" style="width: 100%;">
						<thead>
							<tr class="warning">
								<th><?php echo EMPLOYEE;?></th>
								<th><?php echo MONDAY;?></th>
								<th><?php echo TUESDAY;?></th>
								<th><?php echo WEDNESDAY;?></th>
								<th><?php echo THURSDAT;?></th>
								<th><?php echo FRIDAY;?></th>
								<th><?php echo SATURDAY;?></th>
								<th><?php echo SUNDAY;?></th>	
								<th><?php echo TOTAL;?></th>								
							</tr>
						</thead>
						<tbody>
							<?php 
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

								?>
							<tr>
								<td><?php echo $data['employee_name'];?></td>
								<?php 
								$total_user_hours = 0;
								foreach($user_hours as $key=>$hour){

									$hour_data = $hour['data'];
									$worked_hours = ($hour_data) ? $hour_data->worked_hours: '';
									if($worked_hours){
										$total_user_hours+=($hour_data) ? decimalHours($hour_data->worked_hours) : 0;
										${"grand_total_" .$key}+=($hour_data) ? decimalHours($hour_data->worked_hours) : 0;										
									}
								?>
								<td><?php echo convertTime(decimalHours($worked_hours));?></td>
								<?php }
								$grand_total+=$total_user_hours;
								?>
								<td><strong><?php echo convertTime($total_user_hours);?></strong></td>															
							</tr>
							<?php 
						}
						} ?>							
						</tbody>
						<tfoot>
							<tr class="warning">
								<td><strong>Total</strong></td>
								<td><strong><?php echo ($grand_total_0>0) ? convertTime($grand_total_0) : '';?></strong></td>
								<td><strong><?php echo ($grand_total_1>0) ? convertTime($grand_total_1) : '';?></strong></td>
								<td><strong><?php echo ($grand_total_2>0) ? convertTime($grand_total_2) : '';?></strong></td>
								<td><strong><?php echo ($grand_total_3>0) ? convertTime($grand_total_3) : '';?></strong></td>
								<td><strong><?php echo ($grand_total_4>0) ? convertTime($grand_total_4) : '';?></strong></td>
								<td><strong><?php echo ($grand_total_5>0) ? convertTime($grand_total_5) : '';?></strong></td>
								<td><strong><?php echo ($grand_total_6>0) ? convertTime($grand_total_6) : '';?></strong></td>
								<td><strong><?php echo convertTime($grand_total);?></strong></td>
							</tr>
						</tfoot>
					</table>

				</div><!-- /.table-responsive -->
			</div>
			<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
				<input type="hidden" name="site_id" id="site_id" value="<?php echo $site_info->site_id;?>">
             <a href="<?php echo SURL.HR.'/working_hours/sites'?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
</div>  
		</div>
	</div>
</div>
</div>

