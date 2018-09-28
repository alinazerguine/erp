<!-- left side start-->
<div class="left-side sticky-left-side">
	<!--logo and iconic logo start-->
	<div class="logo">
		<h1><a href="<?php echo SURL.SITE_MANAGER;?>"><?php echo $this->session->userdata('designation');?></a></h1>
	</div>
	<div class="logo-icon text-center">
		<!-- <a href="<?php //echo SURL.SITE_MANAGER;?>"><i class="lnr lnr-home"></i> </a> -->
	</div>
	<!--logo and iconic logo end-->
	<div class="left-side-inner">
		<!--sidebar nav start-->
		<ul class="nav nav-pills nav-stacked custom-nav">		
			<li <?php if($this->uri->segment(3)==''){ echo 'class="active"';}?>><a href="<?php echo SURL.SITE_MANAGER.'/sites';?>"><i class="lnr lnr-home"></i><span><?php echo DASHBOARD;?></span></a></li>
			
			<li class="menu <?php if($this->uri->segment(3)=='my_projects'){ echo 'active';}?>"><a href="<?php echo SURL.SITE_MANAGER.'/sites/my_projects';?>"><i class="lnr lnr-construction"></i><span><?php echo MY_SITES;?></span></a></li>

			

		</ul>
		<!--sidebar nav end-->
	</div>
</div>