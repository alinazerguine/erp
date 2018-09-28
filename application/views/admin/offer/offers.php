<div id="page-wrapper">
	<div class="float-left" style="width: 50%;">
		<h2><?php echo OFFER_TITLE;?></h2>
	</div>
	<div class="float-right">
		<div class="add-block">
			<a href="<?php echo SURL.'admin/offers/add'?>" style="font-size: 16px;"><i class="fa fa-plus-circle"></i> <?php echo ADD_OFFER;?></a>
		</div>
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
          <span class="show_msg"></span>
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="table-responsive">
					<table class="table table-striped" id="offers_table" style="width: 100%;">
						<thead>
							<tr class="warning">
								<th width="3%">#</th>
								<th width="10%"><?php echo REFERENCE;?></th>
								<th width="10%"><?php echo DESCRIPTION;?></th>
								<th width="10%"><?php echo CUSTOMER;?></th>
								<th width="12%"><?php //echo MARKET;?></th>
								<th width="10%"><?php //echo CLIENT;?></th>
								<th width="10%"><?php //echo OFFER;?></th>
								<th width="5%"><?php echo DATE;?></th>
								<th width="10%"><?php echo PRICE;?></th>
								<th width="10%"><?php //echo STATUS;?></th>
								<th width="10%"><?php echo COMMENT;?></th>
								
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4"> <button type="button" class="btn-danger btn" onclick="delete_checked_offers();"><i class="fa fa-trash-o"></i> <?php echo DELETE_BTN;?></button></td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
							</tr>
						</tfoot>
					</table>
				</div><!-- /.table-responsive -->

			</div>
		</div>
	</div>
</div>

