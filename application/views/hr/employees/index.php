<div id="page-wrapper">
	<div class="float-left" style="width: 50%;">
		<h2><?php echo EMPLOYEE_TITLE;?></h2>
	</div>
	<div class="float-right">
		<div class="add-block">
			<a href="<?php echo SURL.HR.'/employees/add'?>" style="font-size:18px;"><i class="fa fa-plus-circle"></i> <?php echo ADD_EMPLOYEE_BTN;?></a>
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
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
				<div class="table-responsive">
					<table class="table table-striped" id="employees_table" style="width: 100%;">
						<thead>
							<tr class="warning">
								<th width="10%">#</th>
								<th  width="30%"  style="background-position: 50%;"><?php echo EMP_FIRST_NAME;?></th>
								<th  width="30%" style="background-position: 50%;"><?php echo EMP_LAST_NAME;?></th>
								<th  width="30%"><?php //echo EMP_STATUS;?></th>	
								<!-- <th>ACTION</th>			 -->				
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div><!-- /.table-responsive -->

			</div>
		</div>
	</div>
</div>

