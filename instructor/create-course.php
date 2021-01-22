<?php
require_once("include/header.php");
if(isset($_POST["submit"])) {
    $en =  $_POST["Entities"];
    $ct =  $_POST["ct"];
    $instructor = $ins_id;
    $short_des =  $_POST["short_des"];
    $long_des =  $_POST["long_des"];
    $time =  $_POST["duration"];
    $lan =  $_POST["language"];
    $overview =  $_POST["overview"];
    $requirment =  $_POST["requirment"];
    // for image
    $filename= $_FILES["photo"]["name"];
    $tempname= $_FILES["photo"]["tmp_name"];
    $folder = "../entities/thumbnails/".$filename;
    $folder_q = "entities/thumbnails/".$filename;
    move_uploaded_file($tempname,$folder);
    $query = $con->prepare("INSERT INTO entities (name,categoryId,thumbnail,teacherid,short_des,long_des,duration,language,overview,requirmnet)
    VALUES ('$en','$ct','$folder_q','$instructor',:short_des,
    :long_des,'$time','$lan',:overview,:requirment)");
     $query->bindParam(':requirment', $requirment);
     $query->bindParam(':long_des', $long_des);
     $query->bindParam(':overview', $overview);
     $query->bindParam(':short_des', $short_des);
$entities = $query->execute();
    // for preview
    $filename= $_FILES["video_p"]["name"];
    $tempname= $_FILES["video_p"]["tmp_name"];
    $folder= "../entities/preview/".$filename;
    $folder_q = "entities/preview/".$filename;
    move_uploaded_file($tempname,$folder);
    // for video
    $filename_v= $_FILES["video"]["name"];
    $tempname_v= $_FILES["video"]["tmp_name"];
    $folder_v = "../entities/video/".$filename;
    $folder_q_v = "entities/video/".$filename;
    move_uploaded_file($tempname_v,$folder_v);

   
    $query = $con->prepare("SELECT * FROM entities WHERE name = '$en' ");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $en_id = $row['id'];
    $query = $con->prepare("INSERT INTO videos (previewvideo,mainvideo,entityId )
                            VALUES ('$folder_q','$folder_q_v','$en_id')");
    $vid=$query->execute();
    if($query && $vid){
        echo "<script>alert('course Uploaded');</script>";
        // header("Location: update-category.php");

    }
    else{
        echo "<script>alert('course not uploaded');</script>";
    }

  }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<script type='text/javascript'>
function preview_image(event)
{
 var reader = new FileReader();
 document.getElementById("output_image").style.display = "";
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
function preview_video_p(event)
{
 var reader = new FileReader();
 document.getElementById("output_video_p").style.display = "";
 reader.onload = function()
 {
  var output = document.getElementById('output_video_p');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
function preview_video(event)
{
 var reader = new FileReader();
 document.getElementById("output_video").style.display = "";
 reader.onload = function()
 {
  var output = document.getElementById('output_video');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
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
                                    <li class="breadcrumb-item text-muted active" aria-current="page">create-course</li>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create Course</h4>
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-primary">Course name </label>
                                                    <input class="form-control" data-toggle="tooltip" data-placement="bottom" title="Course Name" type="text" placeholder="Course Name" name="Entities" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-primary">Category</label>
                                                    <select class="form-control" name="ct" data-toggle="tooltip" data-placement="bottom" title="Category">
                                                        <option selected disabled>-----Select Category-----</option>
                                                        <?php
                                                               $query = $con->prepare("SELECT * FROM categories");
                                                               $query->execute();
                                                               if ($query->rowCount() != 0) {
                                                                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                    $id=$row['id'];
                                                                        echo "<option value='$id'>".$row['name']."</option>";
                                                                    }

                                                                }
                                                        ?>
                                                    </select>                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <input name="instructor"  type="hidden"  value="<?php echo $ins_id;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-primary">Enter Short Description</label>
                                                    <textarea class="form-control" name="short_des" rows="3" placeholder="Short Description" data-toggle="tooltip" data-placement="bottom" title="Short Description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-primary">Enter Long Description</label>
                                                    <textarea class="form-control" name="long_des" rows="5" placeholder="Long Description" data-toggle="tooltip" data-placement="bottom" title="Long Description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-primary">Duration</label>
                                                    <input name="duration" class="form-control" type="time" data-toggle="tooltip" data-placement="bottom" title="Duration" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-primary">language</label>
                                                    <input name="language" class="form-control" type="text" placeholder="Enter Course language" data-toggle="tooltip" data-placement="bottom" title="language" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-primary">Enter Overview of Course</label>
                                                    <textarea class="form-control" name="overview" rows="4" placeholder="Overview of Course" data-toggle="tooltip" data-placement="bottom" title="Overview of Course"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-primary">Enter Requirments of Course</label>
                                                    <textarea class="form-control" name="requirment" rows="4" placeholder="Requirments of Course" data-toggle="tooltip" data-placement="bottom" title="Requirments of Course"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-primary">Course Thubmnail</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)" required>
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <img id="output_image"  width="200px" height="100px" style="display:none;" style="border-image:none;"  />
                                                </div>  
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-primary">Course Preview</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id ="video_p"  name="video_p" accept="video/*"  onchange="preview_video_p(event)" required>
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <video id="output_video_p" width="200px" height="100px" style="display:none;" controls>
                                                                </video>                                                </div>  
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-primary">Course video</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id ="video"  name="video" accept="video/*"  onchange="preview_video(event)"  required>
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <video id="output_video" width="200px" height="100px"  controls  style="display:none;">
                                                                </video>                                                </div>  
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info" name="submit">Submit</button>
                                        </div>
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
    <?php require_once("include/class/script.php"); ?>
</body>
</html>