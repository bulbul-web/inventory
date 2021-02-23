<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/rocker/color-version/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Jan 2019 07:43:26 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Login</title>
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url();?>assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body>
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="<?php echo base_url();?>assets/images/logo-icon.png" style="width: 190px;">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
                  <div class="alert alert-danger text-center">
                        
                        <?php
                        $message = $this->session->userdata('message');
                        //echo $message;
                        if (isset($message)) {
                            echo $message;
                            $this->session->unset_userdata('message');
                        }
                        ?>
                    </div>
		    <?php echo form_open('login-check', 'name="login-form" id="loginForm"')?>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label class="sr-only">Email</label>
				  <input type="Email" name="user_email" class="form-control form-control-rounded" placeholder="Email" value="">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
                                <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label class="sr-only">Password</label>
				  <input type="password" name="user_pass" class="form-control form-control-rounded" placeholder="Password" value="">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
                                  <?php echo form_error('user_pass', '<div class="error">', '</div>'); ?>
			   </div>
			  </div>
			<div class="form-row mr-0 ml-0">
			 <div class="form-group col-6">
			   <div class="icheck-primary">
                <input type="checkbox" id="user-checkbox" checked="" />
                <label for="user-checkbox">Remember me</label>
			  </div>
			 </div>
			 <div class="form-group col-6 text-right">
			  <a href="">Reset Password</a>
			 </div>
			</div>
                  <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Sign In</button>
			  <div class="text-center pt-3">
				<p>or Sign in with</p>
				<a href="" class="btn-social btn-social-circle btn-facebook waves-effect waves-light m-1"><i class="fa fa-facebook"></i></a>
				<a href="" class="btn-social btn-social-circle btn-google-plus waves-effect waves-light m-1"><i class="fa fa-google-plus"></i></a>
				<a href="" class="btn-social btn-social-circle btn-twitter waves-effect waves-light m-1"><i class="fa fa-twitter"></i></a>
				<hr>
				<p class="text-muted">Do not have an account? <a href=""> Sign Up here</a></p>
			  </div>
			 <?php echo form_close();?>
		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  
</body>

<!-- Mirrored from codervent.com/rocker/color-version/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Jan 2019 07:43:26 GMT -->
</html>
