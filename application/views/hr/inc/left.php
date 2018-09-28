<!-- left side start-->
<div class="left-side sticky-left-side">
	<!--logo and iconic logo start-->
	<div class="logo">
		<h1><a href="<?php echo SURL.HR;?>"><?php echo $this->session->userdata('designation');?></a></h1>
	</div>
	<div class="logo-icon text-center">
		<!-- <a href="<?php echo SURL.HR;?>"><i class="lnr lnr-home"></i> </a> -->
	</div>
	<!--logo and iconic logo end-->
	<div class="left-side-inner">
		<!--sidebar nav start-->
		<ul class="nav nav-pills nav-stacked custom-nav">
			<li <?php if($this->uri->segment(2)==''){ echo 'class="active"';}?>><a href="<?php echo SURL.HR;?>"><i class="lnr lnr-home"></i><span><?php echo DASHBOARD;?></span></a></li>

			<li class="menu-list <?php if($this->uri->segment(2)=='working_hours' && $this->uri->segment(3)!='schedule'){ echo 'active';}?>"><a href="#"><i class="lnr lnr-clock"></i><span><?php echo WORKING_HOURS;?></span></a>  
							<ul class="sub-menu-list">
								<li><a href="<?php echo SURL.HR.'/working_hours/sites'?>"><?php echo HOURS_BY_SITES;?></a> </li>
								<li><a href="<?php echo SURL.HR.'/working_hours/employees'?>"><?php echo HOURS_BY_EMPLOYEE;?></a> </li>
							</ul>
			</li>

			<li class="menu <?php if($this->uri->segment(3)=='schedule'){ echo 'active';}?>"><a href="<?php echo SURL.HR.'/working_hours/schedule'?>"><i class="lnr lnr-calendar-full"></i><span><?php echo SCHEDULE;?></span></a></li>


			<li class="menu <?php if($this->uri->segment(2)=='employees'){ echo 'active';}?>"><a href="<?php echo SURL.HR.'/employees'?>"><i class="lnr lnr-users"></i><span><?php echo EMPLOYEES;?></span></a></li>

			<li class="menu <?php if($this->uri->segment(2)=='caution'){ echo 'active';}?>"><a href="<?php echo SURL.HR.'/caution/sites'?>"><i class="lnr lnr-construction"></i><span><?php echo CUATION_SITE;?></span></a></li>

			
		</ul>
		<!--sidebar nav end-->
	</div>
</div>