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
        $enroll = $row["student_en"];
        $imgs = $row["thumbnail"];
        $ct = $row["categoryId"];
        $short_des = $row["short_des"];
        $long_des = $row["long_des"];
        $instuctor = $row["teacherid"];
        $time = $row["duration"];
        $language = $row["language"];
        $overview = $row["overview"];
        $requirmnet = $row["requirmnet"];
        $status = $row["status"];
        $ct_query = $con->prepare("SELECT * FROM categories WHERE id = '$ct' ");
        $ct_query->execute();
        $ct_row = $ct_query->fetch(PDO::FETCH_ASSOC);
        $ct_name = $ct_row["name"];
        $instuctor = $row["teacherid"];
        $ins_query = $con->prepare("SELECT users.firstName AS fname , users.lastName AS lname ,instructor.user_id as u_id
                    from users JOIN instructor ON users.id = instructor.user_id WHERE instructor.id = $instuctor");
                    $ins_query->execute();
                    $ins_row = $ins_query->fetch(PDO::FETCH_ASSOC);
                    $ins_id =0;
                    $u_id = $ins_row["u_id"];
                    $ins_name = $ins_row["fname"]." ".$ins_row["lname"];

                    $query = $con->prepare("SELECT * FROM videos WHERE entityid = $enId ");
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    $p_video = $row['previewvideo'];
                    $video = $row['mainvideo'];
    }
    else{
        header("Location: show-entities.php");
        exit("");

    }
}
else{
    header("Location: show-entities.php");
    exit("");
}
?>

<?php
require_once("include/header.php");

?>
<!DOCTYPE html>
<html>
<head>
<script type='text/javascript'>
function preview_image(event)
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php require_once("include/sidebar.php");?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once("include/topbar.php");?>

                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Courses</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                <div class="col-2">
                                <!-- <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div> -->
                                    </div>
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Course Details</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="update.php" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>
                                                                <strong>Course Name</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Entities Name" name="Entities" readonly value="<?php echo $en;?>" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Category</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Entities Name" name="Entities" readonly value="<?php echo $ct_name;?>" required>

                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label  ><strong>Instructor</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Entities Name" readonly value="<?php echo $ins_name    ;?>" required>

                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong> Short Description</strong>
                                                            </label>
                                                            <textarea name="short_des" readonly class="form-control" rows="3" ><?php echo $short_des;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong> Long Description</strong>
                                                            </label>
                                                            <textarea name="long_des" readonly class="form-control" rows="5" ><?php echo $long_des;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Duration</strong>
                                                            </label>
                                                            <input name="duration" readonly class="form-control" type="time"  value="<?php echo $time;?>" required>
                                                        </div>
                                                    </div>
                                                    <input name="id"  type="hidden"  value="<?php echo $enId;?>">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>language</strong>
                                                            </label>
                                                            <input name="language" readonly class="form-control" type="text" placeholder=" Course language"  value="<?php echo $language;?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong> Overview of Course</strong>
                                                            </label>
                                                            <textarea name="overview" readonly class="form-control" rows="3" ><?php echo $overview;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong> Requirments of Course</strong>
                                                            </label>
                                                            <textarea name="requirment" readonly class="form-control" rows="5"  required><?php echo $requirmnet;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Course Image</strong></label>
                                                            <!-- <input type="file" class="form-control" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)"> -->
                                                        </div>
                                                        <!-- <input name="defult_img" readonly type="hidden"  value="<?php echo $imgs;?>"> -->
                                                        <div class="form-group">

                                                            <img id="output_image" src="<?php echo "../".$imgs;?>" width="200px" height="100px" style="border-image:none;" alt="<?php echo $imgs;?>" />
                                                        </div>
                                                    </div>
                                                </div><div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Course Preview</strong></label>
                                                            <!-- <input type="file" class="form-control" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)"> -->
                                                        </div>
                                                        <div class="form-group">

                                                        <video  width="200px" height="100px" src="../<?php echo $p_video;?>" controls  >
                                                                </video>                                                           </div>
                                                    </div>
                                                </div> 
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Course video</strong></label>
                                                            <!-- <input type="file" class="form-control" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)"> -->
                                                        </div>
                                                        <div class="form-group">

                                                        <video  width="200px" height="100px" src="../<?php echo $video;?>" controls  >
                                                                </video>                                                           </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Status</strong>
                                                            </label>
                                                            <select name="status" class="form-control"  required>
                                                            <?php
                                                                echo "<option selected value='1'>Active</option>";
                                                                echo "<option  value='0'>Deactive</option>";
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    </div>
                                                <div class="form-group"><button class="btn btn-primary btn-sm" name="update-en" type="submit">Submit</button></div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">About Course</p>
                                        </div>                                   
                                        <div class="card-body">
                                            <label ><strong>Course Rating:</strong></label>
                                            <div class="col">
                                                <div class="container">
                                                    <div class="row">
                                                        <?php
                                                            $query = $con->prepare("SELECT AVG(course_rate) as c_avg FROM feedback WHERE course_id = $enId ");
                                                            $query->execute();
                                                            $row = $query->fetch(PDO::FETCH_ASSOC);
                                                            $c_avg = $row['c_avg'];
                                                        for($i=0;$i<$c_avg;$i++){
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
                                                   
                                                </div>
                                            </div>
                                            <br>
                                            <?php
                                            $query = $con->prepare("SELECT COUNT(videoprogress.learner_id) as e_total FROM videoprogress 
                                            JOIN videos ON videos.id = videoprogress.video_id 
                                            WHERE videos.entityId = $enId");
                                            $query->execute();
                                            $row = $query->fetch(PDO::FETCH_ASSOC);

                                            $e_total = $row['e_total'];
                                            ?>
                                            <label ><strong>Total Student Enrolled</strong></label>
                                            <input class="form-control bg-white" type="text" readonly value="<?php echo $e_total;?>">

                                            <br>
                                            <label ><strong>Total Student Completed Course</strong></label>
                                            <?php
                                            $query = $con->prepare("SELECT COUNT(videoprogress.learner_id) as c_total FROM videoprogress 
                                            JOIN videos ON videos.id = videoprogress.video_id 
                                            WHERE videos.entityId = $enId AND 
                                            (videoprogress.progress = 100 OR videoprogress.finished = 1)");
                                            $query->execute();
                                            $row = $query->fetch(PDO::FETCH_ASSOC);

                                            $c_total = $row['c_total'];

                                            ?>
                                            <input class="form-control bg-white" type="text"  disabled value="<?php echo $c_total;?>">
                                            <br>
                                                                           <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div>

                                        </div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>