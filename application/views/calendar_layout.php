<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo DEFAULT_TITLE_ADMIN.' | '.$title;?></title>
  <link rel="icon" href="<?php echo base_url('assets/images/logo.jpg');?>" type="image/jpg" sizes="16x16">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

  <?php $this->load->view('admin/inc/header_script');?>
</head>
<body class="sticky-header">  <!-- left-side-collapsed --> 
 <section>      
  <?php $this->load->view('hr/inc/left');?>
  <!-- main content start-->
  <div class="main-content">
    <?php $this->load->view('admin/inc/header_top');?>
    <?php $this->load->view($subview);?>
  </div>
</section>
<?php //$this->load->view('calendar/inc/footer_script');?>

</body>
</html>