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
												
												
												<li class="nav-item active">
													<a class="nav-link" href="payment_details.php">Plans<span class="sr-only">(current)</span></a>
												</li>
												<li class="nav-item ">
													<a class="nav-link" href="subscription_details.php">Payments</span></a>
												</li>
											
											</ul>
										</div>
									</nav>
								</div>
								<div class="card shadow mb-3">
									<div class="card-header bg-primary py-3">
										<p class="text-white m-0 font-weight-bold">Plan Details</p>
									</div>
									<div class="container-fluid">
										<div class="card-body">
											
											<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
												<table class="table  table-hover  my-0"  id="dataTable">
													<thead >
													<tr class="table-active">
														<th>Sr&nbsp;No.</th>
														<th>Plan Name</th>
														<th>Duration</th>
														<th>Price</th>
														<th>Update</th>
														<th>Acticate/Deactivate</th>
														<th>Status</th>
													</tr>
													</thead>
													<tbody>
													<?php
                                                        
                                                        if(isset($_POST['status-update']))
                                                        {   $p_id = $_POST['pid'];
                                                            $status = $_POST['status'];
                                                            if ($status == 111)
                                                            {
	                                                            echo '
                                                                    <script>alert("Select Valid Option");
                                                                    location.href = "payment_details.php";
                                                                    </script>
                                                                ';
                                                            }
                                                            else
                                                            {
	                                                            $upquery = $con->prepare("UPDATE plans SET status=$status WHERE id=$p_id");
	                                                            $upquery->execute();
	                                                            echo '
                                                                    <script>alert("Action Completed");
                                                                    location.href = "payment_details.php";
                                                                    </script>
                                                                ';
                                                            }
                                                            
                                                        }
                                                        
														$query = $con->prepare("SELECT * FROM plans");
														$query->execute();
														$c=0;
														if ($query->rowCount() != 0) {
															while($row = $query->fetch(PDO::FETCH_ASSOC))
															{
																$plan_id = $row['id'];
																if($row["status"] == 1)
                                                                {
                                                                    $show = "Active";
                                                                }
																else
                                                                {
                                                                    $show = "De-active";
                                                                }
																$c++;
																echo "
                                                                    <tr><td>$c</td>
                                                                    <td>".$row["plan"].
																	"</td><td>".$row["period"].
																	"</td><td>".$row["price"].
																	"</td><td>".
																	"<button  style='margin-bottom:5px;' class='btn btn-primary editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                        <i class='fas fa-edit'></i>
                                                                        </button></td><td>".
																	"<form method='post'>
                                                                        <input name='pid' value='$plan_id' hidden>
                                                                        <select class='p-2' style='outline: none;' name='status'>
                                                                            <option value='111'>Choose Action</option>
                                                                            <option value='1'>Active</option>
                                                                            <option value='0'>Deactivate</option>
                                                                        </select>
                                                                        <button type='submit' class='btn btn-secondary' name='status-update'><span class='fas fa-arrow-right'></span></button>
                                                                    </form></td><td>$show</td>"
																	;
															}
															echo "</table>";
														}
														else {
															echo "<tr><td colspan='7' class='text-center'>No Data Found in Db </td></tr>";
														}
													?>
													</tbody>
												</table>
												<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Update Plan Details</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form action="update.php" method="POST" enctype="multipart/form-data">
																	<div class="form-group">
																		<label>Plan Name</label>
																		<input type="text" class="form-control"   id="plan" name="plan"  placeholder="Enter Plan Name"  required>
																	</div>
																	<input type="text" name="pid" id="pid" value="<?php echo $plan_id; ?>" hidden>
																	<div class="form-group">
																		<label>Duration</label>
																		<input type="text" class="form-control"   id="duration" name="duration"  placeholder="Enter Duration"  required>
																	</div>
																	<div class="form-group">
																		<label>Price</label>
																		<input type="text" class="form-control" id ="price"  name="price"  placeholder="Enter Price"  required>
																	</div>
																	
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																		<button type="submit" name="update-plan" class="btn btn-primary">Update</button>
																	</div>
																</form>
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

<script >
    $(document).ready(function(){
        $('.editbtn').on('click',function(){
            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);

            $('#plan').val(data[1]);
            $('#duration').val(data[2]);
            $('#price').val(data[3]);

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
