<?php
require_once("include/header.php");
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
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
                    <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h2>
                    <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item "><a href="../entities/thumbnails/" class="text-primary">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
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
                    <div class="card-group">
                        <div class="card shadow-lg border-left-primary border-right mr-3" style="box-shadow: 0 .15rem 1.75rem 0 rgba(63, 114, 191, 0.3)!important;">
                            <div class="card-body">
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM entities JOIN instructor ON entities.teacherid = instructor.id WHERE instructor.user_id = $instructorLoggedInId");
                                                        $query->execute();
                                                        $course = $query->rowCount();
                                                        ?>
                                            <h2 class="text-primary mb-1 font-weight-medium"><?php echo $course; ?></h2>
                                            
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Uploaded Course</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0">
                                        <span class="text-muted"><i class="fas fa-book fa-3x text-primary"></i></span>
                                        <!-- <div class="col-auto"><i class="fas fa-book fa-2x text-primary"></i></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg border-left-success border-right mr-3"  style="box-shadow: 0 .15rem 1.75rem 0 rgba(71, 178, 81, 0.3)!important;">
                            <div class="card-body">
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                    <?php 
                                                        $query = $con->prepare("SELECT SUM(student_en) as view FROM entities JOIN instructor ON entities.teacherid = instructor.id WHERE instructor.user_id = $instructorLoggedInId");
                                                        $query->execute();
                                                        $row = $query->fetch(PDO::FETCH_ASSOC);
                                                        
                                                        $totalview = $row["view"];
                                                        if($totalview<=0 or $totalview == null){
                                                             $totalview = 0;
                                                        }
                                                        ?>
                                        <h2 class="text-success mb-1 w-100 text-truncate font-weight-medium"><?php echo $totalview; ?></h2>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Enroll students
                                        </h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted"><i class="fas fa-users fa-3x text-success"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg border-left-warning py-2 border-right mr-3" style="box-shadow: 0 .15rem 1.65rem 0 rgba(246, 194, 62, 0.3)!important;">
                            <div class="card-body">
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                        <?php 
                                                        $query = $con->prepare("SELECT * FROM entities  JOIN instructor ON entities.teacherid = instructor.id
                                                                             WHERE instructor.user_id = $instructorLoggedInId AND entities.status = 0");
                                                        $query->execute();
                                                        $pandding = $query->rowCount();
                                                        ?>
                                            <h2 class="text-warning mb-1 font-weight-medium"><?php echo $pandding;?></h2>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pending Course For Activate</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0">
                                        <span class="text-warning"><i class="fas fa-3x fa-low-vision"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg border-left-danger py-2 mr-3" style="box-shadow: 0 .15rem 1.65rem 0 rgba(183 ,90 ,81, 0.3)!important;">
                            <div class="card-body">
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                    <?php
                                        $query = $con->prepare("SELECT TRUNCATE(AVG(ins_rate),1) as c_avg FROM feedback WHERE teacher_id=(SELECT user_id FROM instructor WHERE id = $ins_id)");
                                        $query->execute();
                                        $row = $query->fetch(PDO::FETCH_ASSOC);
                                        $rating = $row['c_avg'];
                                        $r_count=$query->rowCount();
                                        if($rating == null)
                                        {
                                            $rating = "-";
                                        }
                                    ?>
                                        <h2 class="text-cyan mb-1 font-weight-medium"><?php echo $rating;?></h2>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Rating</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0">

                                    <span class="text-cyan"><i class="fas fa-3x fa-star"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                        
                                        
                                <?php
                                    $counter = 1;
                                    $query = $con->prepare("SELECT COUNT(id) AS total, categoryId
                                    FROM entities  WHERE teacherId = '$ins_id'
                                    GROUP BY categoryId;");
                                    $query->execute();
                                    if ($query->rowCount() > 0) {
                                        echo " <div class='card'>
                                        <div class='card-body'>
                                            <div class='d-flex align-items-center mb-4'>
                                                <h4 class='card-title'>Total Category Uploaded Courses</h4>
                                            </div>
                                            <div class='table-responsive table-striped'>
                                                    
                                                        <table class='table  no-wrap v-middle mb-0'>
                                                            <thead class=' bg-info text-white'>
                                                                <tr class='border-0'>
                                                                    <th class='border-0 font-14 font-weight-medium  text-center'>Sr no.
                                                                    </th>
                                                                    <th class='border-0 font-14 font-weight-medium  text-center'>Category Name
                                                                    </th>
                                                                    <th class='border-0 font-14 font-weight-medium  text-center'>Total Courses</th>
                                                                    <th class='border-0 font-14 font-weight-medium  text-center'>Student Enrolled</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class='table-striped'>";
                                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            $ctid = $row["categoryId"];
                                            $totalcourse = $row["total"];
                                        $c_query = $con->prepare("SELECT * FROM categories where id = '$ctid'");
                                        $c_query->execute();
                                        $c_row = $c_query->fetch(PDO::FETCH_ASSOC);
                                        $ct_name = $c_row["name"];
                                        
                                        $view = $con->prepare("SELECT SUM(student_en) as view FROM entities where 
                                                            teacherId = $ins_id 
                                                            AND categoryId = '$ctid' AND teacherId = '$ins_id' ");
                                        $view->execute();
                                        $view_row = $view->fetch(PDO::FETCH_ASSOC);
                                        $student = $view_row["view"];
                                        $percentage = round(($totalcourse / $course)*100);
                                                            echo "<tr>
                                                                    <td class='border-top-0 text-center text-dark'>
                                                                        
                                                                        $counter
                                                                    </td>
                                                                    <td class='border-top-0 text-dark font-14 text-center'>$ct_name</td>
                                                                    <td class='border-top-0 text-left font-weight-medium text-center text-dark'>
                                                                    $totalcourse </td>
                                                                    <td class='border-top-0 text-center font-weight-medium text-dark'>
                                                                        $student
                                                                    </td>
                                                                   
                                                                </tr>

                                                    
                                            ";
                                        $counter += 1;
                                        }
                                        echo "<tr class='table-primary'><td  class='border-top-0 text-center font-weight-medium text-primary'>Total</td>
                                        <td  class='border-top-0 text-center font-weight-medium text-primary'>-</td>
                                        <td class='border-top-0 text-center font-weight-medium text-primary'>$course</td>
                                        <td  class='border-top-0 text-center font-weight-medium text-primary'>$totalview</td>
                                        
                                        </tr></tbody></table></div></div></div>";
                                    }
                                    
                                ?>    
                                            
                        </div>
                    </div>                          
                </div>
            </div>
        </div>
    </div>  
    <?php require_once("include/class/script.php"); ?>
</body>
</html>