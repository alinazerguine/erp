<div id="page-wrapper">
	<div class="graphs" style="float: left; width: 100%;">	  
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; background: none;">
        <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">       <div class="col-md-6 medium"><?php echo OFFER;?> #<?php echo $offer_detail->reference_no;?> | <?php echo $offer_detail->description;?></div>

        <div class="col-md-6">

          <div class="float-right" style="margin-top: 4px; margin-right: 10px;">
            <div class="add-block"><?php echo MANAGER;?> : <?php echo $offer_detail->site_manager;?></div>       
          </div>          
        </div>
      </div>
      <div class="col-md-12 col-sm-12 detail_page" style="margin-top:5px;">         
        <div class="col-md-3" style="padding: 5px;background: #FFF;">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th colspan="2"> <?php echo INFORMATION_CLIENT;?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="50%"><?php echo COMPANY;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $offer_detail->company;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo CONTACT_PERSON;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $offer_detail->contact_person;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo EMAIL;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $offer_detail->email;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo MOBILE;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $offer_detail->gsm;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo PHONE;?> :</td>
                <td width="50%"><input type="text" class="form-control" value="<?php echo $offer_detail->phone;?>"></td>
              </tr>
              <tr>
                <td width="50%"><?php echo DELIVERY_DATE;?> :</td>
                <td width="50%"> <input type="text" class="form-control" value="<?php echo date('m/d/Y',strtotime($offer_detail->delivery_date));?>"></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="col-md-6" style="background: #FFF;width: 48%;margin-left: 1%;margin-right: 1%;padding: 5px;">
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
                <td width="25%"><?php echo numberFormat($offer_detail->purchase).' '.CURRENCY;?></td>
              </tr>
              <!-- numberFormat($value->sale_price) -->
              <tr>
                <td width="30%"><?php echo PRESTATION;?></td>
                <td width="20%"><?php echo convertTime($offer_detail->working_hours);?></td>
                <td width="25%"><?php echo $offer_detail->hourly_rate.' '.CURRENCY;?></td>
                <td width="25%"><?php echo numberFormat($offer_detail->working_hours*$offer_detail->hourly_rate).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td width="30%"><?php echo SUBCONTRACTORS;?></td>
                <td width="20%"></td>
                <td width="25%"></td>
                <td width="25%"><?php echo numberFormat($offer_detail->subcontractors).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="4" style="height: 100px;"></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo PRICE_OF_RETURN;?></td>
                <td><?php echo numberFormat($offer_detail->cost_price).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo MARGIN;?></td>
                <td><?php echo numberFormat($offer_detail->margin).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo GENERAL_FEES;?></td>
                <td><?php echo numberFormat($offer_detail->general_fee).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo SELLING_PRICE_WITHOUT_VAT;?></td>
                <td><?php echo numberFormat($offer_detail->total_without_vat).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo VAT_TEXT;?> <!-- <?php echo $offer_detail->tva_rate;?>% --></td>
                <td><?php echo numberFormat($offer_detail->total_vat).' '.CURRENCY;?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo SELLING_PRICE_WITH_VAT;?></td>
                <td><?php echo numberFormat($offer_detail->total_without_vat + $offer_detail->total_vat).' '.CURRENCY;?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-3" style="padding: 5px;background: #FFF;">
         <table class="table" style="width: 100%;">
          <thead>
            <tr>
              <th colspan="2"><?php echo TECHNICAL_VISIT;?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo DATE;?> :</td>
              <td><input type="text" class="form-control" value="<?php echo date("m/d/Y",strtotime($offer_detail->visit_date));?>"></td>
            </tr>
            <tr>
              <td><?php echo ADDRESS;?> :</td>
              <td><textarea class="form-control" style="height: 75px;"><?php echo $offer_detail->visit_address;?></textarea></td>
            </tr>
            <tr>
              <td><?php echo CONTACT_PERSON;?> :</td>
              <td><input type="text" class="form-control" value="<?php echo $offer_detail->visit_contact_person;?>"></td>
            </tr>
            <tr>
              <td><?php echo GSM;?> :</td>
              <td><input type="text" class="form-control" value="<?php echo $offer_detail->visit_gsm;?>"></td>
            </tr>
            <tr>
              <td><?php echo PHONE;?> :</td>
              <td><input type="text" class="form-control" value="<?php echo $offer_detail->visit_phone;?>"></td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px;">
      <div class="col-md-6 col-md-offset-3">
       <div class="form-group">
        <label for="status" style="margin-top: 8px;width: 15%; margin-left: 10%;"><?php echo STATUS;?> :</label>
        <select class="form-control" id="status" name="status" onchange="update_offer_status(this.value,<?php echo $offer_detail->id ?>);">
          <?php foreach(get_status_dropdown() as $data){?>
          <option value="<?php echo $data['value']?>" <?php if($data['value']==$offer_detail->status){ echo "selected";}?>><?php echo $data['label']?></option>
          <?php }?>
        </select>
      </div>                    
    </div> 
  </div>
  <div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px;">
    <span class="show_msg"></span>  
  </div>  
  <div class="col-md-12 col-sm-12" style="text-align: center; padding-top: 10px;">
    <a href="<?php echo SURL.ADMIN.'/offers'?>"><span class="label btn_7 label-danger medium"><?php echo BACK_BTN;?></span></a>
    <a href="<?php echo SURL.'admin/offers/modify/'.$offer_detail->id?>"><span class="label btn_7 label-warning medium"><?php echo MODIFY_BTN;?></span></a>
    <a href="<?php echo SURL.'admin/offers/price_sheet/'.$offer_detail->id?>"><span class="label btn_7 label-success medium"><?php echo PRICE_SHEET_BTN;?></span></a>
  </div>            

</div>
</div>
</div>
</div>
</div>