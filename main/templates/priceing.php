<?php

    $p1 = $con->prepare("SELECT * FROM plans WHERE id = 1");
    $p1->execute();
    $p1_row = $p1->fetch(PDO::FETCH_ASSOC);
	
	$p2 = $con->prepare("SELECT * FROM plans WHERE id = 2");
	$p2->execute();
	$p2_row = $p2->fetch(PDO::FETCH_ASSOC);
	
	$p3 = $con->prepare("SELECT * FROM plans WHERE id = 3");
	$p3->execute();
	$p3_row = $p3->fetch(PDO::FETCH_ASSOC);
	
	$permission = 1;  // IF 0 >> already paid ELSE have to pay(1)
 
	if(isset($_SESSION["userLoggedIn"]))
	{
		include("includes/check_login.php");
		$query = $con->prepare("SELECT * FROM subscription WHERE learner_id=$userLoggedIn_id");
		$query->execute();
		if($query->rowCount() == 1)
        {
	        $row = $query->fetch(PDO::FETCH_ASSOC);
	        $start = $row['sub_start'];
	        $end = $row['sub_end'];
	        $today = date('Y-m-d');
	
	        if ($start <= $today && $end >= $today)
	        {   //already pay
		        $permission = 0;
	        }
	        else
            {
                $permission = 1;
            }
        }
	}
	else
    {   //not have pay
        $permission = 1;
    }
	
?>

<main>
    
<!--    <p id="abc">--><?php //echo $userLoggedIn; ?><!--</p>-->
    <div class="container">
        <h1 class="text-center pricing-table-title mt-5">Subscription Plan</h1>
        <div class="row">
            <?php
                if ($p1_row['status'] == 1)
                {
            ?>
                    <div class="col-md-4">
                        <div class="card pricing-card pricing-plan-basic">
                            <div class="card-body">
                                <i class="mdi ti-package pricing-plan-icon"></i>
                                <p class="pricing-plan-title"><?php echo $p1_row['plan']; ?></p>
                                <h3 class="pricing-plan-cost ml-auto">Rs. <?php echo $p1_row['price']; ?></h3>
                                <ul class="pricing-plan-features">
                                    <li>All Courses Access</li>
                                    <li class="font-weight-bold"><?php echo $p1_row['period']; ?></li>
                                    <!--                            <li>Custom Hold Music</li>-->
                                    <!--                            <li>10 participants max</li>-->
                                </ul>
                                <?php
	                                if($permission == 0)
                                    {
                                ?>
	                                    <button type="button" class="btn pricing-plan-purchase-btn" disabled><span style="font-size: 14px">Subcription Active</span></button>
                                <?php
                                    }
	                                else
                                    {
                                ?>
	                                    <a href="paytm_kart.php?plan=<?php echo $p1_row['plan'];?>&value=<?php echo $p1_row['price']; ?>" class="btn pricing-plan-purchase-btn">Purchage</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            
		        if ($p2_row['status'] == 1)
		        {
	        ?>
                    <div class="col-md-4">
                <div class="card pricing-card pricing-card-highlighted  pricing-plan-pro">
                    <div class="card-body">
                        <i class="mdi ti-cup pricing-plan-icon"></i>
                        <p class="pricing-plan-title"><?php echo $p2_row['plan']; ?></p>
                        <h3 class="pricing-plan-cost ml-auto">Rs.<?php echo $p2_row['price']; ?></h3>
                        <ul class="pricing-plan-features">
                            <li>All Courses Access</li>
                            <li class="font-weight-bold"><?php echo $p2_row['period']; ?></li>
<!--                            <li>Custom Hold Music</li>-->
<!--                            <li>10 participants max</li>-->
                        </ul>
	                    <?php
		                    if($permission == 0)
		                    {
			                    ?>
                                <button type="button" class="btn pricing-plan-purchase-btn" disabled><span style="font-size: 14px">Subcription Active</span></button>
			                    <?php
		                    }
		                    else
		                    {
			                    ?>
                                <a href="paytm_kart.php?plan=<?php echo $p2_row['plan'];?>&value=<?php echo $p2_row['price']; ?>" class="btn pricing-plan-purchase-btn">Purchage</a>
			                    <?php
		                    }
	                    ?>
                    </div>
                </div>
            </div>
            <?php
		        }
	
	            if ($p3_row['status'] == 1)
	            {
		    ?>
                <div class="col-md-4">
                    <div class="card pricing-card pricing-plan-enterprise">
                        <div class="card-body">
                            <i class="mdi ti-briefcase pricing-plan-icon"></i>
                            <p class="pricing-plan-title"><?php echo $p3_row['plan']; ?></p>
                            <h3 class="pricing-plan-cost ml-auto">Rs.<?php echo $p3_row['price']; ?></h3>
                            <ul class="pricing-plan-features">
                                <li>All Courses Access</li>
                                <li class="font-weight-bold"><?php echo $p3_row['period']; ?></li>
                            </ul>
	                        <?php
		                        if($permission == 0)
		                        {
			                        ?>
                                    <button type="button" class="btn pricing-plan-purchase-btn" disabled><span style="font-size: 14px" >Subcription Active</span></button>
			                        <?php
		                        }
		                        else
		                        {
			                        ?>
                                    <a href="paytm_kart.php?plan=<?php echo $p3_row['plan'];?>&value=<?php echo $p3_row['price']; ?>" class="btn pricing-plan-purchase-btn">Purchage</a>
			                        <?php
		                        }
	                        ?>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</main>