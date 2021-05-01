<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_usrqty= "SELECT currentInventory FROM products WHERE id={$id}";
		$sql_quantity = "SELECT currentInventory FROM products";
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		
		}else{
			$message="Product ID is invalid";
		}
	}
		
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}

mysqli_select_db($con,DB_NAME);
$query = "SELECT * FROM products ";
$result = mysqli_query($con,$query);


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

	    <title>SOC Inventory Management</title>

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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


		<script>
	$(document).ready(function(){ 
	$("#product_id").on('change', function(){  
		if($("#product_id").val()!=0){
			var url  =  "http://localhost/InventoryManagement/indexxx.php?product_id="+$("#product_id").val();
		window.location.href=url;

		}
		else{
			alert("Choose Product Plz");
		}

	
    
});
	});
</script>

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>



</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="wrapper">
		<div class="container">
			<div class="row">

		<!--/.new   content-->
		<div class="col-md-9"style=" margin-left: 120px; margin-top: 30px;background-color: black;
  margin-right: auto;
  width: 80%;
  border: 3px white;
  padding: 10px;">
					<div class="content" style="background-color: black;">

	<div class="module"style="text-align: center;">
							<div class="module-head" style="text-align: center;">
								<h1 style=" color: white;" >Products</h1>
							</div>
							<div class="module-body table" style="text-align: center;">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Bil</th>
											<th>Product Name</th>
											<th>Product Code</th>
											<th>Amount (RM)</th>
											<th>Quantity</th>
										
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"SELECT * FROM products" );
 

$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['productname']);?></td>
											
											<td><?php echo htmlentities($row['productCode']);?></td>
											<td><?php echo htmlentities($row['amount']);?></td>
											<td><?php echo htmlentities($row['currentInventory']);?></td>
											
											<td>
											
											<button style="background-color: black; color:white;" type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">	<a   href="indexxx.php?page=product&action=add&id=<?php echo $row['id']; ?>">Order</a></button></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>			
						</div>
						</div>		
		<?php 



$option = $_POST['taskOption'];

switch ($option)

{
default:
display($option);

}
function display($value)
{
    include('includes/config.php');
   while($row= $result->fetch_assoc())
    {

     if($value == $row['id'])
   echo "<br> Name:".$row['productname']."<br> Product Code:" .$row['productCode']."<br> Product Amount:" .$row['amount']."<br>";
    }

}


?>

<!-- ============================================== INFO BOXES : END ============================================== -->		
	

		<!-- ============================================== SCROLL TABS ============================================== -->
	


      
		<!-- ============================================== TABS : END ============================================== -->

		
		<div class="footer">
		<div class="container">
			 

		<b class="copyright">&copy;Develop by Jothe || MV Supermarket Inventory System|| ©️2021 </b> All rights reserved.
		</div>
	</div>

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

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy;Develop by Hema Naidu || SOC Inventory Management || ©️2020 </b> All rights reserved.
		</div>
	</div>

</body>
</html>
