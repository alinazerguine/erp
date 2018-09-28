<!-- Bootstrap Core CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css">
<link href="<?php echo SURL;?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo SURL;?>assets/css/bootstrap-select.min.css" rel='stylesheet' type='text/css' />
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
<link rel="stylesheet" type="text/css" href="<?php echo SURL;?>assets/datepicker/css/bootstrap-datetimepicker.min.css">
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
<?php 
	if($this->uri->segment(3)=='documents'){
		 $referenceNo = $reference_no;
	}else{
		 $referenceNo = 0;
	}
?>
<script type="text/javascript">
	var SURL = '<?php echo SURL?>';
	var ADMIN = '<?php echo ADMIN?>';
	var HR = '<?php echo HR?>';
	var SITE_MANAGER = '<?php echo SITE_MANAGER?>';
	var CURRENCY = '<?php echo CURRENCY?>';
	var referenceNo = '<?php echo $referenceNo?>';
</script>
