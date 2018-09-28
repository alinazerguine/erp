<div id="page-wrapper">
	     <div class="float-left" style="width: 100%;">
    <h2><?php echo EDIT_USER;?></h2>
    </div>
   
  <?php
  $user_image = ($user->image) ? SURL.'assets/images/users/thumbnail/'.$user->image : 'http://via.placeholder.com/150x150';
  ?>
	<div class="graphs" style="float: left; width: 100%;">		
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">			
			<div class="col-md-12 col-sm-12">
            <form method="post" id="user_form" action="<?php echo SURL.'admin/users/update/'.$user->id?>" enctype="multipart/form-data">
              <div class="col-md-4">
                <div class="form-group">
                <img src="<?php echo $user_image;?>" id="uploaded_image" style="width: 55%;">
                
                <input type="file" name="user_image" class="filestyle" style="width: 100%;" onchange="readURL(this);">
                <input type="hidden" name="old_image" value="<?php echo $user->image;?>">
              </div>          
              </div>

              <div class="col-md-8">              
              <div class="form-group">
                <label for="name"><?php echo USER_NAME;?>:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="User Name" value="<?php echo $user->name;?>">
              </div>
               <div class="form-group">
                <label for="email"><?php echo USER_EMAIL;?>:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user->email;?>" readonly >
              </div>
              
              <div class="form-group">
                <label for="phone"><?php echo USER_PROFILE;?>:</label>
                 <select class="form-control" id="user_type" name="user_type">
                  <option value="1" <?php if($user->user_type==1){echo "selected";}?> >Administrator</option>
                  <option value="2" <?php if($user->user_type==2){echo "selected";}?> >Site Manager</option>
                  <option value="3" <?php if($user->user_type==3){echo "selected";}?> >Human Resource Manager</option>
                </select>
              </div>          

          </div>
              <div class="col-md-12 col-sm-12" style="text-align: right; padding-right: 60px;">
              <button type="submit" class="btn-success btn"><?php echo UPDATE_USER_BTN;?></button>
             <a href="<?php echo SURL.ADMIN.'/users'?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
              </div>            
          </form>
          </div>
			</div>
		</div>
	</div>
</div>