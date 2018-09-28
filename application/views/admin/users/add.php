<div id="page-wrapper">
  <div class="float-left" style="width: 100%;">
    <h2><?php echo ADD_USER;?></h2>
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
     <div class="col-md-12 col-sm-12">
      <form method="post" id="user_form" action="<?php echo SURL.'admin/users/add'?>" enctype="multipart/form-data">
       <div class="col-md-4">
         <div class="form-group">
          <img src="http://via.placeholder.com/150x150" id="uploaded_image" style="width: 55%;">

          <input type="file" name="user_image" class="filestyle" data-buttonTex="Find file" onchange="readURL(this);">

        </div>          
      </div>

      <div class="col-md-8">              
        <div class="form-group">
          <label for="name"><?php echo USER_NAME;?>:</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
        </div>
        <div class="form-group">
          <label for="email"><?php echo USER_EMAIL;?>:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="password"><?php echo USER_PASSWORD;?>:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="phone"><?php echo USER_PROFILE;?>:</label>
          <select class="form-control" id="user_type" name="user_type">
            <option value="1">Administrator</option>
            <option value="2">Site Manager</option>
            <option value="3">Human Resource Manager</option>
          </select>
        </div>          

      </div>
      <div class="col-md-12 col-sm-12" style="text-align: right; padding-right:40px;">
        <button type="submit" class="btn-success btn"><?php echo ADD_USER_BTN;?></button>
        <a href="<?php echo SURL.ADMIN.'/users'?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
      </div>            
    </form>
  </div>
</div>
</div>
</div>
</div>