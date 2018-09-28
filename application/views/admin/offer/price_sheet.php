<div id="page-wrapper">
	<div class="graphs" style="float: left; width: 100%;">	  
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
        <div class="col-md-12 col-sm-12 upper_bar"> <div class="col-md-12 medium"><span style="float: left;margin-top: 6px;"><?php echo PRICE_SHEET_BTN;?></span> 
          <div class="float-right">
            <div class="add-block"><button type="button" class="btn-success btn" onclick="print_price_sheet('print_price')"><i class="fa fa-print" aria-hidden="true"></i> Imprimer</button></div>       
          </div>   </div>       

        </div>

        <div class="col-md-12 col-sm-12" style="padding-top: 20px;padding-left:  0px;padding-right: 0px;"> 
          <div class="table-responsive" id="print_price">          
            <table class="table table-striped1" border="1" style="width:90%; margin-left: 5%;" id="price_sheet_table">
              <tr>
                <td width="30%" rowspan="6" style="text-align: center;"><img src="<?php echo SURL.'assets/images/logo.jpg'?>" style="width:100%;"><br>
                  <hr style="margin-top: 5px; margin-bottom: 5px;">
                  <span style="font-size: 13px;">SOCIÉTÉ D'ÉLECTRICITÉ GÉNÉRALE<br>
                    <a href="#">www.wm-electricite.be</a></span><hr style="margin-top: 5px;"></td>
                    <td class="coloured" width="70%" colspan="4" style="text-align: center; font-size: 14px;">Feuille de route</td>
                  </tr>                       
                  <!-- numberFormat($value->sale_price) -->
               <!--  <tr>
                  <td colspan="4"></td>
                </tr> -->
                <tr>
                  <td width="30%" class="coloured">N° dossier</td>
                  <td colspan="3"><?php echo $offer_detail->reference_no;?></td>
                </tr>
                <tr>
                  <td width="30%" class="coloured">Nom du projet </td>
                  <td colspan="3"><?php echo $offer_detail->description;?></td>
                </tr>
                <tr>
                  <td width="30%" class="coloured">Concerne</td>
                  <td colspan="3"><?php //echo $offer_detail->company;?></td>
                </tr> 
                <!-- <tr>
                  <td colspan="4"></td>
                </tr>  -->                    
                <tr>
                  <td width="30%" class="coloured">Demandeur: <?php echo $offer_detail->company;?></td>
                  <td width="20%" <?php if($offer_detail->client=='Entreprise générale'){ ?> class="orange" <?php }?>>EG</td>
                  <td width="20%" <?php if($offer_detail->client=='Pouvoir public'){ ?> class="orange" <?php }?>>Public</td>
                  <td width="20%" <?php if($offer_detail->client=='Privé - Entreprise' || $offer_detail->client=='Privé - Particulier'){ ?> class="orange" <?php }?>>Privé</td>
                </tr>
               <!--  <tr>
                  <td colspan="4"></td>
                </tr>  -->
                <tr>
                  <td width="30%" class="coloured">Type de demande</td>
                  <td width="20%" <?php if($offer_detail->offer=='Affaire ferme'){ ?> class="orange" <?php }?>>Affaire ferme</td>
                  <td colspan="2" <?php if($offer_detail->offer=='Soumission'){ ?> class="orange" <?php }?>>Soumission</td>
                </tr>                    
                <tr>
                  <td colspan="5" class="coloured"></td>
                </tr>
                <tr>
                  <td style="text-align: center;">Date de création</td>
                  <td colspan="4" style="text-align: center;"><?php echo date("d/m/Y",strtotime($offer_detail->created_at))?></td>
                </tr>
                <tr>
                  <td style="text-align: center;">Date de remise d'offre</td>
                  <td colspan="4" style="text-align: center;"><?php echo date("d/m/Y",strtotime($offer_detail->delivery_date))?></td>
                </tr>
                <tr>
                  <td style="text-align: center;">Date proposée</td>
                  <td colspan="4" style="text-align: center;">........../........../..........</td>
                </tr>
                <tr>
                  <td colspan="5" style="height:30px;"></td>
                </tr>
              </table>

              <table class="table table-striped" border="1" style="width:90%; margin-left: 5%;">
                <tr>
                  <td colspan="5" style="text-align: center; font-weight: bold;">Demande de prix</td>
                </tr>
                <tr>
                  <td class="coloured" width="15%" style="text-align: center;">Technique</td>
                  <td class="coloured" width="25%" style="text-align: center;">Date de la demande</td>
                  <td class="coloured" width="25%" style="text-align: center;">Date de réception</td>
                  <td class="coloured" width="10%" style="text-align: center;">Qui</td>
                  <td class="coloured" width="25%" style="text-align: center;">Remarques</td>
                </tr>
                <?php for($i=1; $i<=25; $i++){?>
                <tr>
                  <td style="height: 20px;"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php }?>
                <tr>
                  <td colspan="5"><textarea style="height:50px; width: 100%;" placeholder="Remarques générales..."></textarea></td>         
                </tr>             
              </table>   
            </div>             
          </div>
        </div>
      </div>
    </div>
  </div>
