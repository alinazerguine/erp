<div id="page-wrapper">
	<div class="float-left">
		<h2><?php echo USERS;?></h2>
	</div>
	<div class="float-right">
		<div class="add-block">
			<a href="<?php echo SURL.'admin/users/add'?>" style="font-size: 16px;"><i class="fa fa-plus-circle"></i><?php echo ADD_USER_BTN;?></a>
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
					<table class="table table-striped" id="users_table" style="width: 100%;">
						<thead>
							<tr class="warning">
								<th>#</th>
								<th style="background-position: 30%;"><?php echo USER_NAME;?></th>
								<th style="background-position: 18%;"><?php echo USER_EMAIL;?></th>
								<th style="background-position: 25%;"><?php echo USER_PROFILE;?></th>
								<th><?php echo USER_IMAGE;?></th>	
								<!-- <th>ACTION</th>	 -->							
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

