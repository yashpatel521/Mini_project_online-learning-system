<?php
	require_once("include/header.php");

?>
<!DOCTYPE html>
<html><head>
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
				<h3 class="text-dark mb-4">Contact Us</h3>
				<div class="row mb-3">
					<div class="col-lg-12">
						<div class="row">
							<div class="col">
								<div class="card shadow mb-3">
									<div class="card-header bg-primary py-3">
										<p class="text-white m-0 font-weight-bold">Contact Details</p>
									</div>
									<div class="container-fluid">
										<div class="card-body">
											<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
												<table class="table  table-hover  my-0" id="dataTable">
													<thead >
													<tr class="table-active">
														<th>Sr&nbsp;No.</th>
														<th>Name</th>
														<th>Email</th>
														<th>Subject</th>
														<th>Message</th>
														<th>Details</th>
														<th>Response</th>
														<th>Delete</th>
													</tr>
													</thead>
													<tbody>
													<?php
														$query = $con->prepare("SELECT * FROM contact_us");
														$query->execute();
														$c=0;
														if ($query->rowCount() != 0) {
															while($row = $query->fetch(PDO::FETCH_ASSOC)) {
																$id = $row["id"];
																
																$c++;
																echo "<tr><td>$c
                                                                        </td><td>".$row["name"].
																	"</td><td>".$row["email"].
																	"</td><td>".$row["subject"].
																	"</td><td>".$row["message"].
																	"</td><td>".
																	
																	"<button  style='margin-bottom:5px;' class='btn btn-primary editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                        <i class='fas fa-eye'></i>
                                                                        </button>"."</td><td>".
																	"<a href='mailto:$row[email]' style='margin-bottom:5px;' class='btn btn-secondary'>
                                                                        <i class='fas fa-arrow-right'></i>
                                                                        </a>"."</td><td>".
																	"<a href='delete.php?contact=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a></td></tr>";
															}
															echo "</table>";
														}
														else {
															echo "<tr><td colspan='7' class='text-center'>No  Data Found in Db </td></tr>";
														}
													?>
													</tbody>
												</table>
												<div class="modal fade" id="editmodal" tabindex="-1" role="dialog"  aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content" style="width: 650px">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Message Details</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<div class="row pl-2" >
																	<div class="col-12">
																		<p style="font-size: 16px;">Name : <span id="name"></span></p>
																		<p style="font-size: 16px;">Email : <span id="email"></span></p>
																	</div>
																	<hr style="width:90%">
																	<div class="pl-5">
																		<p> Subject :  <span id="subject"></span></p>
																		<p> Message : <pre style="font-family: Nunito;text-align: justify;padding-left: 50px;width: 550px"><span  id="message"></span></pre></p>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


<script >
    
    $(document).ready(function(){
        $('.editbtn').on('click',function(){
            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);

            $('#name').text(data[1]);
			$('#email').text(data[2]);
			$('#subject').text(data[3]);
            $('#message').text(data[4]);
            
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
