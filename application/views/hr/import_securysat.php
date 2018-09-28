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
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="col-md-12 col-sm-12" style="background-color: #444;padding: 5px;color: #FFF;font-size: 14px;"> <div class="col-md-7 medium" style="margin-top: 10px;"><?php echo IMPORT_SECURYSAT;?> | <?php echo date("d/m/Y");?></div>				
				
			</div>			
			<div class="col-md-12 col-sm-12" style="margin-top: 10px;">
				<div class="table-responsive">
					<div class="col-md-2 col-sm-2">
					</div>
					<div class="col-md-8 col-sm-8">
					 <form method="post" id="import_securt" action="<?php echo SURL.HR.'/importdata/securysat'?>" enctype="multipart/form-data">
					<table class="table">
						<tr>
							<td>
								  <div class="form-group">
					            <!-- <label for="address" style="font-size: 16px; margin-left: 12%;"><?php echo SELECT_SECURYSAT;?> :</label> -->
					            <input type="file" class="filestyle" data-buttonTex="Find file" id="securysat" name="securysat" onchange="this.form.submit()" >
					          </div>
							</td>								
						</tr>
					</table>
				</form>
			</div>
			<div class="col-md-2 col-sm-2">
					</div>
				</div><!-- /.table-responsive -->
			</div>
			
			
		</div>
	</div>
</div>
</div>

