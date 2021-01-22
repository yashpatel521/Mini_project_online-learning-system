<?php require_once("include/header.php");?>

<!DOCTYPE html>
<html>
<body id="page-top">
    <div id="wrapper">
        <?php require_once("include/sidebar.php");?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once("include/topbar.php");?>
                <div class='card  rounded mx-5 my-5' style="box-shadow: 0 .15rem 1.75rem 0 rgba(63, 114, 191, 0.2)!important;">
                    <div class='card-body'>
                        <div class="container-fluid">
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <h3 class="text-dark mb-0">Dashboard</h3>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow-lg border-left-primary py-2" style="box-shadow: 0 .15rem 1.75rem 0 rgba(63, 114, 191, 0.3)!important;">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                        <span>Total Admin</span></div>
                                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM users WHERE role = 1");
                                                        $query->execute();
                                                        $admin = $query->rowCount();
                                                        ?>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $admin; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-user-edit fa-2x text-primary"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow-lg border-left-success py-2" style="box-shadow: 0 .15rem 1.75rem 0 rgba(71, 178, 81, 0.3)!important;">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                                        <span>Total students</span></div>
                                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM users WHERE role = 3");
                                                        $query->execute();
                                                        $students = $query->rowCount();
                                                        ?>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $students; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-users fa-2x text-success"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow-lg border-left-secondary py-2">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1">
                                                        <span>Total Instructor</span></div>
                                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM users WHERE role = 2");
                                                        $query->execute();
                                                        $instructor = $query->rowCount();
                                                        ?>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $instructor; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-chalkboard-teacher fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow-lg border-left-warning py-2"  style="box-shadow: 0 .15rem 1.65rem 0 rgba(246, 194, 62, 0.3)!important;">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1">
                                                        <span>Total categories</span></div>
                                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM categories");
                                                        $query->execute();
                                                        $ct = $query->rowCount();
                                                        ?>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $ct; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-align-justify fa-2x text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow-lg border-left-danger py-2" style="box-shadow: 0 .15rem 1.65rem 0 rgba(183 ,90 ,81, 0.3)!important;">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-danger font-weight-bold text-xs mb-1">
                                                        <span>Total Course</span></div>
                                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM entities");
                                                        $query->execute();
                                                        $entities = $query->rowCount();
                                                        ?>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $entities; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-tags fa-2x text-danger"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 col-xl-3 mb-4">
                                    <div class="card shadow-lg border-left-info py-2" style="box-shadow: 0 .15rem 1.65rem 0 rgba(98, 197, 212, 0.3)!important;">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1">
                                                        <span>Total Videos</span></div>
                                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM videos");
                                                        $query->execute();
                                                        $video = $query->rowCount();
                                                        ?>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $video; ?></span></div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-video fa-2x text-info"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class='card shadow rounded mx-5 my-5' >
                        <div class='card-body'>
                        <div class='container-fluid'>
                        <div class='d-sm-flex justify-content-between align-items-center mb-4'>
                            <h3 class='text-dark mb-0'>Pending For Reviews</h3>
                        </div><hr>
                        <div class="row">
                <?php
                    $query = $con->prepare("SELECT * FROM instructor WHERE status != 1");
                    $query->execute();
                    $activation_count = $query->rowCount();
                    if ($activation_count>0){
                        echo "
                            <div class='col-md-3 col-xl-3 mb-4'>
                                <div class='card shadow-lg border-left-primary py-2' style='box-shadow: 0 .15rem 1.75rem 0 rgba(63, 114, 191, 0.3)!important;'>
                                    <div class='card-body'>
                                        <div class='row align-items-center no-gutters'>
                                            <div class='col mr-2'>
                                                <div class='text-uppercase text-primary font-weight-bold text-xs mb-1'>
                                                    <span>Total Instructor Account</span></div>
                                                    
                                                <div class='text-dark font-weight-bold h5 mb-0'><span>$activation_count</span></div>
                                            </div>
                                            <div class='col-auto'><i class='fas fa-chalkboard-teacher fa-2x text-primary'></i></div>
                                        </div>
                                    </div>
                                </div>
                        
                    </div>";
                
                    }
                    else{
                        // echo "No Course or Instructor available for review";
                    }
                ?>
                <?php
                    $query = $con->prepare("SELECT * FROM entities WHERE status != 1");
                    $query->execute();
                    $activation_count = $query->rowCount();
                    if ($activation_count>0){
                        echo "
                        
                            <div class='col-md-3 col-xl-3 mb-4'>
                                <div class='card shadow-lg border-left-warning py-2' style='box-shadow: 0 .15rem 1.65rem 0 rgba(246, 194, 62, 0.3)!important;'>
                                    <div class='card-body'>
                                        <div class='row align-items-center no-gutters'>
                                            <div class='col mr-2'>
                                                <div class='text-uppercase text-warning font-weight-bold text-xs mb-1'>
                                                    <span>pending Course </span></div>
                                                    
                                                <div class='text-dark font-weight-bold h5 mb-0'><span>$activation_count</span></div>
                                            </div>
                                            <div class='col-auto'><i class='fas fa-tags fa-2x text-warning'></i></div>
                                        </div>
                                    </div>
                                </div>
                            
                            
                        
                    </div>";
                    }
                ?>
                </div>
                </div>

                    </div></div>
            </div>
        </div>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>