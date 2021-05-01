<?php
session_start();
include_once 'includes/config.php';
$oid = intval($_GET['oid']);
?>
<script language="javascript" type="text/javascript">
  function f2() {
    window.close();
  }
  ser

  function f3() {
    window.print();
  }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Order Tracking Details</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <link href="anuj.css" rel="stylesheet" type="text/css">
</head>

<body>

  <div style="margin-left:50px; background-color:azure;">
    <form name="updateticket" id="updateticket" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr height="50">
          <td colspan="2" class="fontkink2" style="padding-left:0px;">
            <div class="fontpink2"> <b>Order application status!</b></div>
          </td>

        </tr>
        <tr height="30">
          <td class="fontkink1"><b>order Id:</b></td>
          <td class="fontkink"><?php echo $oid; ?></td>
        </tr>





        <?php

        $st = 'Accepted';
        $ret = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'");
        $num = mysqli_num_rows($ret);
        if ($num > 0) {
          while ($row = mysqli_fetch_array($ret)) {
        ?>



            <tr height="20">
              <td class="fontkink1"><b>At Date:</b></td>
              <td class="fontkink"><?php echo $row['orderDate']; ?></td>
            </tr>
            <tr height="20">
              <td class="fontkink1"><b>Status:</b></td>
              <td class="fontkink"><?php echo $row['orderStatus']; ?></td>
            </tr>




            <?php
            $st = 'Accepted';
            $dt = 'Rejected';
            $null = '';
            $rt = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'");
            while ($num = mysqli_fetch_array($rt)) {
              $currrentSt = $num['orderStatus'];
            }
            if ($st == $currrentSt) { ?>
              <tr>
                <td colspan="2"><b>
                    Order request has been Accepted successfully </b></td>
                <br><br>
                <h3> Your order will be delivered with in two working days</h3>
                <?php

                ?>

              <?php
            } elseif ($dt == $currrentSt) { ?>
              <tr>
                <td colspan="2"><b>
                    Your Order request has been Rejected </b></td>

                <br><br>
                <h3> Please place your order by next time!</h3>
              <?php echo "br";
              echo $row['orderStatus'];
            } else { ?>




              <tr>
                <td colspan="2"><b>
                    Your Order request has been Sent </b></td>

                <br><br>
                <h3> Please wait for admin Staff Approval </h3>
              <?php echo $row['orderStatus'];
            }

              ?>





      </table>
    </form>
  </div>

</body>

</html>
<?php }
        } ?>