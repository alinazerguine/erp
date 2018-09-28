<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Electrolite | Login</title>
<link rel="icon" href="<?php echo base_url('assets/images/logo.jpg');?>" type="image/jpg" sizes="16x16">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="<?php echo SURL;?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo SURL;?>assets/css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="<?php echo SURL;?>assets/css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="<?php echo SURL;?>assets/css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="<?php echo SURL;?>assets/js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="<?php echo SURL;?>assets/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="<?php echo SURL;?>assets/js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="<?php echo SURL;?>assets/js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<!-- <p><span>Sign In to</span> <a href="<?php echo base_url();?>">DigiSeed</a></p> -->
							<img src="<?php echo base_url('assets/images/logo.jpg');?>" alt="Electrolite logo" style="width: 100%; height: 180px;"  />
						</div>						
						<div class="signin">
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
							<form method="post" action="<?php echo SURL.'login/forgot_password'?>">
								
							<div class="log-input">
								<div class="log-input-left">
								   <input type="email" class="user" name="reg_email" placeholder="Registered Email" />
								</div>
								
								<div class="clearfix"> </div>
							</div>
							
							<input type="submit" value="Request Password">
						</form>	 
						
						</div>

					</div>
				</div>
			</div>
		
	</section>
	
<script src="<?php echo SURL;?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo SURL;?>assets/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo SURL;?>assets/js/bootstrap.min.js"></script>

   <script type="text/javascript">
 $(document).ready(function() {
    setTimeout(function(){ 
        $(".alert-success").hide(); 
        $(".alert-danger").hide(); 
    }, 5000);
});
</script>
</body>
</html>