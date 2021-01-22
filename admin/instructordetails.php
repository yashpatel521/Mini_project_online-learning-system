<?php
require_once("include/header.php");

if($_GET['instructor']){
    $user_id = $_GET['instructor'];
    $query = $con->prepare("SELECT * FROM instructor WHERE user_id = $user_id");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $ins_id= $row['id'];
    $ins_about = $row['about'];
    $ins_degree = $row['degree'];
    $ins_exp= $row['Experience'];
    $ins_uni = $row['university'];
    $resume = $row['resume'];
    $status = $row['status'];
    $query = $con->prepare("SELECT * FROM users WHERE id = $user_id AND role = 2");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $ins_firstname = $row['firstName'];
    $ins_lastname = $row['lastName'];
    $ins_username = $row['username'];
    $query = $con->prepare("SELECT AVG(ins_rate) AS rate FROM feedback WHERE teacher_id = (SELECT user_id FROM instructor WHERE id = $ins_id)");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $ins_rate = $row['rate'];
    
}

?>
<!DOCTYPE html>
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
                        <?php
                            if($status != 1){
                                echo '<div class="col-lg-12">';
                            }
                            else{
                                echo '<div class="col-lg-6">';
                            }
                        ?>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Instructor Details</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>
                                                                <strong>Instructor Username</strong>
                                                            </label>
                                                            <input class="form-control" readonly  value="<?php echo $ins_username;?>" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Firstname</strong>
                                                            </label>
                                                            <input class="form-control" readonly  value="<?php echo $ins_firstname;?>" required>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label  ><strong>Lastname</strong>
                                                            </label>
                                                            <input class="form-control" readonly  value="<?php echo $ins_lastname;?>" required>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Qualification</strong>
                                                            </label>
                                                            <textarea readonly class="form-control" rows="3" ><?php echo $ins_degree;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>University</strong>
                                                            </label>
                                                            <textarea  readonly class="form-control" rows="2" ><?php echo $ins_uni;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Experience</strong>
                                                            </label>
                                                            <input  readonly class="form-control" type="number"  value="<?php echo $ins_exp;?>" required>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>About Instructor</strong>
                                                            </label>
                                                            <textarea  readonly class="form-control" rows="3" ><?php echo $ins_about;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <iframe src="../<?php echo $resume;?>" frameborder="0" height="500px" width="100%"></iframe>                    
                                            </form>
                                            <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6" id="showing">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Instructor Rating (<?php echo round($ins_rate);?>/5)</p>
                                        </div>
                                        <div class="card-body">
                                        <div class="container">
                                                <div class="row">
                                                <?php
                                                // echo $ins_rate;
                                                   for($i=0;$i<$ins_rate;$i++){
                                                       //yellow star
                                                        echo '<div class="col-sm-2">
                                                        <img src="https://static4.depositphotos.com/1026550/376/i/600/depositphotos_3763236-stock-photo-gold-star.jpg" class="img-thumbnail" style="border:none;">
                                                        </div>';
                                                        
                                                    }

                                                    for($j=5-$i;$i<5;$i++){
                                                        //blank star
                                                        echo '<div class="col-sm-2">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Five-pointed_star.svg/1200px-Five-pointed_star.svg.png" class="img-thumbnail" style="border:none;">
                                                        </div>';
                                                        
                                                    }
                                                   
                                                ?>
                                                    
                                                </div>
                                                </div><br>
                                            <!-- <div class="form-group">
                                                <a href="javascript:javascript:history.go(-1)">
                                                    <button class="btn btn-primary btn-sm">Back</button>
                                                </a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Course Upload by <?php echo $ins_firstname." ".$ins_lastname; ?></p>
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
                                                                $query = $con->prepare("SELECT * FROM entities WHERE teacherid = $ins_id AND STATUS = 1");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $id = $row['id'];
                                                                        $c_name = $row["name"];
                                                                        
                                                                        $c++;
                                                                    echo "
                                                                        <tr><td>$c</td>
                                                                        <td>".$c_name.
                                                                        
                                                                        "</td><td>"."<a href='update-entities.php?entities=$id' style='margin-bottom:5px;' class='btn btn-warning'>
                                                                        <i class='fas fa-eye'></i>
                                                                        </a>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No Courses Found  </td></tr>";
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
                        <?php 
                            if($status != 1){
                                echo "<script>$status
                                var x = document.getElementById('showing');
                                x.style.display ='none';
                                </script>";
                            }
                        ?>
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
