<?php
	require_once("include/header.php");

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet"
	      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.21/datatables.min.css"/>
	
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

</head>
<body id="page-top">
<div id="wrapper">
	<?php require_once("include/sidebar.php");?>
	<div class="d-flex flex-column" id="content-wrapper">
		<div id="content">
			<?php require_once("include/topbar.php");?>
			
			<div class="container-fluid">
				<h3 class="text-dark mb-4">Subscription</h3>
				<div class="row mb-3">
					<div class="col-lg-12">
						<div class="row">
							<div class="col">
								<div class="card shadow mb-3 py-1">
									<nav class="navbar navbar-expand-lg navbar-light bg-light">
										<div class="" id="navbarNav">
											<ul class="navbar-nav">
												
												
												<li class="nav-item ">
													<a class="nav-link" href="payment_details.php">Plans<span class="sr-only">(current)</span></a>
												</li>
												<li class="nav-item active">
													<a class="nav-link" href="subscription_details.php">Payments</a>
												</li>
											
											</ul>
										</div>
									</nav>
								</div>
								<div class="card shadow mb-3">
									<div class="card-header bg-primary py-3">
										<p class="text-white m-0 font-weight-bold">Payment Details</p>
									</div>
									<div class="container-fluid">
										<div class="card-body">
                                            <div class="float-left">
                                                
                                                <form method="post">
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="start_date">
                                                        </div> <span>&nbsp; to &nbsp;</span>
                                                        <div class="form-group">
                                                            <?php $now = date( 'Y-m-d') ?>
                                                            <input type="date" class="form-control" name="end_date" value="<?php echo date( 'Y-m-d'); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary" name="searchDate"><span class="fas fa-arrow-right"></span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
											<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
												<table class="table table-hover  my-0"  id="dataTable">
													<thead >
													<tr class="table-active">
														<th>Sr&nbsp;No.</th>
														<th>OrderID</th>
														<th>Plan</th>
														<th>Duration</th>
														<th>Amount</th>
														<th>Pay_Mode</th>
														<th>Timestamp</th>
														<th>View</th>
                                                        
                                                        <th hidden>name</th>
                                                        <th hidden>email</th>
                                                        <th hidden>start</th>
                                                        <th hidden>end</th>
                                                        <th hidden>p-status</th>
                                                        <th hidden>bank</th>
													</tr>
													</thead>
													<tbody>
													<?php
													
													?>
													<?php
														
														
														if(isset($_POST['searchDate']))
														{
															$start_date = $_POST['start_date'];
															$end_date = $_POST['end_date'];
															if($start_date == '' || $end_date == '')
                                                            {
                                                                echo '
                                                                    <script>alert("Please Select Date");
                                                                    location.href = "subscription_details.php";
                                                                    </script>
                                                                ';
                                                            }
															else
                                                            {
	                                                            $pquery = $con->prepare("SELECT * FROM subscription WHERE txn_date BETWEEN CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");
	                                                            $pquery->execute();
	                                                            
	                                                            
	                                                            if ($pquery->rowCount() != 0)
	                                                            {   $c = 0;
		                                                            while($row = $pquery->fetch(PDO::FETCH_ASSOC))
		                                                            {
			                                                            $sub_id = $row['id'];
			                                                            $learner = $row['learner_id'];
			                                                            $sub_start = $row['sub_start'];
			                                                            $sub_end = $row['sub_end'];
			                                                            $plan = $row["plan"];
			                                                            $duration = $row["duration"];
			                                                            $order_id = $row["order_id"];
			                                                            $pay_mode = $row["pay_mode"];
			                                                            $txn_date = $row["txn_date"];
			                                                            $txn_status = $row['txn_status'];
			                                                            $bank_name = $row['bank_name'];
			                                                            $txn_amount = $row["txn_amount"];
			
			                                                            $learn = $con->prepare("SELECT * FROM users WHERE id = $learner");
			                                                            $learn->execute();
			
			                                                            $l_row = $learn->fetch(PDO::FETCH_ASSOC);
			                                                            $name = $l_row['firstName']." ".$l_row['lastName'];
			                                                            $email = $l_row['email'];
			
			                                                            $c++;
			                                                            
			                                                            echo "
                                                                            <tr><td>$c</td>
                                                                            <td>".$row["order_id"].
				                                                            "</td><td>".$row["plan"].
				                                                            "</td><td>".$row["duration"].
				                                                            "</td><td>".$row["txn_amount"].
				                                                            "</td><td>".$row["pay_mode"].
				                                                            "</td><td>".$row["txn_date"].
				                                                            "</td><td hidden>".$name.
				                                                            "</td><td hidden>".$email.
				                                                            "</td><td hidden>".$row["sub_start"].
				                                                            "</td><td hidden>".$row["sub_end"].
				                                                            "</td><td hidden>".$row["txn_status"].
				                                                            "</td><td hidden>".$row["bank_name"].
				                                                            "</td><td>".
				                                                            "<button  style='margin-bottom:5px;' class='btn btn-success editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                            <i class='fas fa-eye'></i>
                                                                            </button></td>"
			                                                            ;
		                                                            }
		                                                            echo "</table>";
	                                                            }
	                                                            else
	                                                            {
		                                                            echo '
																	<script>alert("NO TRANSACTION FOUND");
																		location.href = "subscription_details.php";
																	</script>';
	                                                            }
                                                            }
														}
														else
														{
														
                                                            $query = $con->prepare("SELECT * FROM subscription");
                                                            $query->execute();
                                                            $c=0;
                                                            if ($query->rowCount() != 0)
                                                            {
                                                                while($row = $query->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    $sub_id = $row['id'];
                                                                    $learner = $row['learner_id'];
                                                                    $sub_start = $row['sub_start'];
                                                                    $sub_end = $row['sub_end'];
                                                                    $plan = $row["plan"];
                                                                    $duration = $row["duration"];
                                                                    $order_id = $row["order_id"];
                                                                    $pay_mode = $row["pay_mode"];
                                                                    $txn_date = $row["txn_date"];
                                                                    $txn_status = $row['txn_status'];
                                                                    $bank_name = $row['bank_name'];
                                                                    $txn_amount = $row["txn_amount"];
	
	                                                                $learn = $con->prepare("SELECT * FROM users WHERE id = $learner");
	                                                                $learn->execute();
	
	                                                                $l_row = $learn->fetch(PDO::FETCH_ASSOC);
	                                                                $name = $l_row['firstName']." ".$l_row['lastName'];
	                                                                $email = $l_row['email'];
                                                                    
                                                                    $c++;
                                                                    echo "
                                                                        <tr><td>$c</td>
                                                                        <td>".$row["order_id"].
                                                                        "</td><td>".$row["plan"].
                                                                        "</td><td>".$row["duration"].
                                                                        "</td><td>".$row["txn_amount"].
                                                                        "</td><td>".$row["pay_mode"].
	                                                                    "</td><td>".$row["txn_date"].
                                                                     
	                                                                    "</td><td hidden>".$name.
	                                                                    "</td><td hidden>".$email.
	                                                                    "</td><td hidden>".$row["sub_start"].
	                                                                    "</td><td hidden>".$row["sub_end"].
	                                                                    "</td><td hidden>".$row["txn_status"].
	                                                                    "</td><td hidden>".$row["bank_name"].
                                                                        "</td><td>".
                                                                        "<button  style='margin-bottom:5px;' class='btn btn-success editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                            <i class='fas fa-eye'></i>
                                                                            </button></td>"
                                                                        ;
                                                                }
                                                                echo "</table>";
                                                            }
                                                            else
                                                            {
                                                                echo "<tr><td colspan='7' class='text-center'>No Data Found in Db </td></tr>";
                                                            }
														}
													?>
													</tbody>
												</table>
												<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content" style="width: 600px">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">View Details</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body" style="width: 600px">
																<div class="row pl-2" >
                                                                    
                                                                        <div class="col-6" id="printarea1" style="color:#000;">
                                                                            <p style="font-size: 14px;">Name : <span id="name"></span></p>
                                                                            <p style="font-size: 14px;">Email : <span id="email"></span></p>
                                                                        </div>
                                                                        <div class="col-6" id="printarea2" style="color:#000;">
                                                                            <p style="font-size: 14px;">Subscription Start : <span id="start"></span></p>
                                                                            <p style="font-size: 14px;">Subscription End : <span id="end"></span></p>
                                                                        </div>
                                                                        <hr style="width:90%">
																	<div class="row pl-5" id="printarea3">
																		<table class="table-borderless" style="color:#000;width: 350px;margin-left: 100px" >
																			<tr class="pl-3">
																				<td >Order ID</td>
																				<td><span id="oid"></span></td>
																			</tr>
                                                                            <tr>
                                                                                <td>Payment Status</td>
                                                                                <td><span id="status"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Amount</td>
                                                                                <td>Rs. <span id="amount"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Bank Name</td>
                                                                                <td><span id="bank"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Payment Mode</td>
                                                                                <td><span id="mode"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Plan</td>
                                                                                <td><span id="plan"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Duration</td>
                                                                                <td><span id="duration"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Transaction Date</td>
                                                                                <td><span id="t_date"></span></td>
                                                                            </tr>
																		</table>
																	</div>
																</div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" onclick="printDiv();" class="btn btn-primary">Print</button>
                                                                </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>

<!-- Script to print the content of a div -->
<script>
    function printDiv() {
        var divContents1 = document.getElementById("printarea1").innerHTML;
        var divContents2 = document.getElementById("printarea2").innerHTML;
        var divContents3 = document.getElementById("printarea3").innerHTML;
        var a = window.open('', '', 'fullscreen=yes');
        a.document.write('<html>');
        a.document.write('<head><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">');
        a.document.write('<body style="font-family: Nunito;"> <p style="font-size: 26px;color: #0B7BFF;text-align: center;font-weight: bolder;padding-top: 20px">Brighter Bee <br></p>');
        a.document.write('<div style="text-align: left;font-weight: bold;padding: 50px 100px">');
        a.document.write(divContents1);
        a.document.write(divContents2);
        a.document.write('</div>');
        a.document.write('<center>');
        a.document.write(divContents3);
        a.document.write('</center>');
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>

<script >
    
    $(document).ready(function(){
    $('.editbtn').on('click',function(){
    $('#editmodal').modal('show');
    
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
    return $(this).text();
    }).get();
    console.log(data);
    
    $('#oid').text(data[1]);
    $('#plan').text(data[2]);
    $('#duration').text(data[3]);
    $('#amount').text(data[4]);
    $('#mode').text(data[5]);
    $('#t_date').text(data[6]);
    $('#name').text(data[7]);
    $('#email').text(data[8]);
    $('#start').text(data[9]);
    $('#end').text(data[10]);
    $('#status').text(data[11]);
    $('#bank').text(data[12]);
    
    });
});

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable({
            ordering:false
        });
    });
</script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
</body>

</html>
