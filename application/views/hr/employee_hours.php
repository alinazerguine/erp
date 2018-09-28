<div id="page-wrapper">	
	<div class="graphs" style="float: left; width: 100%;">		
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="col-md-12 col-sm-12 upper_bar"> <div class="col-md-12 medium" style="margin-top: 10px;"><?php echo MONITORING_HOURS;?> | <?php echo EMPLOYEE;?> : <?php echo $user_info->employee_name;?> <!-- | <?php //echo WORKING_HOUR_THIS_MONTH;?> : 23 --></div>				
				
			</div>
			<div class="col-md-12 col-sm-12" style="margin-top: 10px; padding:0px; ">
				<!-- <div class="col-md-1" style="width:2%; padding: 0px;">
					<span class="schedule_prev" id="employee_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
				</div> -->
				<div class="col-md-12" style="padding: 0px;">
					<div class="table-responsive">
						<table class="table table-striped" id="employee_calendar">
							<tr>
								<?php if($weeks_n_dates){
									$records = count($weeks_n_dates);
									$i=1;
									foreach($weeks_n_dates as $week=>$data){?>
									<td>
										<div class="worker_box <?php if($i==1){ echo "active";}?>" onclick="load_weekly_userdata(this,<?php echo $data['week'];?>,<?php echo $data['year'];?>)">	
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
					<span class="schedule_next" id="employee_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
				</div> -->
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped employee_hour_table" id="employee_hour_table" style="width: 100%;">
						<thead>
							<tr class="warning">
								<th><?php echo SITES;?></th>
								<th></th>
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
							$Grand_total_RH = 0;
							$Grand_total_RC = 0;
							if($user_data){
								
								foreach($user_data as $data){
									?>
									<!-- REAL HOURS -->
									<tr>
										<td rowspan="2"><?php echo $data['site_name']?></td>
										<td style="border-right: 1px solid #444; border-left: 1px solid #444;">HR</td>
										<?php
										$user_hours =$data['user_hours'];
										$totalReal = 0;
										foreach($user_hours as $hour){
											$hour_data = $hour['data'];
											$real_hour = ($hour_data) ? $hour_data->HR : '';
											if($real_hour){
												$totalReal +=($hour_data) ? decimalHours($hour_data->HR) : 0;												
											}

											?>
											<td><?php echo convertTime(decimalHours($real_hour));?></td>
											<?php }
											$Grand_total_RH += $totalReal;
											?>								
											<td><strong><?php echo convertTime($totalReal);?></strong></td>															
										</tr>
										<!-- COMPUTED/ACCOUNTABLE HOURS -->
										<tr>
											<td style="border-right: 1px solid #444; border-left: 1px solid #444;">HC</td>
											<?php
											$user_hours =$data['user_hours'];
											$totalAccountable = 0;
											foreach($user_hours as $hour){
												$hour_data = $hour['data'];
												$acc_hour = ($hour_data) ? $hour_data->HC : '';
												if($acc_hour){
													$totalAccountable +=($hour_data) ? decimalHours($hour_data->HC) : 0;
													$Grand_total_RC += $totalAccountable;
												}

												?>
												<td><?php echo convertTime(decimalHours($acc_hour));?></td>
												<?php }?>
												<td><strong><?php echo convertTime($totalAccountable);?></strong></td>															
											</tr>
											<?php 
										}
									}
									?>
									<?php if($user_absents){
									?>
									<tr>
										<td></td>
										<td></td>
										<?php foreach($user_absents as $absent){?>
										<td><?php echo ($absent['data']) ? 'absent' : '';?></td>
										<?php } ?>
										<td></td>
									</tr>
									<?php } ?>
									<?php if($user_comments){
									?>
									<tr>
										<td></td>
										<td></td>
										<?php foreach($user_comments as $comment){
											if($comment){
											$comment_tex = '<a href="#" data-toggle="tooltip" title="'.$comment->comment.'" style="color:#000; font-size:17px;"><i class="fa fa-comment-o" aria-hidden="true"></i></a>';
											}else{
												$comment_tex='';
											}
										?>
										<td><?php echo $comment_tex;?></td>
										<?php } ?>
										<td></td>
									</tr>
									<?php } ?>
								</tbody>
						<!-- <tfoot>
							
						</tfoot> -->
					</table>

				</div><!-- /.table-responsive -->
			</div>
			<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
				<div class="col-md-7"></div>
				<div class="col-md-5">
					<table class="table table-striped employee_hour_table" border="1" id="employee_hour_table_footer" style="width: 100%;">
						<tr>
							<td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo TOTAL;?></td>
							<td align="center"><?php echo HR_TEXT;?></td>								
							<td align="center"><strong><?php echo convertTime($Grand_total_RH);?></strong></td>															
						</tr>
						<tr>
							<td align="center"><?php echo HC_TEXT;?></td>								
							<td align="center"><strong><?php echo convertTime($Grand_total_RC);?></strong> <input type="hidden" name="userid" id="userid" value="<?php echo $user_info->id;?>"></td>									
						</tr>
					</table>
				</div>
			</div>  
			<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
				<a href="<?php echo SURL.HR.'/working_hours/employees'?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>

			</div>  
		</div>
	</div>
</div>
</div>

