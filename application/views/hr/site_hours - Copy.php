<div id="page-wrapper">	
	<div class="graphs" style="float: left; width: 100%;">		
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="col-md-12 col-sm-12 upper_bar"> 
					<div class="col-md-12 medium" style="margin-top: 10px;"><?php echo MONITORING_HOURS;?> | Bureaux #17-5235 | <?php echo CLIENT;?> : Lixon | <?php echo MANAGER;?> : Manu</div>				
				
			</div>
			<div class="col-md-12 col-sm-12" style="margin-top: 10px; padding:0px; ">
				<div class="col-md-1" style="width:2%; padding: 0px;">
				<span class="schedule_prev" id="site_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
				</div>
				<div class="col-md-10" style="width:95%; padding: 0px;">
				<div class="table-responsive">
					<table class="table table-striped" id="site_calendar">
						<tr>
							<?php if($weeks_n_dates){
								$records = count($weeks_n_dates);
								$i=1;
								foreach($weeks_n_dates as $week=>$data){?>
							<td>
								<div class="worker_box <?php if($i==1){ echo "active";}?>">	
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
				<span class="schedule_next" id="site_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
				</div>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped">
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
							<tr>
								<td>Michael Dubois</td>
								<td></td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td></td>
								<td></td>
								<td>16</td>															
							</tr>
							<tr>
								<td>Martin Fernandez</td>
								<td></td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td></td>
								<td></td>
								<td>16</td>															
							</tr>
							<tr>
								<td>Corentin Deprez</td>
								<td></td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td></td>
								<td></td>
								<td>16</td>															
							</tr>
							<tr>
								<td>Thomas Hilt</td>
								<td></td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td>4</td>
								<td></td>
								<td></td>
								<td>16</td>															
							</tr>
						</tbody>
						<tfoot>
							<tr class="warning">
								<td>Total</td>
								<td></td>
								<td>16</td>
								<td>16</td>
								<td>16</td>
								<td>16</td>
								<td></td>
								<td></td>
								<td>64</td>
							</tr>
						</tfoot>
					</table>

				</div><!-- /.table-responsive -->
			</div>
			<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
             <a href="<?php echo SURL.HR.'/working_hours/sites'?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
</div>  
		</div>
	</div>
</div>
</div>

