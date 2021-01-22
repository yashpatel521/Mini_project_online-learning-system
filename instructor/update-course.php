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
                    <div class="form-group"><a href="javascript:javascript:history.go(-1)"><button class="btn btn-primary btn-sm">Back</button></a></div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $en;?></h3>
                                    <hr>
                                    <form  method="post" action="update.php" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Course name </label>
                                                        <input name="id"  type="hidden"  value="<?php echo $enId;?>">
                                                        <input class="form-control" type="text" placeholder="Course Name" name="Entities" value="<?php echo $en;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Category</label>
                                                        <select name="ct" class="form-control"  required>

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
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Short Description</label>
                                                        <textarea class="form-control" name="short_des" rows="3" placeholder="Short Description" ><?php echo $short_des;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Long Description</label>
                                                        <textarea class="form-control" name="long_des" rows="5" placeholder="Long Description"  title="Long Description"><?php echo $long_des;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Duration (HH:MM)</label>
                                                        <input name="duration" class="form-control" type="time" value="<?php echo $time_en;?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">language</label>
                                                        <input name="language" class="form-control" type="text" placeholder="Enter Course language" value="<?php echo $language;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Overview of Course</label>
                                                        <textarea class="form-control" name="overview" rows="4" placeholder="Overview of Course"><?php echo $overview;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Enter Requirments of Course</label>
                                                        <textarea class="form-control" name="requirment" rows="4" placeholder="Requirments of Course"><?php echo $requirmnet;?></textarea>
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
                                                                <input type="file" class="custom-file-input" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)" >
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                <input name="defult_img"  type="hidden"  value="<?php echo $imgs;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                            <img id="output_image" src="../<?php echo $imgs;?>" width="200px" height="100px" style="border-image:none;" alt="<?php echo $imgs;?>" />
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
                                                            <input type="file" class="custom-file-input" id ="video_p"  name="video_p" accept="video/*"  onchange="preview_video_p(event)" >
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            <input name="defult_pre"  type="hidden"  value="<?php echo $p_video;?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <video id="output_video_p" width="200px" height="100px" src="../<?php echo $p_video;?>" controls>
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
                                                            <input type="file" class="custom-file-input" id ="videos"  name="videos" accept="video/*"  onchange="preview_video(event)"  >
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            <input name="defult_video"  type="hidden"  value="<?php echo $video;?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <video id="output_video" width="200px" height="100px" src="../<?php echo $video;?>" controls  >
                                                                </video>                                                </div>  
                                            </div>  
                                        </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info" name="update-course">Submit</button>
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