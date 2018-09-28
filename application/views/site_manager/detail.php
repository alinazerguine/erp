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
      <div class="col-md-2" style="margin-top: 4px;">
          <!----------- Progress bar ------------ -->
          <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress_bar;?>%;">
                  <span class="show"><?php echo numberFormat($progress_bar);?>%</span>
                </div>
              </div>                 
      </div>
      <div class="col-md-4">
        <div class="float-right" style="margin-top: 2px;">
          <div class="add-block"><?php echo MANAGER;?> : <?php echo $executed_sites->manager_name;?>&nbsp; <a href="<?php echo SURL.'site_manager/sites/import_status/'.$executed_sites->id?>"><i class="fa fa-plus-circle"></i> <?php echo ADD_INVOICE;?></a></div>       
        </div>          
      </div>
    </div>
    <!-- detail -->
     <!-- detail -->
   <div class="col-md-12 col-sm-12 detail_page" style="margin-top:5px;">         
        <div class="col-md-3" style="padding-left: 0px;">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th colspan="2"> <?php echo INFORMATION_CLIENT;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="50%"><?php echo COMPANY;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $executed_sites->company;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo CONTACT_PERSON;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $executed_sites->contact_person;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo EMAIL;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $executed_sites->email;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo MOBILE;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $executed_sites->gsm;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo PHONE;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $executed_sites->phone;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo DELIVERY_DATE;?> :</td>
                <td width="50%"> <input type="text" class="form-control" value="<?php echo date('m/d/Y',strtotime($executed_sites->delivery_date));?>"></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="col-md-6" style="border-left: 1px solid #444; border-right: 1px solid #444;">
          <table class="table table-striped" style="width: 100%;" >
            <thead>
              <tr>
                <th width="30%"><?php echo TITLE;?></th>
                <th width="20%"><?php echo QTY;?></th>
                <th width="25%"><?php echo HOURLY_RATE;?></th>
                <th width="25%"><?php echo P_TOTAL;?></th>
              </tr>
            </thead>
            <tbody>
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
                <td><?php echo numberFormat($executed_sites->total_without_vat + $executed_sites->total_vat).' '.CURRENCY;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-3" style="padding-right: 0px;">
         <table class="table" style="width: 100%;">
          <thead>
            <tr>
              <th colspan="2"><?php echo 'Upload';?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo LAST_UPLOAD;?> :</td>
              <td><input type="text" class="form-control" value="<?php echo $upload_date;?>"></td>
            </tr>
            <tr>
              <td><?php echo UPLOAD_PATH;?> :</td>
              <td><input type="text" class="form-control" value="<?php echo $upload_path;?>"></td>
            </tr>            
          </tbody>
        </table>
      </div>
    </div>


  <div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px; margin-top: 10px;">
    <a href="<?php echo SURL.'site_manager/sites/billing/'.$executed_sites->id?>"><span class="label btn_6 label-warning medium"><?php echo BILLING_HISTORY_BTN;?></span></a>
    <a href="<?php echo SURL.'site_manager/sites/progress/'.$executed_sites->id?>"><span class="label btn_6 label-info medium"><?php echo PROGRESS_BTN;?></span></a> 
    <a href="<?php echo SURL.'site_manager/sites/documents/'.$executed_sites->id?>"> <span class="label btn_7 label-success medium"><?php echo DOCUMENTS;?></span></a>
    <?php if($total_in_progress==0 || $progress_bar>=100){?>
    <a onclick="confirm_end_construction('<?php echo SURL.'admin/execution/end_site/'.$executed_sites->id?>')"><span class="label btn_6 label-default medium"><?php echo END_SITE_BTN;?></span></a>
   <!--  <a href="<?php echo SURL.'site_manager/sites/end_site/'.$executed_sites->id?>"><span class="label btn_6 label-default medium"><?php echo END_SITE_BTN;?></span></a> -->
    <?php }else{?>
    <a href="javascript:void(null)" onclick="end_site_popup()"><span class="label btn_6 label-default medium"><?php echo END_SITE_BTN;?></span></a>
    <?php }?>   
    <a href="<?php echo SURL.'/site_manager/sites/my_projects'?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
  </div>            

</div>
</div>
</div>
</div>
</div>