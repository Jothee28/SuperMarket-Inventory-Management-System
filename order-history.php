<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

#if(isset($_GET['del']))
#		  {
	#	          mysqli_query($con,"delete from products where id = '$_GET[id]'");
       #           $_SESSION['delmsg']="Product deleted !!";
		#  }

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

	    <title>Order History</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
		<link rel="shortcut icon" href="assets/images/favicon.ico">
	<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?#php include('includes/main-header.php');?>
<?#php include('includes/menu-bar.php');?>
<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					
<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">

			<div class="logo">


				

				
						<button  style="margin-left: 120px; padding: 15px 49px; font-size: 16px;font-weight: 26px; margin-top: 60px;background-color: black;
  margin-right: auto;" style="background-color: black; color:white;" type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login"><a style="background-color: black; color:white;" href="indexxx.php">Add Products</a></button>

				<br><br><br><br><br><br>
			</div>
		</div>


</header>
<!-- ============================================== HEADER : END ============================================== -->
<!-- /.breadcrumb -->

<br><br><br><br>
<div class="body-content outer-top-xs">
	<div class="container" >
		<div class="row inner-bottom-sm" >
			<div class="shopping-cart">
				<div class="col-md-12 col-sm-12 shopping-cart-table " >
	<div class="table-responsive">
<form name="cart" method="post">	

		<table class="table table-bordered" align="center"  >
			<thead>
				<tr  style="background-color: black;">
					<th style="text-align: center;" class="cart-romove item">Bil</th>
					
					<th style="text-align: center;"class="cart-product-name item">Product Name</th>
			
					<th style="text-align: center;"class="cart-qty item">Quantity</th>
					
					<th style="text-align: center;"class="cart-total item">Amount (RM)</th>
					<th style="text-align: center;"class="cart-description item">Order Date</th>
					<th style="text-align: center;"class="cart-total last-item">Staus</th>
				
				</tr>
			</thead><!-- /thead -->
			
			<tbody>

<?php $query=mysqli_query($con,"select products.productname as pname,products.quantity as quantity,products.id as proid,orders.productId as opid,orders.quantity as qty,products.amount as amnt,orders.orderStatus as orderStatus,orders.orderdate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
				<tr>
					<td style="text-align: center;"><?php echo $cnt;?></td>
				
					<td style="text-align: center;" class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo $row['opid'];?>">
						<?php echo $row['pname'];?></a></h4>		
					</td>
					<td style="text-align: center;" class="cart-product-quantity">
						<?php echo $qty=$row['qty']; ?>   
		            </td>
					
					<td style="text-align: center;" class="cart-product-grand-total"><?php echo ($qty*$row['amnt']);?></td>
					<td style="text-align: center;" class="cart-product-sub-total"><?php echo $row['odate']; ?>  </td>
					
					<td style="text-align: center;"><button style="background-color: black; color:white;" type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">
 <a href="javascript:void(0);" style=" color:white;" onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']);?>');" title="Track order">
					Track</a></button>  </td>
				</tr>
<?php $cnt=$cnt+1;} ?>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
		
	</div>
</div>

		</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		</form>
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<?#php echo include('includes/brands-slider.php');?>
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

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
<?php } ?>