<?php
require_once("include/header.php");

if($_GET['user']){
    $user_id = $_GET['user'];
    $query = $con->prepare("SELECT * FROM users WHERE id = $user_id AND role = 3");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $l_firstname = $row['firstName'];
    $l_lastname = $row['lastName'];
}
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
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
                    <h3 class="text-dark mb-4">Learner Details</h3>
                    <div class="row mb-3"> 
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Course Enrolled by <?php echo $l_firstname." ".$l_lastname; ?></p>
                                        </div>
                                        <div class="card-body">
                                        <div class="table-responsive table mt-2" style="overflow:hidden;" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table  table-hover  my-0"  id="dataTable">
                                                        <thead >
                                                            <tr class="table-active text-dark">
                                                                <th style="width:2%">Sr&nbsp;No.</th>
                                                                <th style="width:45%">Course Name</th>
                                                                <th>Progress</th>
                                                                <th style="width:5%">Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT entities.name as c_name ,videoprogress.progress as progress
                                                                                        ,videoprogress.learner_id,entities.id as c_id FROM entities 
                                                                                        JOIN videos on entities.id = videos.entityId 
                                                                                        JOIN videoprogress ON videos.id = videoprogress.video_id 
                                                                                        WHERE videoprogress.learner_id = $user_id AND (videoprogress.progress != 100)");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $progress = $row['progress'];
                                                                        $c_name = $row["c_name"];
                                                                        $c_id= $row["c_id"];
                                                                        $c++;
                                                                        echo "<tr><td>$c</td>
                                                                              <td>".$c_name.
                                                                              "</td><td>". 
                                                                              '<div class="progress">
                                                                              <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                                                              role="progressbar" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$progress.'%">'.$progress.'%</div>
                                                                                </div>'.
                                                                              "</td><td>".
                                                                              "<a href='update-entities.php?entities=$c_id' style='margin-bottom:5px;' class='btn btn-warning'>
                                                                                <i class='fas fa-eye'></i>
                                                                                </a></td></tr>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No Courses Enrolled  </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Course Completed by <?php echo $l_firstname." ".$l_lastname; ?></p>
                                        </div>
                                        <div class="card-body">
                                        <div class="table-responsive table mt-2" style="overflow:hidden;" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table  table-hover  my-0"  id="dataTable">
                                                        <thead >
                                                            <tr class="table-active text-dark">
                                                                <th>Sr&nbsp;No.</th>
                                                                <th>Course Name</th>
                                                                <th>Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT entities.name as c_name ,videoprogress.progress as progress
                                                                ,videoprogress.learner_id,entities.id as c_id FROM entities 
                                                                JOIN videos on entities.id = videos.entityId 
                                                                JOIN videoprogress ON videos.id = videoprogress.video_id 
                                                                WHERE videoprogress.learner_id = $user_id AND (videoprogress.progress = 100 OR videoprogress.finished = 1)");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $progress = $row['progress'];
                                                                        $c_name = $row["c_name"];
                                                                        $c_id= $row["c_id"];
                                                                        $c++;
                                                                        echo "<tr><td>$c</td>
                                                                        <td>".$c_name.
                                                                        
                                                                        "</td><td>".
                                                                        "<a href='update-entities.php?entities=$c_id' style='margin-bottom:5px;' class='btn btn-warning'>
                                                                          <i class='fas fa-eye'></i>
                                                                          </a></td></tr>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No Courses Complete </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div>

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
     <!-- <script src="assets/js/jquery.min.js"></script> -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>

</body>

</html>
