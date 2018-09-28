<div id="page-wrapper">
  <div class="float-left" style="width: 50%;">
    <h2><?php echo PROGRESS;?></h2>
  </div>
  
  <div class="graphs" style="float: left; width: 100%;">    
    <div class="xs tabls">      
      <div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
        <div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;">         
          <div class="col-md-12 medium"><?php echo 'Chantier';?> #<?php echo $offer->reference_no;?> | <?php echo $offer->description;?></div>

        </div>
        <div class="col-md-12 col-sm-12" style="margin-top: 5px;">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr class="warning">
                  <th style="background-color: #333;" width="20%"></th>
                  <th width="20%"><?php echo OFFER;?></th>
                  <th width="20%"><?php echo REAL_TEXT;?></th>
                  <th width="20%"><?php echo RESULT;?></th>
                </tr>
              </thead>
              <tbody>
                 <tr>
                   <td style="background-color: #333;">&nbsp;</td>
                  <td colspan="3"></td>                                 
                </tr>
                <?php
                /*echo "<pre>";
                print_r ($progress);
                echo "</pre>";*/
                  if($progress){
                    $purchase = $progress->purchase;
                    $resultant1 =  $progress->purchase - $real_purchase;
                    $total_hours = $progress->total_hours;
                    $hours = $progress->hours;
                    $real_hours = $working_hour_site * $progress->hourly_rate;
                    $resultant2 = $progress->total_hours - ($working_hour_site * $progress->hourly_rate);
                    $general_fee = $progress->general_fee;
                    $cost_price = $real_purchase + ($working_hour_site * $progress->hourly_rate) + $progress->general_fee;
                    $profit_margin = $progress->selling_price - ($progress->purchase + $progress->total_hours + $progress->general_fee);
                    $actual_margin = $progress->selling_price - $cost_price;
                    $selling_price = $progress->selling_price;

                   $loss = $working_hour_site - $hours;
                   $total_loss = ($loss>0) ? $loss * $progress->hourly_rate : 0;

                  }else{
                    $purchase = 0;
                    $resultant1 =  0-$real_purchase;
                    $total_hours = 0;
                    $hours = 0;
                    $real_hours = $working_hour_site * $offer->hourly_rate;
                    $resultant2 = 0 - $real_hours;
                    $general_fee = 0;
                    $cost_price = 0;
                    $profit_margin = 0;
                    $actual_margin = 0;
                    $selling_price = 0;
                    $total_loss = 0;
                  }
                ?>
                <tr>
                  <td style="background-color: #333; color: #FFF;"><?php echo PURCHASE;?></td>
                  <td><?php echo numberFormat($purchase).CURRENCY;?></td>
                  <td><?php echo numberFormat($real_purchase).CURRENCY;?></td><!-- this will come from exactonline -->
                  <td> <?php echo numberFormat($resultant1).CURRENCY;?></td>               
                </tr>
              <tr>
                  <td style="background-color: #333;color: #FFF;"><?php echo HOURS;?></td>
                  <td><?php echo numberFormat($total_hours).CURRENCY;?> (<span style="color: grey;"><?php echo convertTime($hours);?></span>)</td>
                  <td><?php echo numberFormat($real_hours).CURRENCY;?> (<span style="color: grey;"><?php echo convertTime($working_hour_site);?></span>)</td>  <!-- from securysat -->  
                  <td><?php echo numberFormat($resultant2).CURRENCY;?></td>                  
                </tr>
            <tr>
                  <td style="background-color: #333;color: #FFF;"><?php echo OVERHEAD;?></td>
                  <td><?php echo numberFormat($general_fee).CURRENCY;?></td>
                  <td><?php echo numberFormat($general_fee).CURRENCY;?></td>
                  <td></td>                  
                </tr>
               <tr>
                  <td style="background-color: #333;color: #FFF;"><?php echo COST_PRICE;?></td>
                  <td></td>
                  <td><?php echo numberFormat($cost_price).CURRENCY;?></td>
                  <td></td>                  
                </tr>
                <tr>
                  <td style="background-color: #333;color: #FFF;"><?php echo PROFIT_MARGIN;?></td>
                  <td><?php echo numberFormat($profit_margin).CURRENCY;?></td>
                  <td></td>
                  <td><?php echo ACTUAL_MARGIN;?> : <?php echo numberFormat($actual_margin).CURRENCY;?></td>                  
                </tr>
                <tr>
                  <td style="background-color: #333;color: #FFF;"><?php echo SELLING_PRICE;?></td>
                  <td><?php echo numberFormat($selling_price).CURRENCY;?></td>
                  <td></td>
                  <td></td>                  
                </tr>
        </tbody>
        <tfoot>
          <?php
            $total_work_progress = $resultant1 + $resultant2;
          ?>
          <tr>
            <th></th>
            <th></th>
            <th><span class="label btn_6 label-success medium"><?php echo TOTAL_WORK_PROGRESS;?> : <?php echo ($total_work_progress >0 ) ? '0'.CURRENCY : numberFormat($resultant1 + $resultant2).CURRENCY;?></span>
            </th>
            <th> <span class="label btn_6 label-warning medium"><?php echo TOTAL_LOSS;?> : <?php echo numberFormat($total_loss).CURRENCY;?></span></th>
          </tr>
        </tfoot>
      </table>
    </div><!-- /.table-responsive -->
  </div>
<div class="col-md-12 col-sm-12" style="text-align: right; padding-top: 10px;">  
  <a href="<?php echo SURL.'admin/endconstruction/detail/'.$offer_id?>"><span class="label btn_6 label-danger medium"><?php echo BACK_BTN;?></span></a>
</div> 
</div>
</div>
</div>
</div>

