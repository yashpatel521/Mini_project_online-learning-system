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
                    <h3 class="text-dark mb-4">Instructor</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                
                                                
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="show-instructor.php">Show Instructor<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item ">
                                                    <a class="nav-link" href="activate-instructor.php">Pending Instructor</span></a>
                                                </li>

                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Instructor Details</p>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="card-body">
                                               
                                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table  table-hover  my-0"  id="dataTable">
                                                        <thead >
                                                            <tr class="table-active">
                                                                <th>Sr&nbsp;No.</th>
                                                                <th>Username</th>
                                                                <th>Firstname</th>
                                                                <th>Lastname</th>
                                                                <th>Email</th>
                                                                <th>Detail</th>
                                                                <th>Update</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT * FROM instructor WHERE status = 1");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $id = $row["id"];
                                                                        $user_id = $row["user_id"];
                                                                        $user_query = $con->prepare("SELECT * FROM users WHERE id = $user_id AND role = 2");
                                                                        $user_query->execute();
                                                                        $user_row = $user_query->fetch(PDO::FETCH_ASSOC);

                                                                        $status = $row["status"];
                                                                        $c++;
                                                                    echo "
                                                                    <tr><td>$c</td>
                                                                    <td>".$user_row["username"].
                                                                    "</td><td>".$user_row["firstName"].
                                                                    "</td><td>".$user_row["lastName"].
                                                                    "</td><td>".$user_row["email"].
                                                                    "</td><td>"."<a href='instructordetails.php?instructor=$row[user_id]' style='margin-bottom:5px;' class='btn btn-primary'>
                                                                        <i class='fas fa-eye'></i>
                                                                        </a>".

                                                                        "</td><td>".
                                                                        "<a href='update.php?instructor=$user_id' style='margin-bottom:5px;' class='btn btn-success'>
                                                                        DeActivate
                                                                        </a></td><td>".
                                                                        "<a href='delete.php?instructor=$user_id' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No  Instructor Found in Db </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    
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
