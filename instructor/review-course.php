<?php
require_once("include/header.php");

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.21/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php require_once("include/topbar.php"); ?>
        <?php require_once("include/sidebar.php"); ?>
     
        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">COURSES</h2>
                    <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item "><a href="index.php" class="text-primary">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Pending-course</li>
                                </ol>
                            </nav>
                        </div>
                      
                        <div class="d-flex align-items-center">
                            <br>
                        </div>

                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                        <?php require_once("include/time.php");?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php
                                $query = $con->prepare("SELECT * FROM entities WHERE teacherid = '$ins_id' and status = 0  ");
                                $query->execute();
                                $c=0;
                                if ($query->rowCount() > 0) {
                                    echo " <div class='card'>
                                    <div class='card-body'>
                                        <div class='d-flex align-items-center mb-4'>
                                            <h4 class='card-title text-capitalize'>Pending for Activation Courses</h4>
                                        </div>
                                        <div class='table-responsive table-striped'>
                                                
                                                    <table class='table  no-wrap v-middle mb-0'>
                                                        <thead class=' text-white' style='background-color: rgba(95, 118, 232, 1);'>
                                                            <tr class='border-0'>
                                                                <th class='border-0 font-14 font-weight-medium text-center'>Sr no.</th>
                                                                <th class='border-0 font-14 font-weight-medium text-center'>Course Name</th>
                                                                <th class='border-0 font-14 font-weight-medium text-center'>Thumbnail</th>
                                                                <th class='border-0 font-14 font-weight-medium text-center'>Category</th>
                                                              
                                                                <th class='border-0 font-14 font-weight-medium text-center'>update</th>
                                                                <th class='border-0 font-14 font-weight-medium text-center'>delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class='table-striped'>";
                                                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                            $id = $row["id"];
                                                            $img = $row["thumbnail"];
                                                            $ct = $row["categoryId"];
                                                            $ct_query = $con->prepare("SELECT * FROM categories WHERE id = '$ct' ");
                                                            $ct_query->execute();
                                                            $ct_row = $ct_query->fetch(PDO::FETCH_ASSOC);
                                                            $ct_name = $ct_row["name"];
                                                            $c++;
                                                        echo "<tr>
                                                                <td>$c</td>
                                                                <td class='text-dark text-center'>".$row["name"]."</td>
                                                                <td class='text-center'><img src='../$img' style='  border-radius: 10px;  height: 100px; width: 200px;'> </td>
                                                                <td class='text-center text-dark  '>$ct_name</td>
                                                                
                                                                <td class='text-center'>
                                                                    <a href='update-course.php?entities=$row[id]' style='margin-bottom:5px;' class='btn btn-success'><i class='fas fa-edit'></i></a>
                                                                </td>
                                                                <td class='text-center'>
                                                                    <a href='delete.php?entities=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'><i class='fas fa-trash'></i></a>
                                                                </td>
                                                            </tr>";
                                    }
                                }
                                else{
                                    echo "<h1 class='text-danger'>Something wants wrong</h3>";
                                }
                            ?>    
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>  
    <script type="text/javascript">
    $(document).ready(function(){
    $('table').DataTable({
        ordering:false
    });
    });
</script>
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/app-style-switcher.js"></script>
<script src="dist/js/feather.min.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="dist/js/custom.min.js"></script>
<script src="assets/extra-libs/c3/d3.min.js"></script>
<script src="assets/extra-libs/c3/c3.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="dist/js/pages/dashboards/dashboard1.min.js"></script>    
</body>
</html>