<!-- header-starts -->
<div class="header-section">

  <!--toggle button start-->
  <div style="float: left; width: 10%">
    <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
  </div>
  <!--toggle button end-->
  <?php
  $user_image = ($this->session->userdata('user_image')) ? SURL.'assets/images/users/thumbnail/'.$this->session->userdata('user_image') : base_url('assets/images/default_user.jpg');
  $code = '';
  if(isset($_GET['code'])) {
    $code = $_GET['code'];
  }
  
  ?>
  <!--notification menu start -->
  <div class="menu-right">
    <div class="user-panel-top">    

      <div class="profile_details">   
        <ul>
          <li class="dropdown profile_details_drop">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <div class="profile_img"> 
                <span><img src="<?php echo $user_image;?>" style="width: 92%;"> </span> 
                <div class="user-name">
                  <p><?php echo $this->session->userdata('user_name');?><span><?php echo $this->session->userdata('designation');?></span></p>
                </div>
                <i class="lnr lnr-chevron-down"></i>
                <i class="lnr lnr-chevron-up"></i>
                <div class="clearfix"></div>  
              </div>  
            </a>
            <ul class="dropdown-menu drp-mnu">
              <?php
                if($this->session->userdata('user_type')==1){
              ?>
               <li> <a href="<?php echo SURL.ADMIN.'/users';?>"><i class="lnr lnr-users"></i> <?php echo USER_MANAGEMENT;?></a> </li>
               <?php }?>
              <li> <a href="<?php echo SURL.'login/logout'?>"><i class="fa fa-sign-out"></i> <?php echo LOGOUT;?></a> </li>
            </ul>
          </li>
          <div class="clearfix"> </div>
        </ul>
      </div>   
       <div class="social_icons exact">
         <a href="<?php if($code != '') echo base_url('cron_job_page')."?code=".$code; else echo base_url('cron_job_page'); ?>" target="_blank"><img src="<?php echo SURL.'assets/images/exact.png'?>"/></a>
       </div> 
      <div class="social_icons" style="width:5%;">
        <?php if($this->user=='Administrator' || $this->user=='HR Manager'){
          $notify_to = ($this->user=='Administrator') ? 0 : 1;
          ?>
          <ul class="nofitications-dropdown">
           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue" id="show_msg_count"><?php echo count_unread_notification($notify_to);?></span></a>
            <ul class="dropdown-menu" id="new_msg_list">                       
                        
                      </ul>
                    </li>                    
                  </ul>
                  <?php }?>
                  <div class="clearfix"> </div>
                </div>              
                <div class="clearfix"></div>
              </div>
            </div>
            <!--notification menu end -->
          </div>
          <!-- //header-ends -->
