<div id="page-wrapper">	
	<div class="graphs" style="float: left; width: 100%;">	
		<?php
			//print_r($weeks_n_dates);
		?>
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="col-md-12 col-sm-12 upper_bar"> <div class="col-md-12 medium" style="margin-top: 10px;">Monitoring Hours | Bureaux #17-5235 | Client : Lixon | Manager : Manu</div>				
				
			</div>
			<div class="col-md-12 col-sm-12" style="margin-top: 10px; padding:0px; ">
				<div class="col-md-1" style="width:2%; padding: 0px;">
				<span class="schedule_prev" id="schedule_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
				</div>
				<div class="col-md-10" style="width:95%; padding: 0px;">
				<div class="table-responsive">
					<table class="table table-striped" id="schedule_calendar">
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
				<span class="schedule_next" id="schedule_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
				</div>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr class="warning">
								<th>EMPLOYEE</th>
								<th>Monday</th>
								<th>Tuesday</th>
								<th>Wednesday</th>
								<th>Thursday</th>
								<th>Friday</th>
								<th>Saturday</th>
								<th>Sunday</th>								
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Michael Dubois</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td></td>
								<td></td>														
							</tr>
							<tr>
								<td>Martin Fernandez</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td></td>
								<td></td>														
							</tr>
							<tr>
								<td>Corentin Deprez</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td></td>
								<td></td>														
							</tr>
							<tr>
								<td>Thomas Hilt</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td>Bruxelles formation</td>
								<td></td>
								<td></td>														
							</tr>
						</tbody>
						
					</table>

				</div><!-- /.table-responsive -->
			</div>
			<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">
				 <a href="<?php echo SURL.HR;?>"><span class="label btn_6 label-success medium">Validate</span></a>
             <a href="<?php echo SURL.HR;?>"><span class="label btn_6 label-danger medium">Cancel</span></a>
</div>  
		</div>
	</div>
</div>
</div>

