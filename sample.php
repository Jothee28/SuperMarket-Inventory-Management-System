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
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


function fill_brand($con)  
 {  
      $output = '';  
      $sql = "SELECT * FROM products";  
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["id"].'">'.$row["productName"].'</option>';  
      }  
      return $output;  
 }  
 function fill_product($con)  
 {  
      $output = '';  
      $sql = "SELECT * FROM products";  
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-3">';  
           $output .= '<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["productName"].','.$row["shippingCharge"].','.$row["currentInventory"].',';  
           $output .=     '</div>';  
           $output .=     '</div>';  
      }  
      return $output;  
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

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?#php include('includes/main-header.php');?>

<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="index.php">
		
		<h2 style="text-align: center;">SOC Inventory Management</h2>

	</a>
</div>		
</div>

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="wrapper">
		<div class="container">

        <h3>  
                     <select name="brand" id="brand">  
                          <option value="">Show All Product</option>  
                          <?php echo fill_brand($con); ?>  
                     </select>  
                     <br /><br />  
                     <div class="row" id="show_product">  
                          <?php echo fill_product($con);?>  
                     </div>  
                </h3>  


			<div class="row">
<?#php include('include/sidebar.php');?>				
			
	

	<!--<form action="index.php" method="POST">
	
	<select  name="taskOption" >
		<option value="Select Products" selected>Select Products...</option>
		<?php 

		#while($rows = mysqli_fetch_array($result)):;?>

		<option value="<?#php echo $rows[0];?>"><?#php echo $rows[1];
		?></option>

<?php #endwhile; ?>

	</select>

<input type="submit" name="submit"  value="Go"/>
	</form>-->
	




	
	

		<br><br>
		
      
										
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
		

		<!--/.new   content-->
		<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head" style="text-align: center;">
								<h1>Our Products</h1>
							</div>
							<div class="module-body table">
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

<?php $query=mysqli_query($con,"SELECT * FROM products");
 

$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['productName']);?></td>
											
											<td><?php echo htmlentities($row['shippingCharge']);?></td>
											<td><?php echo htmlentities($row['amount']);?></td>
											<td><?php echo htmlentities($row['currentInventory']);?></td>
											

											<td>
											<!--<a href="edit-products.php?id=<?#php echo $row['id']?>" ><i class=""></i>Order</a>-->
											<a href="indexxx.php?page=product&action=add&id=<?php echo $row['id']; ?>" >Order</a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
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
   echo "<br> Name:".$row['productName']."<br> Product Code:" .$row['shippingCharge']."<br> Product Amount:" .$row['amount']."<br>";
    }

}


?>

<!-- ============================================== INFO BOXES : END ============================================== -->		
	

		<!-- ============================================== SCROLL TABS ============================================== -->
	


      
		<!-- ============================================== TABS : END ============================================== -->

		
		<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy;Develop by Hema Naidu || SOC Inventory Management || ©️2020 </b> All rights reserved.
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