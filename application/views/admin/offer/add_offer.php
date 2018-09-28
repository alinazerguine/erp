<div id="page-wrapper">
  <div class="float-left" style="width: 100%;">
    <h2><?php echo ADD_OFFER;?></h2>
  </div>
  
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
   <div class="bs-example4" data-example-id="simple-responsive-table">
     <div class="col-md-12 col-sm-12" style="text-align: center; padding-bottom: 16px;">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <form method="post" action="<?php echo SURL.'admin/offers/add'?>" enctype="multipart/form-data">
         <label class="label btn_6 label-success large" id="import_offer" style="width: 100%; cursor: pointer;"><?php echo IMPORT_DATA;?>
          <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="import_data" style="display: none;" onchange="this.form.submit()">
        </label>
      </form>   
    </div>
    <div class="col-md-4"></div>    
  </div> 
  <div class="col-md-12 col-sm-12">
    <form id="offer_form" method="post" action="<?php echo SURL.'admin/offers/save'?>" enctype="multipart/form-data">
      <input type="hidden" name="general_fee" value="<?php echo $general_fee;?>">
      <input type="hidden" name="hourly_rate" value="<?php echo $hourly_rate;?>">
      <input type="hidden" name="working_hours" value="<?php echo $working_hours;?>">
      <input type="hidden" name="purchase" value="<?php echo $purchase;?>">
      <input type="hidden" name="subcontractors" value="<?php echo $subcontractors;?>">
      <input type="hidden" name="margin" value="<?php echo $margin;?>">
      <input type="hidden" name="cost_price" value="<?php echo $cost_price;?>">
      <div class="col-md-6">
       <div class="form-group">
        <label for="refference"><?php echo REFERENCE;?> :</label>
        <input type="text" class="form-control" id="refference" name="refference" required="required" placeholder="ex : 17-1000" value="<?php echo $reference;?>">
      </div>
      <div class="form-group">
        <label for="description"><?php echo DESCRIPTION;?> :</label>
        <input type="text" class="form-control" id="description" name="description" required="required" placeholder="ex : chantier x" value="<?php echo $description;?>" >
      </div>

      <div class="form-group">
        <label for="market"><?php echo MARKET;?> :</label>
        <select class="form-control" id="market" name="market" required="required">
          <option value="">Sélectionnez</option>
          <?php foreach(get_market_dropdown() as $data){?>
          <option value="<?php echo $data['value']?>"><?php echo $data['label']?></option>
          <?php }?>
        </select>
      </div> 

      <div class="form-group">
        <label for="client"><?php echo CLIENT;?> :</label>
        <select class="form-control" id="client" name="client" required="required" onchange="show_offer(this.value)">
          <option value="">Sélectionnez</option>
          <?php foreach(get_client_dropdown() as $data){?>
          <option value="<?php echo $data['value']?>"><?php echo $data['label']?></option>
          <?php }?>
        </select>
      </div>
      <div class="form-group">
        <label for="offer"><?php echo OFFER;?> :</label>
        <select class="form-control" id="offer" name="offer">
          <option value="">Sélectionnez</option>
          <?php /*foreach(get_offer_dropdown() as $data){?>
          <option value="<?php echo $data['value']?>"><?php echo $data['label']?></option>
          <?php }*/ ?>
        </select>
      </div>
      <div class="form-group">
        <label for="price"><?php echo PRICE;?>(<?php echo CURRENCY;?>) :</label>
        <input type="text" class="form-control" id="sale_price" name="sale_price" required="required" placeholder="ex : 1.000,00" value="<?php echo $sale_price;?>">
      </div>

      <div class="form-group">
        <label for="price">Taux TVA (%):</label>
        <input type="text" class="form-control" id="tva_rate" name="tva_rate" required="required" placeholder="ex: 21" value="<?php echo $tva_rate;?>">
      </div>

      <div class="form-group">
        <label for="site_manager"><?php echo MANAGER;?> :</label>
        <select class="form-control" id="site_manager" name="site_manager">
          <option value="">Sélectionnez</option>
          <?php if($site_managers){
            foreach($site_managers as $manager){?>                	
            <option value="<?php echo $manager->id;?>"><?php echo $manager->name;?></option>
            <?php
          }
        }
        ?>
      </select>
    </div>


    <div class="form-group">
      <label for="status"><?php echo STATUS;?> :</label>
      <select class="form-control" id="status" name="status">
        <?php foreach(get_status_dropdown() as $data){?>
        <option value="<?php echo $data['value']?>"><?php echo $data['label']?></option>
        <?php }?>
      </select>
    </div>
  </div>

  <div class="col-md-6">              
    <div class="form-group">
      <label for="company"><?php echo COMPANY;?> :</label>
      <input type="text" class="form-control" id="company" name="company" placeholder="ex : WM Electricité" value="<?php echo $company;?>">
    </div>
    <div class="form-group">
      <label for="contact_person"><?php echo CONTACT_PERSON;?> :</label>
      <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="ex : Philippe Dubois">
    </div>
    <div class="form-group">
      <label for="email"><?php echo EMAIL;?> :</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="ex : info@wm-electricite.be">
    </div>
    <div class="form-group">
      <label for="gsm"><?php echo GSM;?> :</label>
      <input type="text" class="form-control" id="gsm" name="gsm" placeholder="ex : 0471 28 30 21">
    </div>
    <div class="form-group">
      <label for="phone"><?php echo PHONE;?> :</label>
      <input type="number" min="0" class="form-control" id="phone" name="phone" placeholder="ex : 02 812 32 03">
    </div>
    <div class="form-group">
      <label for="delivery_date"><?php echo DELIVERY_DATE;?> :</label>
      <input type="datetime-local" class="form-control" id="delivery_date" name="delivery_date" placeholder="Delivery Date">
    </div>
    <div class="form-group">
      <label for="delivery_place"><?php echo DELIVERY_PLACE;?> :</label>
      <input type="text" class="form-control" id="delivery_place" name="delivery_place" placeholder="ex : Rue de la Gruerie, 10 – 1300 Wavre">
    </div>
    <div class="form-group">
      <label for="technical_meeting"><?php echo TECHNICAL_VISIT;?> :</label>
      <select class="form-control" id="technical_meeting" name="technical_meeting" onchange="show_visit(this.value);">
       <option value="0"><?php echo NO;?></option>
       <option value="1"><?php echo YES;?></option>
     </select>
   </div>
 </div>
 <div class="col-md-12 col-sm-12" style="text-align: right; padding-right: 60px;">
  <button type="submit" class="btn-success btn"><?php echo ADD_OFFER;?></button>
  <a href="<?php echo SURL.ADMIN.'/offers'?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
  <input type="hidden" name="visit_date" value="">
  <input type="hidden" name="visit_address" value="">
  <input type="hidden" name="visit_contact_person" value="">
  <input type="hidden" name="visit_gsm" value="">
  <input type="hidden" name="visit_phone" value="">
</div>            
</form>
</div>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div id="visitModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo TECHNICAL_VISIT;?></h4>
      </div>
      <div class="modal-body">
        <form method="post" action="#" id="technical_visit_form">
          <div class="col-md-12 col-sm-12">
            <div class="col-md-6" style="padding: 0px;">              
              <div class="form-group">
                <label for="visit_date" style="width: 20%;"><?php echo DATE;?> :</label>
                <input type="datetime-local" class="form-control" id="visit_date" name="visit_date" placeholder="Date" style="width: 80%;">
              </div>
              <div class="form-group">
                <label for="visit_address" style="width: 20%;"><?php echo ADDRESS;?> :</label>
                <textarea class="form-control" id="visit_address" name="visit_address" style="width: 80%; height: 88px;" placeholder="ex : Rue de la Gruerie, 10 – 1300 Wavre" ></textarea>
              </div>
               <!-- <div class="form-group">
                <label for="visit_address2"></label>
                <input type="email" class="form-control" id="visit_address2" name="visit_address2" placeholder="Address">
              </div> -->
            </div>
            <div class="col-md-6">              
              <div class="form-group">
                <label for="visit_contact_person"><?php echo CONTACT_PERSON;?> :</label>
                <input type="email" class="form-control" id="visit_contact_person" name="visit_contact_person" placeholder="ex : Philippe Dubois">
              </div>
              <div class="form-group">
                <label for="vist_gsm"><?php echo GSM;?> :</label>
                <input type="number" min="0" class="form-control" id="visit_gsm" name="visit_gsm" placeholder="ex : 0471 28 30 21">
              </div>
              <div class="form-group">
                <label for="visit_phone"><?php echo PHONE;?> :</label>
                <input type="number" min="0" class="form-control" id="visit_phone" name="visit_phone" placeholder="ex : 02 812 32 03">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="add_technical_visit"><?php echo ADD_BTN;?></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cancel_tech_visit()"><?php echo CANCEL_BTN;?></button>
      </div>
    </div>

  </div>
</div>