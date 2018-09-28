<div id="page-wrapper">
  <div class="float-left" style="width: 50%;">
    <h2><?php echo DOCUMENTS;?></h2>
  </div>
  <?php
  //print_r($documents);exit;
  ?>
  <div class="graphs" style="float: left; width: 100%;">    
    <div class="xs tabls">      
      <div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
        <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">         
          <div class="col-md-12 medium"><?php echo 'Commande';?> #<?php echo $offer->reference_no;?> | <?php echo $offer->description;?></div>

        </div>
        <div class="col-md-12 col-sm-12" style="margin-top: 20px;">
          <div class="table-responsive">
         <table class="table table-striped" id="exec_document_table">
              <thead>
                <tr class="warning">
                  <th width="30%"><?php echo 'Fournisseur';?></th>
                 <th width="30%"><?php echo DOCUMENTS;?></th>
                 <th width="20%"><?php echo 'Date';?></th>
                  <th width="20%">Prix</th>
                </tr>
              </thead>
              <tbody>
                <?php /*if($documents){
                  foreach($documents as $key=>$data){?>              
                <tr>
                   <td width="30%"><?php echo $data->supplier_name;?></td>
                   <?php ?>
                  <td width="50%"><a href="<?php echo $data->document_url;?>" target="_blank"><?php echo $data->document_url;?></a></td>
                   <td width="20%"><?php echo date("d/m/Y",strtotime($data->created));?></td>           
                </tr>    
                <?php }
              }else{
                ?>
                  <tr>
                   <td width="5%"></td>
                  <td><p>Aucune donnée disponible</p></td>             
                </tr>
                <?php
              }*/
              ?>
              
        </tbody>
        
      </table>
    </div><!-- /.table-responsive -->
  </div>
<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">  
  <a href="<?php echo SURL.'admin/orderbook/detail/'.$offer_id?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
</div> 
</div>
</div>
</div>
</div>

