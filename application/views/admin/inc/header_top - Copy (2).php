<!-- header-starts -->
<div class="header-section">

  <!--toggle button start-->
  <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
  <!--toggle button end-->
<?php
$user_image = ($this->session->userdata('user_image')) ? SURL.'assets/images/users/thumbnail/'.$this->session->userdata('user_image') : 'http://via.placeholder.com/50x50';
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
                <li> <a href="<?php echo SURL.'login/logout'?>"><i class="fa fa-sign-out"></i> <?php echo LOGOUT;?></a> </li>
              </ul>
            </li>
            <div class="clearfix"> </div>
          </ul>
        </div>    
        <div class="social_icons">
          <?php if($this->user=='Administrator' || $this->user=='HR Manager'){
            $notify_to = ($this->user=='Administrator') ? 0 : 1;
          ?>
          <ul class="nofitications-dropdown">
           <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue" id="show_msg_count"><?php echo count_unread_notification($notify_to);?></span></a>
                      <ul class="dropdown-menu" id="new_msg_list">
                        <!-- <li>
                          <div class="notification_header">
                            <h3>You have 3 new notification</h3>
                          </div>
                        </li>
                        <li><a href="#">
                          <div class="notification_desc">
                            <p>Lorem ipsum dolor sit amet</p>
                            <p><span>1 hour ago</span></p>
                          </div>
                          <div class="clearfix"></div>  
                        </a></li>                        
                        <li>
                          <div class="notification_bottom">
                            <a href="#"><?php echo SEE_ALL_NOTIFICATION;?></a>
                          </div> 
                        </li> -->
                        
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
