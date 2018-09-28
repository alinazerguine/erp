<!-- left side start-->
<div class="left-side sticky-left-side">
	<!--logo and iconic logo start-->
	<div class="logo">
		<h1><a href="<?php echo SURL.ADMIN;?>"><?php echo $this->session->userdata('designation');?></a></h1>
	</div>
	<div class="logo-icon text-center">
		<!-- <a href="<?php echo SURL.ADMIN;?>"><i class="lnr lnr-home"></i> </a> -->
	</div>
	<!--logo and iconic logo end-->
	<div class="left-side-inner">
		<!--sidebar nav start-->
		<ul class="nav nav-pills nav-stacked custom-nav">
			<li <?php if($this->uri->segment(2)==''){ echo 'class="active"';}?>><a href="<?php echo SURL.ADMIN;?>"><i class="lnr lnr-home"></i><span><?php echo DASHBOARD;?></span></a></li>

			<li class="menu <?php if($this->uri->segment(2)=='offers'){ echo 'active';}?>"><a href="<?php echo SURL.ADMIN.'/offers';?>"><i class="fa fa-th-large"></i><span><?php echo OFFERS;?></span></a></li>

			<li class="menu <?php if($this->uri->segment(2)=='orderbook'){ echo 'active';}?>"><a href="<?php echo SURL.ADMIN.'/orderbook';?>"><i class="lnr lnr-list"></i><span><?php echo ORDER_BOOK;?></span></a></li>

			<li class="menu <?php if($this->uri->segment(2)=='execution'){ echo 'active';}?>"><a href="<?php echo SURL.ADMIN.'/execution';?>"><i class="lnr lnr-construction"></i><span><?php echo EXECUTION;?></span></a></li>  

			<li class="menu <?php if($this->uri->segment(2)=='endconstruction'){ echo 'active';}?>"><a href="<?php echo SURL.ADMIN.'/endconstruction';?>"><i class="lnr lnr-apartment"></i><span><?php echo END_CONSTRUCTION;?></span></a>
			</li> 

			<!-- <li class="menu <?php if($this->uri->segment(2)=='users'){ echo 'active';}?>"><a href="<?php echo SURL.ADMIN.'/users';?>"><i class="lnr lnr-users"></i> <span><?php echo USER_MANAGEMENT;?></span></a>
			</li>      --> 

		</ul>
		<!--sidebar nav end-->
	</div>
</div>