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
      <div class="col-md-6 medium" style="margin-top: 5px;"><?php echo 'Chantier';?> #<?php echo $executed_sites->reference_no;?> | <?php echo $executed_sites->description;?></div>
      <div class="col-md-2" style="margin-top: 4px; padding: 0px;" >
        <!-- progress bar -->
       <div class="progress">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress_bar;?>%;">
          <span class="show"><?php echo numberFormat($progress_bar);?>%</span>
        </div>
      </div>             
      </div>
      <div class="col-md-4" style="padding: 0px;">
        <div class="float-right" style="margin-top: 2px;">
          <div class="add-block"><?php echo MANAGER;?> : <?php echo $executed_sites->site_manager;?> &nbsp;&nbsp; <a href="<?php echo SURL.'admin/execution/import_status/'.$executed_sites->id?>"><i class="fa fa-plus-circle"></i> <?php echo ADD_INVOICE;?></a></div>       
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
        <input type="text" class="form-control" value="<?php echo $executed_sites->company;?>">
      </div>
      <div class="form-group">
        <label for="description"><?php echo CONTACT_PERSON;?> :</label>
        <input type="text" class="form-control" value="<?php echo $executed_sites->contact_person;?>">
      </div>

      <div class="form-group">
        <label for="market"><?php echo EMAIL;?> :</label>
        <input type="text" class="form-control" value="<?php echo $executed_sites->email;?>">
      </div> 

      <div class="form-group">
        <label for="client"><?php echo MOBILE;?> :</label>
        <input type="text" class="form-control" value="<?php echo $executed_sites->gsm;?>">
      </div>
      <div class="form-group">
        <label for="offer"><?php echo PHONE;?> :</label>
        <input type="text" class="form-control" value="<?php echo $executed_sites->phone;?>">
      </div>              

    </div>

    <div class="col-md-6" style="border-right: 1px solid #444;min-height: 370px;"> 
      <table class="table table-striped" style="width: 100%;">
        <tr>
          <td width="30%"><?php echo PURCHASE;?></td>
          <td width="20%"></td>
          <td width="25%"></td>
          <td width="25%"><?php echo numberFormat($executed_sites->purchase).' '.CURRENCY;?></td>
        </tr>
        <!-- numberFormat($value->sale_price) -->
        <tr>
          <td width="30%"><?php echo PRESTATION;?></td>
          <td width="20%"><?php echo convertTime($executed_sites->working_hours);?></td>
          <td width="25%"><?php echo $executed_sites->hourly_rate.' '.CURRENCY;?></td>
          <td width="25%"><?php echo numberFormat($executed_sites->working_hours*$executed_sites->hourly_rate).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td width="30%"><?php echo SUBCONTRACTORS;?></td>
          <td width="20%"></td>
          <td width="25%"></td>
          <td width="25%"><?php echo numberFormat($executed_sites->subcontractors).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td colspan="4" style="height: 100px;"></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo PRICE_OF_RETURN;?></td>
          <td><?php echo numberFormat($executed_sites->cost_price).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo MARGIN;?></td>
          <td><?php echo numberFormat($executed_sites->margin).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo GENERAL_FEES;?></td>
          <td><?php echo numberFormat($executed_sites->general_fee).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo SELLING_PRICE_WITHOUT_VAT;?></td>
          <td><?php echo numberFormat($executed_sites->total_without_vat).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo VAT_TEXT;?> <?php echo $executed_sites->tva_rate;?>%</td>
          <td><?php echo numberFormat($executed_sites->total_vat).' '.CURRENCY;?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo SELLING_PRICE_WITH_VAT;?></td>
          <td><?php echo numberFormat($executed_sites->total_with_vat).' '.CURRENCY;?></td>
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

  <div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 20px;">
    <a href="<?php echo SURL.'admin/execution/billing/'.$executed_sites->id?>"><span class="label btn_6 label-warning medium"><?php echo BILLING_HISTORY_BTN;?></span></a>
    <a href="<?php echo SURL.'admin/execution/progress/'.$executed_sites->id?>"><span class="label btn_6 label-info medium"><?php echo PROGRESS_BTN;?></span></a>
    <a href="<?php echo SURL.'admin/execution/documents/'.$executed_sites->id?>"> <span class="label btn_7 label-success medium"><?php echo DOCUMENTS;?></span></a>

    <?php if($total_in_progress==0 || $progress_bar>=100){?>
    <a onclick="confirm_end_construction('<?php echo SURL.'admin/execution/end_site/'.$executed_sites->id?>')"><span class="label btn_6 label-default medium"><?php echo END_SITE_BTN;?></span></a>
   <!--  <a href="<?php echo SURL.'admin/execution/end_site/'.$executed_sites->id?>"><span class="label btn_6 label-default medium"><?php echo END_SITE_BTN;?></span></a> -->
    <?php }else{?>
    <a href="javascript:void(null)" onclick="end_site_popup()"><span class="label btn_6 label-default medium"><?php echo END_SITE_BTN;?></span></a>
    <?php }?>

    <a href="<?php echo SURL.ADMIN.'/execution'?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
  </div>            

</div>
</div>
</div>
</div>
</div>