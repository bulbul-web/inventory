<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/rocker/color-version/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Jan 2019 07:13:14 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>
      <?php
            if(isset($title))
            {
                echo $title;
            }
        ?>
  </title>
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon"/>
  <?php
        if(isset($css))
        {
            echo $css;
        }
    ?>
  
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <?php
        if(isset($sideMenu))
        {
            echo $sideMenu;
        }
    ?>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
    <?php
        if(isset($topBar))
        {
            echo $topBar;
        }
    ?>
<!--end topbar header-->
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->
	  
    <?php
        if(isset($content)){
            echo $content;
        }
    ?>
	  
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
        <?php
            if(isset($footer)){
                echo $footer;
            }
        ?>
	<!--End footer-->
   
  </div><!--End wrapper-->

  <?php
        if(isset($scripts))
        {
            echo $scripts;
        }
    ?>
  
   
  
</body>

<!-- Mirrored from codervent.com/rocker/color-version/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Jan 2019 07:14:59 GMT -->
</html>