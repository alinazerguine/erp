
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
				<div class="col-md-6 switch-right1">					
					<div class="sparkline">
						<canvas id="doughnut" height="300" width="470" style="width: 300px; height: 300px;"></canvas>
						<script>
							var doughnutData = [
							{
								value: <?php echo $offer_pending;?>,
								color:"#FFCA28"
							},
							{
								value : <?php echo $offer_accepted;?>,
								color : "#8BC34A"
							},
							{
								value : <?php echo $offer_pending;?>,
								color : "#00BCD4"
							},
							{
								value : <?php echo $offer_pending;?>,
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
								<div id="os-process-lbl"><?php echo PROCESSING;?> <span><?php echo $offer_pending;?></span></div>
								<div id="os-accept-lbl"><?php echo ACCEPTED;?> <span> <?php echo $offer_pending;?></span></div>
								<div id="os-cancel-lbl"><?php echo CANCEL;?><span><?php echo $offer_pending;?></span></div>
								<div id="os-reject-lbl"><?php echo REJECTED;?><span><?php echo $offer_pending;?></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 switch-right1">

					<div class="sparkline">
						<canvas id="pie" height="315" width="470" style="width: 470px; height: 315px;"></canvas>

						<script>
							var pieData = [
							{
								value: 7,
								color:"#FFCA28",
							},
							{
								value : 30,
								color : "#8BC34A"
							},
							{
								value : 2,
								color : "#00BCD4"
							},
							{
								value : 9,
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
								<div id="os-process-lbl"><?php echo PROCESSING;?> <span>7</span></div>
								<div id="os-accept-lbl"><?php echo ACCEPTED;?> <span> 30</span></div>
								<div id="os-cancel-lbl"><?php echo CANCEL;?><span>2</span></div>
								<div id="os-reject-lbl"><?php echo REJECTED;?><span>9</span></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- //switches -->
		<div class="col_1">
			<div class="col-md-6">
				<div class="activity_box">
					<h3><?php echo NOTIFICATION;?></h3>
					<div class="scrollbar scrollbar1" id="style-2">
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/1.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">John Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/5.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Andrew Jos</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/3.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Adom Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/4.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Peter Carl</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/1.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">John Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="activity_box activity_box1">
					<h3><?php echo LATEST_OFFERS;?></h3>
					<div class="scrollbar scrollbar1" id="style-2">
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/1.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">John Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/5.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Andrew Jos</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/3.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Adom Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/4.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Peter Carl</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src='<?php echo SURL;?>assets/images/1.png' class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">John Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix"> </div>

		</div>
	</div>
	<!--body wrapper start-->
</div>
<!--body wrapper end-->

