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
                    <h3 class="text-dark mb-4">Learner</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Learner Details</p>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="card-body">
                                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table  table-hover  my-0" id="dataTable">
                                                        <thead >
                                                            <tr class="table-active">
                                                                <th>Sr&nbsp;No.</th>
                                                                <th>Username</th>
                                                                <th>Firstname</th>
                                                                <th>Lastname</th>
                                                                <th>Email</th>
                                                                <th>Subscription</th>
                                                                <th>Details</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT * FROM users WHERE role =3");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
	                                                                    $id = $row["id"];
	                                                                    
                                                                        $check = $con->prepare("SELECT * FROM subscription WHERE learner_id=$id");
                                                                        $check->execute();
                                                                        $check_row = $check->fetch(PDO::FETCH_ASSOC);
                                                                        if($check->rowCount() == 1)
                                                                        {
	                                                                        $today = date('Y-m-d');
                                                                            if ($check_row['sub_start'] <= $today && $check_row['sub_end'] >= $today)
                                                                            {
	                                                                            $show = "<span class='text-success'>Active</span>";
                                                                            }
                                                                            else
                                                                            {
	                                                                            $show = "<span class='text-danger'>Expired</span>";
                                                                            }
                                                                        }
                                                                        else
                                                                        {
	                                                                        $show = "<span class='text-danger'>Not Subscribed</span>";
                                                                        }
                                                                        
                                                                        $c++;
                                                                    echo "<tr><td>$c
                                                                        </td><td>".$row["username"].
                                                                        "</td><td>".$row["firstName"].
                                                                        "</td><td>".$row["lastName"].
	                                                                    "</td><td>".$row["email"].
                                                                        "</td><td>".$show.
                                                                        "</td><td>".
                                                                        
                                                                        "<a href='learner.php?user=$row[id]' style='margin-bottom:5px;' class='btn btn-primary'>
                                                                        <i class='fas fa-eye'></i>
                                                                        </a>"."</td><td>".
                                                                        "<a href='delete.php?user=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a></td></tr>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No  Users Found in Db </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog"  aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update User Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="update.php" method="POST">
                                                                    <div class="form-group">
                                                                        <label>Username</label>
                                                                        <input type="text" class="form-control"   id="username" name="username"  placeholder="Enter Username" required>
                                                                    </div>
                                                                        <input type="hidden"   id="adminid" name="adminid">

                                                                    <div class="form-group">
                                                                        <label>First Name</label>
                                                                        <input type="text" class="form-control" id="fname"  name="fname" placeholder="Enter Firstname" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Last Name</label>
                                                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Lastname" required>
                                                                    </div>



                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Email address</label>
                                                                        <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email" required>
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="update-user" class="btn btn-primary">Update</button>
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

      $('#fname').val(data[2]);
      $('#lname').val(data[3]);
      $('#username').val(data[1]);
      $('#email').val(data[4]);
      $('#adminid').val(data[5]);



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
