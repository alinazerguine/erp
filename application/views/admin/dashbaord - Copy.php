	
<div id="page-wrapper">
	<div class="graphs">
		<div class="col_3">
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">					
					<span class="turnover">12312 <i class="fa fa-eur" aria-hidden="true"></i></span>					
					<div class="grow">
						<p>Turnover</p>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">					
					<span class="work_in_progress">12312 <i class="fa fa-eur" aria-hidden="true"></i></span>					
					<div class="grow grow1">
						<p>Total work in progress</p>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">					
					<span class="number_of_site">12312</span>				
					<div class="grow grow3">
						<p>Number of sites</p>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 widget">
				<div class="r3_counter_box">					
					<span class="pending_offer">12312</span>				
					<div class="grow grow2">
						<p>Offers Pending</p>
					</div>
					
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>

		<!-- switches -->
		<div class="switches">
			<div class="col-12">
				<div class="col-md-6">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>Market Breakdown</h3>
							<div class="legend">
								<div id="os-process-lbl">Processing <span>30</span></div>
								<div id="os-accept-lbl">Accepted <span> 50</span></div>
								<div id="os-cancel-lbl">Cancel<span>100</span></div>
								<div id="os-reject-lbl">Rejected<span>40</span></div>
							</div>
							<canvas id="doughnut" height="300" width="470" style="width: 300px; height: 300px;"></canvas>
							<script>
								var doughnutData = [
								{
									value: 30,
									color:"#FFCA28"
								},
								{
									value : 50,
									color : "#8BC34A"
								},
								{
									value : 100,
									color : "#00BCD4"
								},
								{
									value : 40,
									color : "#F44336"
								},
								];
								new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
							</script>
							
						</div>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>Offers</h3>		
							<div class="legend">
								<div id="os-process-lbl">Processing <span>7</span></div>
								<div id="os-accept-lbl">Accepted <span> 30</span></div>
								<div id="os-cancel-lbl">Cancel<span>2</span></div>
								<div id="os-reject-lbl">Rejected<span>9</span></div>
							</div>
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
					</div>
				</div>				
			</div>			
			<!-- //switches -->			
		</div>
		<div class="col_1">
			<div class="col-md-4 span_8">
				<div class="activity_box">
					<h3>Inbox</h3>
					<div class="scrollbar scrollbar1" id="style-2">
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src="images/1.png" class="img-responsive" alt=""></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">John Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src="images/5.png" class="img-responsive" alt=""></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Andrew Jos</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src="images/3.png" class="img-responsive" alt=""></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Adom Smith</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src="images/4.png" class="img-responsive" alt=""></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#">Peter Carl</a></h5>
								<p>Hey ! There I'm available.</p>
							</div>
							<div class="col-xs-2 activity-desc1"><h6>13:40 PM</h6></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row">
							<div class="col-xs-3 activity-img"><img src="images/1.png" class="img-responsive" alt=""></div>
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
			<div class="col-md-4 span_8">
				<div class="activity_box activity_box1">
					<h3>chat</h3>
					<div class="scrollbar" id="style-2">
						<div class="activity-row activity-row1">
							<div class="col-xs-3 activity-img"><img src="images/1.png" class="img-responsive" alt=""><span>10:00 PM</span></div>
							<div class="col-xs-5 activity-img1">
								<div class="activity-desc-sub">
									<h5>John Smith</h5>
									<p>Hello !</p>
								</div>
							</div>
							<div class="col-xs-4 activity-desc1"></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row activity-row1">
							<div class="col-xs-2 activity-desc1"></div>
							<div class="col-xs-7 activity-img2">
								<div class="activity-desc-sub1">
									<h5>Adom Smith</h5>
									<p>Hi,How are you ? What about our next meeting?</p>
								</div>
							</div>
							<div class="col-xs-3 activity-img"><img src="images/3.png" class="img-responsive" alt=""><span>10:02 PM</span></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row activity-row1">
							<div class="col-xs-3 activity-img"><img src="images/1.png" class="img-responsive" alt=""><span>10:00 PM</span></div>
							<div class="col-xs-5 activity-img1">
								<div class="activity-desc-sub">
									<h5>John Smith</h5>
									<p>Yeah fine</p>
								</div>
							</div>
							<div class="col-xs-4 activity-desc1"></div>
							<div class="clearfix"> </div>
						</div>
						<div class="activity-row activity-row1">
							<div class="col-xs-2 activity-desc1"></div>
							<div class="col-xs-7 activity-img2">
								<div class="activity-desc-sub1">
									<h5>Adom Smith</h5>
									<p>Wow that's great</p>
								</div>
							</div>
							<div class="col-xs-3 activity-img"><img src="images/3.png" class="img-responsive" alt=""><span>10:02 PM</span></div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<form>
						<input type="text" value="Enter your text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your text';}" required="">
						<input type="submit" value="Send" required="">		
					</form>
				</div>
			</div>
			<div class="col-md-4 span_8">
				<div class="activity_box activity_box2">
					<h3>todo</h3>
					<div class="scrollbar" id="style-2">
						<div class="activity-row activity-row1">
							<div class="single-bottom">
								<ul>
									<li>
										<input type="checkbox" id="brand" value="">
										<label for="brand"><span></span> Sunt in culpa qui officia.</label>
									</li>
									<li>
										<input type="checkbox" id="brand1" value="">
										<label for="brand1"><span></span> Fugiat quo voluptas nulla.</label>
									</li>
									<li>
										<input type="checkbox" id="brand2" value="">
										<label for="brand2"><span></span> Dolorem eum.</label>
									</li>
									<li>
										<input type="checkbox" id="brand9" value="">
										<label for="brand9"><span></span> Pain that produces no resultant.</label>
									</li>
									<li>
										<input type="checkbox" id="brand8" value="">
										<label for="brand8"><span></span> Cupidatat non proident.</label>
									</li>
									<li>
										<input type="checkbox" id="brand7" value="">
										<label for="brand7"><span></span> Praising pain was born.</label>
									</li>
									<li>
										<input type="checkbox" id="brand3" value="">
										<label for="brand3"><span></span> Computer &amp; Electronics</label>
									</li>
									<li>
										<input type="checkbox" id="brand4" value="">
										<label for="brand4"><span></span> Dolorem ipsum quia.</label>
									</li>
									<li>
										<input type="checkbox" id="brand5" value="">
										<label for="brand5"><span></span> Consequatur aut perferendis.</label>
									</li>
									<li>
										<input type="checkbox" id="brand6" value="">
										<label for="brand6"><span></span> Dolorem ipsum quia.</label>
									</li>
									
									
								</ul>
							</div>
						</div>
					</div>
					<form>
						<input type="text" value="Enter your text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your text';}" required="">
						<input type="submit" value="Submit" required="">		
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
			
		</div>
		<!--body wrapper start-->
	</div>
	<!--body wrapper end-->

