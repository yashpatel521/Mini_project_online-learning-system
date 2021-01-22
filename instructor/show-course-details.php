<?php
require_once("include/header.php");

if($_GET['entities']){
    $enId=$_GET['entities'];
    $query = $con->prepare("SELECT * FROM entities WHERE id = $enId ");
    $query->execute();
    if ($query->rowCount() == 1) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $en = $row["name"];
        $imgs = $row["thumbnail"];
        $ct = $row["categoryId"];
        $short_des = $row["short_des"];
        $long_des = $row["long_des"];
        $instuctor = $row["teacherid"];
        $time_en = $row["duration"];
       
        $language = $row["language"];
        $overview = $row["overview"];
        $requirmnet = $row["requirmnet"];
    
        $ct_query = $con->prepare("SELECT * FROM categories WHERE id = '$ct' ");
        $ct_query->execute();
        $ct_row = $ct_query->fetch(PDO::FETCH_ASSOC);
        $ct_name = $ct_row["name"];
        $instuctor = $row["teacherid"];
        $query = $con->prepare("SELECT * FROM videos WHERE entityId = $enId ");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $p_video = $row["previewvideo"];
        $video = $row["mainvideo"];
        

    }
    else{
        header("Location: update-course.php");
        exit("");

    }
}
else{
    header("Location: show-entities.php");
    exit("");
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>


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
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Edit-course</li>
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
                    <!-- <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div> -->

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $en;?></h3>
                                    <hr>
                                    <form  method="post">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Course name </label>
                                                        <input name="id"  type="hidden"  value="<?php echo $enId;?>">
                                                        <input class="form-control bg-white text-dark" type="text" placeholder="Course Name" name="Entities" disabled value="<?php echo $en;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Category</label>
                                                        <select name="ct" class="form-control bg-white text-dark" disabled required>

                                                            <?php
                                                             echo "<option selected value='$ct'>".$ct_name."</option>";
                                                               $query = $con->prepare("SELECT * FROM categories");
                                                               $query->execute();
                                                               if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                            $id=$row['id'];
                                                                            if( $id != $ct){
                                                                                echo "<option value='$id'>".$row['name']."</option>";
                                                                            }
                                                                        }
                                                                }
                                                            ?>
                                                            </select>                                               
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Course Rating</label>
                                                        <?php
                                                            $query = $con->prepare("SELECT TRUNCATE(AVG(course_rate),1) as c_avg FROM feedback WHERE course_id = $enId ");
                                                            $query->execute();
                                                            $row = $query->fetch(PDO::FETCH_ASSOC);
                                                            $rating = $row['c_avg'];
                                                            $r_count=$query->rowCount();
                                                            if($rating == null){
                                                                $rating = "-";
                                                            }
                                                        ?>
                                                        <input class="form-control bg-white text-dark" type="text"  disabled value="<?php echo $rating;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Total Student Enrolled</label>
                                                        <?php
                                                            $query = $con->prepare("SELECT videoprogress.learner_id FROM entities 
                                                            JOIN videos on entities.id = videos.entityId 
                                                            JOIN videoprogress ON videos.id = videoprogress.video_id 
                                                            WHERE entities.id = $enId GROUP by videoprogress.learner_id");
                                                            $query->execute();
                                                            $row = $query->fetch(PDO::FETCH_ASSOC);
                                                            $to_student = $query->rowCount();
                                                        ?>
                                                        <input class="form-control bg-white text-dark" type="text"  disabled value="<?php echo $to_student;?>" required>
                                      
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Total student Completed Course</label>
                                                        <?php
                                                            $query = $con->prepare("SELECT videoprogress.learner_id as c_id FROM entities 
                                                            JOIN videos on entities.id = videos.entityId 
                                                            JOIN videoprogress ON videos.id = videoprogress.video_id 
                                                            WHERE entities.id = $enId AND videoprogress.progress = 100 
                                                            GROUP by videoprogress.learner_id");
                                                            $query->execute();
                                                            $row = $query->fetch(PDO::FETCH_ASSOC);
                                                            $c_student = $query->rowCount();
                                                        ?>
                                                        <input class="form-control bg-white text-dark" type="text"  disabled value="<?php echo $c_student;?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Short Description</label>
                                                        <textarea class="form-control bg-white text-dark" disabled name="short_des" rows="3" placeholder="Short Description" ><?php echo $short_des;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Long Description</label>
                                                        <textarea class="form-control bg-white text-dark" disabled name="long_des" rows="5" placeholder="Long Description"  title="Long Description"><?php echo $long_des;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Duration (HH:MM)</label>
                                                        <input name="duration" disabled class="form-control bg-white text-dark" type="time" value="<?php echo $time_en;?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">language</label>
                                                        <input name="language" disabled class="form-control bg-white text-dark" type="text" placeholder="Enter Course language" value="<?php echo $language;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Overview of Course</label>
                                                        <textarea class="form-control bg-white text-dark" disabled name="overview" rows="4" placeholder="Overview of Course"><?php echo $overview;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Requirments of Course</label>
                                                        <textarea class="form-control bg-white text-dark" disabled name="requirment" rows="4" placeholder="Requirments of Course"><?php echo $requirmnet;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="text-primary">Course Thubmnail</label><br>
                                                            <img id="output_image" src="../<?php echo $imgs;?>" width="200px" height="100px" style="border-image:none;" alt="<?php echo $imgs;?>" />
                                                    </div>  
                                                </div>  
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-primary">Course Preview</label><br>
                                                        <video id="output_video_p" width="200px" height="100px" src="../<?php echo $p_video;?>" controls></video>    
                                                    </div>  
                                                </div>  
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-primary">Course Video</label><br>
                                                        <video id="output_video" width="200px" height="100px" src="../<?php echo $video;?>" controls  ></video>
                                                    </div>  
                                                </div>  
                                            </div>
                                            
                                        </div>
                                        
                                        </div>
                                        
                                    </form>
                                    <div class="form-actions">
                                            <div class="text-center">
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
    </div>  
    <?php require_once("include/class/script.php"); ?>   
</body>
</html>