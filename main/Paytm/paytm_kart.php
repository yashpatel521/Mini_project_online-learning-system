
<?php
	require_once("includes/header.php");
	
	if($_GET['plan'] && $_GET['value'])
    {
        $plan = $_GET['plan'];
        $price = $_GET['value'];
        
        //echo $user_id;
    }
?>
<!doctype html>
<html lang="en">
<head>
	<?php include('includes/uplinks.php') ?>
</head>
<body>
   
    <?php include('includes/topbar.php') ?>
   
    <?php
        
        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $timestamp = date('d-m-Y H:i:s');
        
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
    
    ?>
    <!-- Image and text -->
    <section class="blog_area single-post-area section_padding" style="margin-left:25%">
        <div class="container">
            <div class="row" >
                <div class="well col-md-8 col-sm-12">
        
        
                    <form method="post" action="pgRedirect.php">
        
                        <div class="row">
                            <div class="col">
                                <p>
                                    <em>Date: <?php echo date("jS F, Y", strtotime($timestamp)); ?></em>
                                </p>
                            </div>
                            <div class="col">
                                <p>
                                    <em>ORDER-ID #: <input id="ORDER_ID" tabindex="1" maxlength="20" size="11"
                                                           style="border: none;background: #f5f5f5"
                                                           name="ORDER_ID" autocomplete="off"
                                                           value="<?php echo "ORDS" . rand(10000, 99999999) ?>"></em>
                                </p>
                            </div>
                            <div class="col">
                                <p>
                                    <em>CUST-ID #: <input id="CUST_ID" tabindex="1" maxlength="20" size="11"
                                                          style="border: none;background: #f5f5f5"
                                                          name="CUST_ID" autocomplete="off"
                                                          value="<?php echo "CUST" . $userLoggedIn_id; ?>"></em>
                                </p>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="p-3">
                                <h1>Your Checkout</h1>
                            </div>
                            </span>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Subscription Plan</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="col-md-9"><?php echo $plan; ?></h4></td>
                                    <td class="col-md-1 text-center">Rs.<?php echo $price; ?></td>
                                    <td class="col-md-1 text-center">Rs.<?php echo $price; ?></td>
                                </tr>
                                
                                <tr>
                                    <td>  </td>
                                    <td class="text-right" colspan="2">
        
                                        <p>
                                            <strong>Grand Total &nbsp;<span class="ti-arrow-circle-down"></span></strong>
                                        </p></td>
                                </tr>
        
                                <tr>
                                    <td><input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12"
                                               name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">  
                                    </td>
                                    <td><input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12"
                                               name="CHANNEL_ID" autocomplete="off" value="WEB">  
                                    </td>
                                    
                                    <td class="text-center text-danger">
                                        <h4>Rs.<?php echo $price; ?>
                                            <strong>
                                                <input hidden title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT"
                                                           value="<?php echo $price; ?>" size="3"
                                                           style="border: none;background: #f5f5f5">
                                            </strong>
                                        </h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" value="CheckOut" class="btn btn-success btn-lg btn-block">
                                Pay Now   <span class="ti-arrow-circle-right"></span>
                            </button>
                            </td>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php')?>
    <?php  include('includes/downlinks.php')?>
</body>
</html>