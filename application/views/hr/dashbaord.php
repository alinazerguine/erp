	
<div id="page-wrapper">
	<div class="graphs">
		<div class="col_1" style="margin-bottom: 70px; margin-top: 50px;">
			<!-- <div class="col-md-3 widget widget1">
				
			</div> -->
			<div class="col-md-12 col-sm-12">	
				<div class="col-md-8">						
					<div class="col-md-12 col-sm-12" style="text-align: center; margin-top: 30px;">					
							<a href="<?php echo SURL.HR.'/importdata/securysat'?>"><span class="label btn_6 label-success padding_size"><!-- <i class="fa fa-files-o" aria-hidden="true"></i> --><img src="<?php echo base_url('assets/images/excel.png');?>" style="width:32px;"> <?php echo IMPORT_SECURYSAT;?></span></a>	
					</div>

					<div class="col-md-12 col-sm-12" style="margin-top: 50px;">
							<div class="col-md-4">
								<a href="<?php echo SURL.HR.'/working_hours/sites'?>" class="danger"><span class="label btn_6 label-danger padding_size_2"><!-- <i class="lnr lnr-construction" aria-hidden="true"></i> --><img src="<?php echo base_url('assets/images/site.png');?>" style="width: 60px;vertical-align: top;"> </span><?php echo HOUR_SITE;?></a>
							</div>
							<div class="col-md-4">
								<a href="<?php echo SURL.HR.'/working_hours/employees'?>" class="warning"><span class="label btn_6 label-warning padding_size_2"><!-- <i class="lnr lnr-users" aria-hidden="true"></i> -->
								<img src="<?php echo base_url('assets/images/engineer.png');?>" style="width: 60px;vertical-align: top;"> </span><?php echo HOUR_EMPLOYEE;?></a>
							</div>
							<div class="col-md-4">
								<a href="<?php echo SURL.HR.'/working_hours/schedule'?>" class="info"><span class="label btn_6 label-info padding_size_2"><!-- <i class="lnr lnr-calendar-full" aria-hidden="true"></i> --> 
									<img src="<?php echo base_url('assets/images/schedule.png');?>" style="width: 60px;vertical-align: top;"> </span><?php echo SCHEDULE_TEXT;?></a>
							</div>						
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-4 switch-right1">
					
					<h2><?php echo NOTIFICATION;?></h2>
					<div class="scrollbar scrollbar1" id="style-2" style="float: left;">
						<?php if($notifications){
							foreach($notifications as $data){?>
						<div class="activity-row">							
							<div class="col-xs-9 activity-desc">
								<h5><a href="<?php echo $data->link;?>"><?php echo $data->title;?></a></h5>
								<p><?php echo $data->detail;?></p>
							</div>
							<div class="col-xs-3 activity-desc1"><h6><?php echo date('d/m/Y h:i', strtotime($data->created_at));?></h6></div>
							<div class="clearfix"> </div>
						</div>
						<?php }
					}else{
					?>						
						<div class="activity-row">							
							<div class="col-xs-9 activity-desc">
								<p>No notification found.</p>
							</div>							
							<div class="clearfix"> </div>
						</div>	
						<?php }?>			
					</div>
				
				</div>
			</div>
			
			
			
			
			<div class="clearfix"> </div>
		</div>

		

	</div>
	<!--body wrapper start-->
</div>
<!--body wrapper end-->

