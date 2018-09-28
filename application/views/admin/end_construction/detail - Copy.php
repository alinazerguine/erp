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
  <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">         
    <div class="col-md-6 medium" style="margin-top: 5px;"><?php echo 'Chantier';?> #<?php echo $completed_site->reference_no;?> | <?php echo $completed_site->description;?></div>
    <div class="col-md-2" style="margin-top: 4px; padding: 0px;">
      <div class="progress">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress_bar;?>%;">
          <span class="show"><?php echo numberFormat($progress_bar);?>%</span>
        </div>
      </div>                     
    </div>
    <div class="col-md-4" style="padding: 0px;">     
      <div class="float-right" style="margin-top: 2px; margin-right: 10px;">
        <div class="add-block"><?php echo MANAGER;?> : <?php echo $completed_site->site_manager;?> &nbsp; <a href="<?php echo SURL.'admin/endconstruction/import_status/'.$completed_site->id?>"><i class="fa fa-plus-circle"></i> <?php echo ADD_INVOICE;?></a></div>       
      </div>          
    </div>
  </div>
  <!-- detail -->
  <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px; margin-top: 5px;">         
    <div class="col-md-4"><?php echo INFORMATION_CLIENT;?></div>
    <div class="col-md-6">
      <table style="width: 100%;">
        <tr>
          <td width="30%"><?php echo TITLE;?></td>
          <td width="20%"><?php echo QTY;?></td>
          <td width="25%"><?php echo HOURLY_RATE;?></td>
          <td width="25%"><?php echo P_TOTAL;?></td>
        </tr>
      </table>                       
    </div>
    <div class="col-md-2">
     
    </div>

  </div>
  <div class="col-md-12 col-sm-12" style="padding-top: 20px;border-bottom: 1px solid #444;padding-left:  0px;padding-right: 0px;">           
   <div class="col-md-4" style="border-right: 1px solid #444;min-height: 370px;">
     <div class="form-group">
      <label for="refference"><?php echo COMPANY;?> :</label>
      <input type="text" class="form-control" value="<?php echo $completed_site->company;?>">
    </div>
    <div class="form-group">
      <label for="description"><?php echo CONTACT_PERSON;?> :</label>
      <input type="text" class="form-control" value="<?php echo $completed_site->contact_person;?>">
    </div>

    <div class="form-group">
      <label for="market"><?php echo EMAIL;?> :</label>
      <input type="text" class="form-control" value="<?php echo $completed_site->email;?>">
    </div> 

    <div class="form-group">
      <label for="client"><?php echo MOBILE;?> :</label>
      <input type="text" class="form-control" value="<?php echo $completed_site->gsm;?>">
    </div>
    <div class="form-group">
      <label for="offer"><?php echo PHONE;?> :</label>
      <input type="text" class="form-control" value="<?php echo $completed_site->phone;?>">
    </div>               

  </div>

  <div class="col-md-6" style="border-right: 1px solid #444;min-height: 370px;"> 
   <table class="table table-striped" style="width: 100%;">
    <tr>
      <td width="30%"><?php echo PURCHASE;?></td>
      <td width="20%"></td>
      <td width="25%"></td>
      <td width="25%"><?php echo numberFormat($completed_site->purchase).' '.CURRENCY;?></td>
    </tr>
    <!-- numberFormat($value->sale_price) -->
    <tr>
      <td width="30%"><?php echo PRESTATION;?></td>
      <td width="20%"><?php echo convertTime($completed_site->working_hours);?></td>
      <td width="25%"><?php echo $completed_site->hourly_rate.' '.CURRENCY;?></td>
      <td width="25%"><?php echo numberFormat($completed_site->working_hours*$completed_site->hourly_rate).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td width="30%"><?php echo SUBCONTRACTORS;?></td>
      <td width="20%"></td>
      <td width="25%"></td>
      <td width="25%"><?php echo numberFormat($completed_site->subcontractors).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td colspan="4" style="height: 100px;"></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo PRICE_OF_RETURN;?></td>
      <td><?php echo numberFormat($completed_site->cost_price).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo MARGIN;?></td>
      <td><?php echo numberFormat($completed_site->margin).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo GENERAL_FEES;?></td>
      <td><?php echo numberFormat($completed_site->general_fee).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo SELLING_PRICE_WITHOUT_VAT;?></td>
      <td><?php echo numberFormat($completed_site->total_without_vat).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo VAT_TEXT;?> <?php echo $completed_site->tva_rate;?>%</td>
      <td><?php echo numberFormat($completed_site->total_vat).' '.CURRENCY;?></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo SELLING_PRICE_WITH_VAT;?></td>
      <td><?php echo numberFormat($completed_site->total_with_vat).' '.CURRENCY;?></td>
    </tr>
  </table>                  
</div>  

<div class="col-md-2"> 
  <div class="form-group">
    <label for="client"><?php echo LAST_UPLOAD;?> :</label>
    <input type="text" class="form-control" value="19/12/2017">
  </div>
  <div class="form-group">
    <label for="offer"><?php echo UPLOAD_PATH;?> :</label>
    <input type="text" class="form-control" value="c:/Program files/images/cmd 17-5235">
  </div>  
</div>       
</div>

<div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px; margin-top: 10px;">
  <a href="<?php echo SURL.'admin/endconstruction/billing/'.$completed_site->id?>"><span class="label btn_6 label-warning medium"><?php echo BILLING_HISTORY_BTN;?></span></a>
  
  <a href="<?php echo SURL.'admin/endconstruction/documents/'.$completed_site->id?>"> <span class="label btn_7 label-success medium"><?php echo DOCUMENTS;?></span></a>
  <a href="<?php echo SURL.'admin/endconstruction';?>"> <span class="label btn_7 label-danger medium"><?php echo BACK_BTN;?></span></a>
  
</div>            

</div>
</div>
</div>
</div>
</div>