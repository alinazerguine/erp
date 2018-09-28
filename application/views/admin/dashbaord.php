
<div id="page-wrapper">
	<div class="graphs">
		<div class="col_3">
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">					
					<span class="turnover"><?php echo numberFormat($total_turnover);?> <i class="fa fa-eur" aria-hidden="true"></i></span>					
					<div class="grow">
						<p><?php echo TURNOVER;?></p>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">					
					<span class="work_in_progress"><?php echo numberFormat($total_inprogress);?>  <i class="fa fa-eur" aria-hidden="true"></i></span>					
					<div class="grow grow1">
						<p><?php echo TOTAL_WORK_IN_PROGRESS;?></p>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">					
					<span class="number_of_site"><?php echo $total_sites;?></span>				
					<div class="grow grow3">
						<p><?php echo NUMBER_OF_SITES;?></p>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 widget">
				<div class="r3_counter_box">					
					<span class="pending_offer"><?php echo $offer_pending;?></span>				
					<div class="grow grow2">
						<p><?php echo OFFERS_PENDING;?></p>
					</div>
					
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>

		<!-- switches -->
		<div class="switches">
			<div class="col-4">
				<div class="col-md-4 switch-right1">					
					<div class="sparkline">
						<canvas id="doughnut" height="300" width="470" style="width:100%; height: 100%;"></canvas>
						<script>
							var doughnutData = [
							{
								value: <?php echo $general_companies;?>,
								color:"#FFCA28"
							},
							{
								value : <?php echo $public_entities;?>,
								color : "#8BC34A"
							},
							{
								value : <?php echo $private_companies;?>,
								color : "#00BCD4"
							},
							{
								value : <?php echo $private_person;?>,
								color : "#F44336"
							},
							];
							new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
						</script>
					</div>
					<div class="switch-right-grid">
						<div class="switch-right-grid1" style="padding-top: 2em;">
							<h3><?php echo MARKET_BREAKDOWN;?></h3>
							<div class="legend">
								<div id="os-process-lbl"><?php echo GENERAL_COMPANIES;?> <span><?php echo $general_companies;?></span></div>
								<div id="os-accept-lbl"><?php echo PUBLIC_ENTITIES;?> <span><?php echo $public_entities;?></span></div>
								<div id="os-cancel-lbl"><?php echo PRIVATE_COMPANY;?><span><?php echo $private_companies;?></span></div>
								<div id="os-reject-lbl"><?php echo PRIVATE_PERSON;?><span><?php echo $private_person;?></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 switch-right1">

					<div class="sparkline">
						<canvas id="pie" height="315" width="470" style="width: 100%;"></canvas>

						<script>
							var pieData = [
							{
								value: <?php echo $offer_pending;?>,
								color:"#FFCA28",
							},
							{
								value : <?php echo $offer_accepted;?>,
								color : "#8BC34A"
							},
							{
								value : <?php echo $offer_canceled;?>,
								color : "#00BCD4"
							},
							{
								value :<?php echo $offer_rejected;?>,
								color : "#F44336"
							}

							];
							new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
						</script>
					</div>
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3><?php echo OFFERS;?></h3>		
							<div class="legend">
								<div id="os-process-lbl"><?php echo PROCESSING;?> <span><?php echo $offer_pending;?></span></div>
								<div id="os-accept-lbl"><?php echo ACCEPTED;?> <span> <?php echo $offer_accepted;?></span></div>
								<div id="os-cancel-lbl"><?php echo CANCEL;?><span><?php echo $offer_canceled;?></span></div>
								<div id="os-reject-lbl"><?php echo REJECTED;?><span><?php echo $offer_rejected;?></span></div>
							</div>
						</div>
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
				
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- //switches -->
		
	</div>
	<!--body wrapper start-->
</div>
<!--body wrapper end-->

