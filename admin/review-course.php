<?php
require_once("include/header.php");

if($_GET['course']){
    $enId=$_GET['course'];
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
                                    
                                    </div>
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Review Course</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>
                                                                <strong>Course Name</strong>
                                                            </label>
                                                            <input class="form-control" type="text" readonly placeholder="Entities Name" name="Entities" value="<?php echo $en;?>" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Category</strong>
                                                            </label>
                                                            <select name="ct" class="form-control" readonly required>

                                                            <?php
                                                             echo "<option selected value='$ct'>".$ct_name."</option>";
                                                            
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label  ><strong>Instructor</strong>
                                                            </label>
                                                            <select name="instructor" class="form-control" readonly required>

                                                            <?php
                                                            echo "<option selected value='$instuctor'>".$ins_name."</option>";
                                                               
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Enter Short Description</strong>
                                                            </label>
                                                            <textarea readonly name="short_des" class="form-control" rows="3" ><?php echo $short_des;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Enter Long Description</strong>
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
                                                            <input name="language" readonly class="form-control" type="text" placeholder="Enter Course language"  value="<?php echo $language;?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Enter Overview of Course</strong>
                                                            </label>
                                                            <textarea name="overview" readonly class="form-control" rows="3" ><?php echo $overview;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Enter Requirments of Course</strong>
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
                                                        <input name="defult_img"  type="hidden"  value="<?php echo $imgs;?>">
                                                        <div class="form-group">

                                                            <img id="output_image" src="../<?php echo $imgs;?>" width="200px" height="100px" style="border-image:none;" alt="<?php echo $imgs;?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
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
                                               
                                            </form>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
