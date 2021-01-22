<?php
	require_once("include/header.php");
	
	if (isset($_POST['print']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$sub_start = $_POST['sub_start'];
		$sub_end = $_POST['sub_end'];
		$plan = $_POST["plan"];
		$duration = $_POST["duration"];
		$order_id = $_POST["order_id"];
		$pay_mode = $_POST["pay_mode"];
		$txn_date = $_POST["txn_date"];
		$txn_status = $_POST['txn_status'];
		$bank_name = $_POST['bank_name'];
		$txn_amount = $_POST["txn_amount"];
	}

	
?>
<html>
<head>
	<title>Print</title>
</head>
<body>
<div class="container" id="print_me" style="margin-top: 100px" hidden>
	<div class="row pl-2">
		<div class="col-6" style="color:#000;">
			<p >Name : <?php echo $name; ?></p>
			<p>Email : <?php echo $email; ?></p>
		</div>
		<div class="col-6" style="color:#000;">
			<p>Subscription Start : <?php echo $sub_start; ?></p>
			<p>Subscription End : <?php echo $sub_end; ?></p>
		</div>
		<hr style="width:90%">
		<div class="row pl-5" >
			<table class="table-borderless" style="color:#000;width: 350px;margin-left: 100px" >
				<tr class="pl-3">
					<td >Order ID</td>
					<td><?php echo $order_id; ?></td>
				</tr>
				<tr>
					<td>Payment Status</td>
					<td><?php echo $txn_status; ?></td>
				</tr>
				<tr>
					<td>Amount</td>
					<td>Rs. <?php echo $txn_amount; ?></td>
				</tr>
				<tr>
					<td>Bank Name</td>
					<td><?php echo $bank_name; ?></td>
				</tr>
				<tr>
					<td>Payment Mode</td>
					<td><?php echo $pay_mode; ?></td>
				</tr>
				<tr>
					<td>Plan</td>
					<td><?php echo $plan; ?></td>
				</tr>
				<tr>
					<td>Duration</td>
					<td><?php echo $duration; ?></td>
				</tr>
				<tr>
					<td>Transaction Date</td>
					<td><?php echo $txn_date; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<script>

    var printMe = document.getElementById("print_me").innerHTML;
	var original = document.body.innerHTML;
    document.body.innerHTML = printMe;

    window.print();
    
    document.body.innerHTML = original;
    
    window.location.href ="subscription_details.php";

</script>
</body>
</html>

