<div id="page-wrapper">
  <div class="graphs" style="float: left; width: 100%;">   
  <?php
    if ($this->session->flashdata('err_message')) { ?>
    <div class="alert alert-danger"> <?php echo $this->session->flashdata('err_message'); ?> </div>
    <?php
  }
  if ($this->session->flashdata('ok_message')) {
    ?>
    <div class="alert alert-success alert-dismissable"> <?php echo $this->session->flashdata('ok_message'); ?> </div>
    <?php
  }
  ?> 
    <div class="xs tabls">      
      <div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
        <!-- offer title top -->
       <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">         <div class="col-md-7 medium"><?php echo OFFER;?> #<?php echo $completed_site->reference_no;?> | <?php echo $completed_site->description;?></div>
       
      <div class="col-md-5">
       
        <div class="float-right" style="margin-top: 5px; margin-right: 10px;">
          <div class="add-block"><?php echo MANAGER;?> : <?php echo $completed_site->site_manager;?> </div>       
        </div>          
      </div>
    </div>
    <!-- detail -->
    <div class="col-md-12 col-sm-12" style="text-align: center; padding-bottom: 16px; margin-top: 10px;">
             <div class="col-md-4"></div>
      <div class="col-md-4">
        <form method="post" action="<?php echo SURL.'admin/endconstruction/import_status/'.$completed_site->id;?>" enctype="multipart/form-data">
         <label class="label btn_6 label-success large" style="width: 100%; cursor: pointer;"><?php echo IMPORT_DATA;?>
          <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="import_data" id="import_data" style="display: none;" onchange="getPath(); this.form.submit()">
          <input type="hidden" name="file_path" id="file_path" value="">
        </label>
      </form>   
    </div>
    <div class="col-md-4"></div> 
              </div> 
  <form method="post" action="<?php echo SURL.'admin/endconstruction/save_invoice'?>">
    <input type="hidden" name="progress_state" value="<?php echo $progress_state;?>">
     <input type="hidden" name="start_period" value="<?php echo $start_period;?>">
      <input type="hidden" name="end_period" value="<?php echo $end_period;?>">
      <input type="hidden" name="period_bill" value="<?php echo $period_bill;?>">
      <input type="hidden" name="forcasted" value="<?php echo $forcasted;?>">
      <input type="hidden" name="purchase" value="<?php echo $purchase;?>">
      <input type="hidden" name="total_hours" value="<?php echo $total_hours;?>">
      <input type="hidden" name="hours" value="<?php echo $hours;?>">
      <input type="hidden" name="hourly_rate" value="<?php echo $hourly_rate;?>">
      <input type="hidden" name="general_fee" value="<?php echo $general_fee;?>">
      <input type="hidden" name="selling_price" value="<?php echo $selling_price;?>">
      <input type="hidden" name="site_id" value="<?php echo $completed_site->id;?>">
  <div class="col-md-12 col-sm-12" style="padding-top: 20px;border-bottom: 1px solid #444;padding-left:  0px;padding-right: 0px;">           
   <div class="col-md-7" style="border-right: 1px solid #444;min-height: 370px;">
     <div class="form-group">
      <label for="refference"><?php echo REFERENCE;?>:</label>
      <input type="text" class="form-control" name="refference" id="refference" value="<?php echo $reference;?>">
    </div>
    <div class="form-group">
      <label for="client"><?php echo CLIENT;?>:</label>
      <input type="text" class="form-control" id="client" name="client" value="<?php echo $company;?>">
    </div>

    <div class="form-group">
      <label for="total_vat_exc"><?php echo TOTAL_VAT_EXCL;?>:</label>
      <input type="text" class="form-control" id="total_vat_exc" name="total_without_vat" value="<?php echo $period_bill;?>">
    </div> 

    <div class="form-group">
      <label for="vat"><?php echo VAT_TEXT;?>:</label>
      <input type="text" class="form-control" id="vat" name="vat" value="<?php echo $vat;?>">
    </div>
    <div class="form-group">
      <label for="total"><?php echo TOTAL_TVAT;?>:</label>
      <input type="text" class="form-control" id="total" name="total_with_vat" value="<?php echo $total_with_vat;?>">
    </div>             

  </div> 

    <div class="col-md-5"> 
      <div class="form-group">
      <label for="client"><?php echo LAST_UPLOAD;?>:</label>
      <input type="text" name="last_upload" class="form-control" value="<?php echo $upload_date;?>">
    </div>
    <div class="form-group">
      <label for="offer"><?php echo UPLOAD_PATH;?>:</label>
      <input type="text" name="upload_path" class="form-control" value="<?php echo $upload_path;?>">
    </div>  
    </div>       
</div>

<div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px;">
 
  <button type="submit" class="btn-success btn"><?php echo SAVE_BTN;?></button>
  <a href="<?php echo SURL.'admin/endconstruction/detail/'.$completed_site->id;?>"> <span class="label btn_7 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
</div>  
</form>          

</div>
</div>
</div>
</div>
</div>

<script language="javascript" type="text/javascript">
function getPath() {
     var inputName = document.getElementById('import_data');
     var imgPath;

     imgPath = inputName.value;
     document.getElementById('file_path').value=imgPath;
     //alert(imgPath);
}
</script>