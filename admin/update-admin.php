<?php
require_once("include/header.php");

?>
<!DOCTYPE html>
<html>

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>
<body id="page-top">
    <div id="wrapper">
        <?php require_once("include/sidebar.php");?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once("include/topbar.php");?>

                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Admin</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="update-admin.php">Show Admins<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item ">
                                                    <a class="nav-link" href="add-admin.php">Add Admin</a>
                                                </li>
                                                


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Admins Details</p>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="card-body">
                                                <!-- <div class="row">
                                                    <div class="col-md-6 text-nowrap">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                                    </div>
                                                </div> -->
                                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table  table-hover  my-0"  id="dataTable">
                                                        <thead >
                                                            <tr class="table-active">
                                                                <th>Sr&nbsp;No.</th>
                                                                <th>Username</th>
                                                                <th>Firstname</th>
                                                                <th>Lastname</th>
                                                                <th>Email</th>
                                                                <!-- <th>Update</th> -->
                                                                <th>Delete</th>
                                                               

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                    //           "<span style='display:none;'>$id</span><button  class='btn btn-success editbtn' data-toggle='modal' data-target='#editmodal'>
                                                    //           <i class='fas fa-edit'></i>
                                                    //   </button></td><td>".
                                                                $query = $con->prepare("SELECT * FROM users WHERE role = 1");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $id = $row["id"];
                                                                        
                                                                        $c++;
                                                                    echo "
                                                                        <tr><td>$c</td>
                                                                        <td>".$row["username"].
                                                                        "</td><td>".$row["firstName"].
                                                                        "</td><td>".$row["lastName"].
                                                                        "</td><td>".$row["email"].
                                                                        // "</td><td>"."<img class='rounded-circle img-profile' style='height:60px;width:60px;' src=$imgs >".
                                                                        "</td><td>".
                                                                      
                                                                        "<a href='delete.php?admin=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a></td></tr>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No  Admin Found in Db </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update Admin Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="update.php" method="POST">
                                                                    <div class="form-group">
                                                                        <label>Username</label>
                                                                        <input type="text" class="form-control"   id="username" name="username"  placeholder="Enter Username"  required>
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
                                                                        <button type="submit" name="update-admin" class="btn btn-primary">Update</button>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>

</body>

</html>
