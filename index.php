<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
if($query)
{
	echo "<script>alert('You are successfully register');</script>";
}
else{
echo "<script>alert('Not register something went worng');</script>";
}
}
// Code for User login
if(isset($_POST['login']))
{
   $name=$_POST['name'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE name='$name' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="indexxx.php";
$_SESSION['login']=$_POST['name'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(name,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="index.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(name,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
exit();
}
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Shopping Portal | Signi-in | Signup</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">
<script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>



	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?#php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?#php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->


<div class="body-content outer-top-bd" >
	<div class="container" >
		<div class="sign-in-page inner-bottom-sm" style=" text-align:center; margin-left: 320px; margin-top: 30px;
  margin-right: 37px;
  width: 80%;
  border: 3px white;
  padding: 10px;">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-6 col-sm-6 sign-in"  >
	<h4 class="" style="background-color: black;">sign in</h4>
	<p class="text title-tag-line">Login With Registered User.</p>
	
	<form class="register-form outer-top-xs" method="post" >
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>
		<div class="form-group">
		    <label class="info-title" for="name">Username<span>*</span></label>
		    <input type="name" name="name"style="height: 40px; width:250px; "  class="w3-input w3-border w3-round-large" id="name" >
			
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="password">Password <span>*</span></label>
		 <input type="password" style="height: 40px; width:250px; " name="password"  class="w3-input w3-border w3-round-large" id="password" >
		</div>
		
	  	<button style="background-color: black; width:150px; " type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Login</button>
		  <button style="background-color: black; color:white; width:210px;" type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">	<a style="background-color: black; color:white; " href="login.php">Registration</a></button>
		  <div class="radio outer-xs">
			  <a href="forgot-password.php" style="color: black;   " class="forgot-password pull-right">Forgot your Password?</a>
			  
		</div>
	</form>					
</div>

<!-- Sign-in -->

<!-- create a new account -->

<!-- create a new account -->


			</div><!-- /.row -->
		</div>
<?#php include('includes/brands-slider.php');?>
</div>
</div>

<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy;Develop by Jothe || MV Supermarket Inventory System|| ©️2021 </b> All rights reserved.
		</div>
	</div>
<?#php include('includes/footer.php');?>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	

</body>
</html>