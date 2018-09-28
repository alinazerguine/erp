<div id="page-wrapper">
	<div class="float-left" style="width: 100%;">
		<h2><?php echo CUATION_TITLE;?></h2>
	</div>
	<div class="float-right" style="width:16%;">
		
	</div>
	<div class="graphs" style="float: left; width: 100%;">		
		<div class="xs tabls">			
	<div class="bs-example4" data-example-id="simple-responsive-table">
	<form method="post" action="<?php echo SURL.'human_resource/caution/update'?>">
    <input type="hidden" name="site_id" value="<?php echo $caution->site_id;?>">
  <div class="col-md-12 col-sm-12">           
     <div class="form-group">
      <label for="refference"><?php echo CAUTION_REFERENCE;?> :</label>
      <input type="text" class="form-control" name="caution_reference" id="caution_reference" value="<?php echo $caution->caution_reference;?>">
    </div>
    <div class="form-group">
      <label for="client"><?php echo ADMIN_PROVISIONAL_ACCEPT;?> :</label>
      <input type="text" class="form-control datepicker" id="admin_provional_accpt_date" name="admin_provional_accpt_date" value="<?php echo date('d/m/Y',strtotime($caution->admin_provional_accpt_date));?>">
    </div>

    <div class="form-group">
      <label for="total_vat_exc"><?php echo FINANCIAL_PROVISIONAL_ACCEPT;?> :</label>
      <input type="text" class="form-control datepicker" id="financial_provional_accpt_date" name="financial_provional_accpt_date" value="<?php echo date('d/m/Y',strtotime($caution->financial_provional_accpt_date));?>">
    </div> 

    <div class="form-group">
      <label for="vat"><?php echo DURATION;?> :</label>
      <select class="form-control" id="duration_for_final_acceptance" name="duration_for_final_acceptance">
      	<option value=""></option>
        <?php for($i=1; $i<=10;$i++){?>
      	<option value="<?php echo $i;?>" <?php if($caution->duration_for_final_acceptance==$i){echo "selected";}?>><?php echo ($i==1) ? $i.' an' : $i.' ans';?></option>
      	<!-- <option value="2" <?php if($caution->duration_for_final_acceptance==2){echo "selected";}?>>2 ans</option> -->
        <?php }?>
      </select>
    </div>
    <div class="form-group">
      <label for="total"><?php echo ADMIN_FINAL_ACCEPT;?> :</label>
      <input type="text" class="form-control datepicker" id="admin_final_accpt_date" name="admin_final_accpt_date" value="<?php echo date('d/m/Y',strtotime($caution->admin_final_accpt_date));?>">
    </div>            
<div class="form-group">
      <label for="total"><?php echo FINANCIAL_FINAL_ACCEPT;?> :</label>
      <input type="text" class="form-control datepicker" id="financial_final_accpt_date" name="financial_final_accpt_date" value="<?php echo date('d/m/Y',strtotime($caution->financial_final_accpt_date));?>">
    </div> 
      
</div>

<div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px;">
 
  <button type="submit" class="btn-success btn"><?php echo SAVE_BTN;?></button>
  <a href="<?php echo SURL.'human_resource/caution/sites';?>"> <button type="button" class="btn btn-danger medium"><?php echo CANCEL_BTN;?></button></a>
</div>  
</form> 

		</div>
	</div>
</div>
</div>

