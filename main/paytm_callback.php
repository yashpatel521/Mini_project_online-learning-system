<?php
	
	
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
    header("Expires: 0");
    
    require_once("includes/header.php");
    include('includes/check_login.php');
    
    
	
	// following files need to be included
	require_once("lib/config_paytm.php");
	require_once("lib/encdec_paytm.php");
	
	$paytmChecksum = "";
	$paramList = array();
	$isValidChecksum = "FALSE";
	
	$paramList = $_POST;
	$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
	
	//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
	$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<!------ Include the below in your HEAD tag ---------->
<head>
	<?php include('includes/uplinks.php') ?>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
    <div class="container">

    <!------ Include the below in your NAV tag ---------->
    <?php //include('includes/topbar.php') ?>
    <!------ Include the above in your NAV tag ---------->
    
    <?php
        if ($isValidChecksum == "TRUE") {
            
            if ($_POST["STATUS"] == "TXN_SUCCESS") { // if success
                
                /////////////////////////////////////////////////////////////////////////
                
                $ORDERID = $_POST['ORDERID'];
                $TXNDATE = $_POST['TXNDATE'];
                $TXNAMOUNT = $_POST['TXNAMOUNT'];
                $PAYMENTMODE = $_POST['PAYMENTMODE'];
                $STATUS = $_POST['STATUS'];
                $BANKNAME = $_POST['BANKNAME'];
                	
                $p1 = $con->prepare("SELECT * FROM plans WHERE id = 1");
                $p1->execute();
                $p1_row = $p1->fetch(PDO::FETCH_ASSOC);
            
                $p2 = $con->prepare("SELECT * FROM plans WHERE id = 2");
                $p2->execute();
                $p2_row = $p2->fetch(PDO::FETCH_ASSOC);
	
                $p3 = $con->prepare("SELECT * FROM plans WHERE id = 3");
                $p3->execute();
                $p3_row = $p3->fetch(PDO::FETCH_ASSOC);
                
                if($TXNAMOUNT == $p1_row['price'])
                {
                    $plan = $p1_row['plan'];
                    $duration = $p1_row['period'];
                    
                    //echo $plan;
                    //echo $duration;
                }
                elseif ($TXNAMOUNT == $p2_row['price'])
                {
                    $plan = $p2_row['plan'];
                    $duration = $p2_row['period'];
                }
                elseif ($TXNAMOUNT == $p3_row['price'])
                {
	                $plan = $p3_row['plan'];
	                $duration = $p3_row['period'];
                }
                else{
                    $plan = "not known";
                }
                
                
                //echo $userLoggedIn_id;
                $user_sub_start = date("Y/m/d");
                $user_sub_end = date("Y/m/d", strtotime(date("Y/m/d",strtotime($user_sub_start))." +".$duration));

                /*$check = $con->prepare("SELECT * FROM subscription WHERE order_id=:ORDERID");
                $check->bindValue("ORDERID", $ORDERID);
                $check->execute();*/
                
                $check = $con->prepare("SELECT * FROM subscription WHERE learner_id=$userLoggedIn_id");
                $check->execute();
                
                if ($check->rowCount() == 0)
                {
                    $umail = $userLoggedIn_id;
	                $query = $con->prepare("INSERT INTO subscription(learner_id,sub_start,sub_end,plan,duration,order_id,txn_amount,pay_mode,txn_date,txn_status,bank_name) VALUES ($umail, :user_sub_start, :user_sub_end, :plan, :duration, :ORDERID, :TXNAMOUNT, :PAYMENTMODE, :TXNDATE, :STATUS, :BANKNAME)");
                    $query->bindValue("TXNDATE", $TXNDATE);
                    // $query->bindValue("umail", $umail);
	                $query->bindValue("ORDERID", $ORDERID);
	                $query->bindValue("TXNAMOUNT", $TXNAMOUNT);
	                $query->bindValue("PAYMENTMODE", $PAYMENTMODE);
	                $query->bindValue("STATUS", $STATUS);
	                $query->bindValue("BANKNAME", $BANKNAME);
	                $query->bindValue("user_sub_start", $user_sub_start);
	                $query->bindValue("user_sub_end", $user_sub_end);
	                $query->bindValue("plan", $plan);
	                $query->bindValue("duration", $duration);
                    $query->execute();

                    $query = $con->prepare("UPDATE users set isSubscribed  = 1 WHERE id = $umail");
                    $query->execute();
                }
                else
                {
	                $query = $con->prepare("UPDATE subscription SET sub_start=:user_sub_start ,sub_end=:user_sub_end,plan=:plan,duration=:duration,order_id=:ORDERID,txn_amount=:TXNAMOUNT,pay_mode=:PAYMENTMODE,txn_date= :TXNDATE,txn_status=:STATUS,bank_name=:BANKNAME WHERE learner_id=$userLoggedIn_id");
	                $query->bindValue("TXNDATE", $TXNDATE);
	                // $query->bindValue("umail", $umail);
	                $query->bindValue("ORDERID", $ORDERID);
	                $query->bindValue("TXNAMOUNT", $TXNAMOUNT);
	                $query->bindValue("PAYMENTMODE", $PAYMENTMODE);
	                $query->bindValue("STATUS", $STATUS);
	                $query->bindValue("BANKNAME", $BANKNAME);
	                $query->bindValue("user_sub_start", $user_sub_start);
	                $query->bindValue("user_sub_end", $user_sub_end);
	                $query->bindValue("plan", $plan);
	                $query->bindValue("duration", $duration);
	                $query->execute();
                }
                
                
                /////////////////////////////////////////////////////////////////////////
                
                echo '<div class="text-center m-5">
                       
                          <h1 class="p-5">Thank You for your purchase!</h1>
                          <small style="padding:10px;background:#ddd;color:#7f7f7f;border-radius:5px;">Transation# ' . $_POST["TXNID"] . '</small>
                          <a href="profile2.php" class="btn btn-success"><i class="fas fa-arrow-circle-left" ></i> Back</a>
                        </div>';
                
                
                ?>
                
                    <div class="row ">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h4>Your transation status has been successfully processed.</h4>
    
    <!--                        <ul class="list-group">-->
                                
                                <?php
                                    $i = 0;
                                    
                                    if (isset($_POST) && count($_POST) > 0)
                                    {
                                        /*foreach ($_POST as $paramName => $paramValue) {
                                            $i++;
    
                                            if ( $i !== 14) // hidden array values (3=>TXNID,6=>CURRENCYINR,8=>STATUS,10=>RESPMSG,12=>BANKTXNID)
                                            {
                                                echo '<li class="list-group-item">
                                                      <small>(Array no. ' . $i . ')</small>
                                                      <strong>' . $paramName . '</strong>
                                                      <span class="badge">' . $paramValue . '</span>
                                                  </li>';
    
                                                continue;
                                            }
                                        }*/
                                        echo'
                                        <div class="table-responsive">
                                            <table class="mb-5 mt-10">';
                                                foreach ($paramList as $key => $value)
                                                {
    										        // echo "$key = $value<br>";
                                                    if($key!='MID' && $key!='BANKTXNID' && $key!='GATEWAYNAME' && $key!='RESPMSG' && $key!='CURRENCY' && $key!='CHECKSUMHASH' && $key!='RESPCODE')
                                                    {
                                            
                                ?>
                                                        <tr>
                                                            <td class="px-2 font-weight-bold"><?php echo $key; ?></td>
                                                            <td class="px-2"><?php echo $value; ?></td>
                                                        </tr>
                                <?php
                                                    }
                                                }
                                        echo '
                                            </table>
                                        </div>';
                                    }
                                ?>
                               
    <!--                        </ul>-->
                        </div>
                    </div>
                </div>
                
                
                
                <?php
            } else {
                //if failure
                
                echo '<div class="jumbotron text-center">
                    <i class="fas fa-times-circle text-danger" style="font-size: 78px;"></i>
                      <h1>Transaction status failure!</h1>
                       <a href="main.php" class="btn btn-success"><i class="fas fa-arrow-circle-left" ></i> Back</a>
                    </div>';
                ?>
    
                <div class="container-fluid">
                    <div class="row ">
    
                        <div class="col-md-8" style="margin-left: 300px;">
                            <h4>Your transation status has been failed.</br>
                                Paytm Responce code:
                                <a href="https://developer.paytm.com/assets/Transaction%20response%20codes%20and%20messages.pdf"
                                   target="_blank">PDF</a></h4></br>
    
    
                            <ul class="list-group">
                                <?php
                                    
                                    
                                    if (isset($_POST) && count($_POST) > 0) {
                                        
                                        
                                        echo '<li class="list-group-item">
                                                      <strong>RESPCODE</strong>
                                                      <span class="badge">' . $_POST['RESPCODE'] . '</span>
                                                  </li>';
                                        
                                        echo '<li class="list-group-item">
                                                      <strong>RESPMSG</strong>
                                                      <span class="badge">' . $_POST['RESPMSG'] . '</span>
                                                  </li>';
                                        
                                        
                                    }
                                
                                
                                ?>
    
    
                            </ul>
                        </div>
    
                    </div>
                </div>
                
                
                <?php
            }
            ?>
            
            
            <?php
        } else {
            //if checksum not match
            
            echo '<div class="jumbotron text-center">
                    <i class="fas fa-times-circle text-danger" style="font-size: 78px;"></i>
                      <h1>Checksum mismatched.!</h1>
                         <small style="padding:10px;background:#ddd;color:#7f7f7f;border-radius:5px;">Process transaction is suspicious. Someone altered the transaction details.</small>
                          <a href="main.php" class="btn btn-success"><i class="fas fa-arrow-circle-left" ></i> Back</a>
                    </div>';
        }
    
    ?>
    </div>
<?php include('includes/footer.php') ?>
<?php include('includes/downlinks.php') ?>
</body>
</html>
