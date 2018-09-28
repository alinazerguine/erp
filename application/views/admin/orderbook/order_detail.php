<div id="page-wrapper">
  <div class="graphs" style="float: left; width: 100%;">    
    <div class="xs tabls">      
      <div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
        <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">      <div class="col-md-6 medium" style="margin-top: 5px;"><?php echo 'Commande';?> #<?php echo $order_detail->reference_no;?> | <?php echo $order_detail->description;?></div>
        <div class="col-md-3" style="margin-top: 4px;">
         <div class="progress">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
          <span class="show"><?php echo numberFormat(0);?>%</span>
        </div>
      </div>                    
        </div>
        <div class="col-md-3">
          <div class="float-right" style="margin-top: 10px; margin-right: 10px;">
            <div class="add-block"><?php echo MANAGER;?> : <?php echo $order_detail->site_manager;?></div>       
          </div>          
        </div>
      </div>

      <div class="col-md-12 col-sm-12 detail_page" style="margin-top:5px;">         
        <div class="col-md-5" style="padding-left: 0px;">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th colspan="2"> <?php echo INFORMATION_CLIENT;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="50%"><?php echo COMPANY;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $order_detail->company;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo CONTACT_PERSON;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $order_detail->contact_person;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo EMAIL;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $order_detail->email;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo MOBILE;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $order_detail->gsm;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo PHONE;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $order_detail->phone;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo DELIVERY_DATE;?> :</td>
                <td width="50%"> <input type="text" class="form-control" value="<?php echo date('m/d/Y',strtotime($order_detail->delivery_date));?>"></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="col-md-7" style="border-left: 1px solid #444;">
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
                <td width="25%"><?php echo numberFormat($order_detail->purchase).' '.CURRENCY;?></td>
              </tr>
              <!-- numberFormat($value->sale_price) -->
              <tr>
                <td width="30%"><?php echo PRESTATION;?></td>
                <td width="20%"><?php echo convertTime($order_detail->working_hours);?></td>
                <td width="25%"><?php echo $order_detail->hourly_rate.' '.CURRENCY;?></td>
                <td width="25%"><?php echo numberFormat($order_detail->working_hours*$order_detail->hourly_rate).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td width="30%"><?php echo SUBCONTRACTORS;?></td>
                <td width="20%"></td>
                <td width="25%"></td>
                <td width="25%"><?php echo numberFormat($order_detail->subcontractors).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="4" style="height: 100px;"></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo PRICE_OF_RETURN;?></td>
                <td><?php echo numberFormat($order_detail->cost_price).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo MARGIN;?></td>
                <td><?php echo numberFormat($order_detail->margin).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo GENERAL_FEES;?></td>
                <td><?php echo numberFormat($order_detail->general_fee).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo SELLING_PRICE_WITHOUT_VAT;?></td>
                <td><?php echo numberFormat($order_detail->total_without_vat).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo VAT_TEXT;?> <!-- <?php echo $order_detail->tva_rate;?>% --></td>
                <td><?php echo numberFormat($order_detail->total_vat).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo SELLING_PRICE_WITH_VAT;?></td>
                <td><?php echo numberFormat($order_detail->total_without_vat + $order_detail->total_vat).' '.CURRENCY;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        
    </div>
  
  <div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px; margin-top: 20px;">
    <a href="<?php echo SURL.'admin/orderbook/documents/'.$order_detail->id?>"> <span class="label btn_7 label-success medium"><?php echo DOCUMENTS;?></span></a>
    <a href="<?php echo SURL.ADMIN.'/orderbook'?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
  </div>            

</div>
</div>
</div>
</div>
</div>