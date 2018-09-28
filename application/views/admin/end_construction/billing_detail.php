<div id="page-wrapper">
	<div class="float-left" style="width: 50%;">
		<h2><?php echo BILLING_DETAIL;?></h2>
	</div>
	
	<div class="graphs" style="float: left; width: 100%;">	
		
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
				<div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">         
					<div class="col-md-7 medium" style="margin-top: 5px;"><?php echo 'Chantier';?> #<?php echo $offer->reference_no;?> | <?php echo $offer->description;?></div>
					<div class="col-md-3" style="margin-top: 4px;">
						<div class="progress">
				        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress_bar;?>%;">
				          <span class="show"><?php echo numberFormat($progress_bar);?>%</span>
				        </div>
				      </div>                   
					</div>
					
				</div>
				<div class="col-md-12 col-sm-12" style="margin-top: 5px;">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="warning">
									<th><?php echo PROGRESS_STATE;?></th>
									<th><?php echo START_PERIOD;?></th>
									<th><?php echo END_PERIOD;?></th>
									<th><?php echo TOTAL_PERIOD_BILL;?></th>
									<th><?php echo TOTAL_BILL;?></th>
									<th><?php echo FORCASTED;?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($billing){
									$total_bill = 0;
									foreach($billing as $data){
										$total_bill += $data->period_bill;
										?>
								<tr>
									<td><?php echo $data->progress_state;?></td>
									<td><?php echo date("d/m/Y",strtotime($data->start_period));?></td>
									<td><?php echo date("d/m/Y",strtotime($data->end_period));?></td>
									<td><?php echo numberFormat($data->period_bill).CURRENCY;?></td>
									<td><?php echo numberFormat($total_bill).CURRENCY;?></td>
									<td><?php echo numberFormat($data->forcasted).CURRENCY;?></td>								
								</tr>
							<?php 
									}
								}
							?>
				</tbody>
				<!-- <tfoot>
					<tr class="warning">
						<th></th>
						<th></th>
						<th><?php echo BASIC_ORDER;?></th>
						<th>20 047,10</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot> -->
			</table>
		</div><!-- /.table-responsive -->
	</div>
	<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">  
  <a href="<?php echo SURL.'admin/endconstruction/detail/'.$offer->id?>"><span class="label btn_6 label-danger medium"><?PHP ECHO BACK_BTN?></span></a>
</div>  

</div>
</div>
</div>
</div>

