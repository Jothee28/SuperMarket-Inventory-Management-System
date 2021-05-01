



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