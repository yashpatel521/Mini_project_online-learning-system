<?php
require_once("include/header.php");
if(isset($_POST["submit"])) {
    $videoname =  $_POST["title"];
    $enid =  $_POST["en"];

    if(!is_numeric($videoname)){
       $query = $con->prepare("SELECT * FROM videos WHERE title = '$videoname'");
       $filename= $_FILES["video"]["name"];
       $tempname= $_FILES["video"]["tmp_name"];

       $folder = "../entities/videos/".$filename;
       $folder_q = "entities/videos/".$filename;
       move_uploaded_file($tempname,$folder);

        $query->execute();
            if($query->rowCount() != 0){
                echo "<script>
                window.alert('Videos Name is Alredy Exits');
                window.location.assign('add-videos.php');
                </script>";
            }
            else{
                $insert = $con->prepare("INSERT INTO Videos (title , filePath , entityId ) VALUES ('$videoname' , '$folder_q', '$enid')");
                $insert->execute();
                if($insert) {
                    echo "<script>
                    window.alert('Videos Add successfully');
                    </script>";
                }
                else{
                    echo "<script>
                    window.alert('Somthing is wrong');
                    window.location.assign('add-Video.php');
                    </script>";}
            }
        }
    else{
        echo "<script>
                window.alert('Videos Name is not Valid');
                window.location.assign('add-Video.php');
                </script>";
    }
  }
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
                    <h3 class="text-dark mb-4">Course Videos</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="add-video.php">Add Course Video<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="update-video.php">Show Course Video</a>
                                                </li>


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Add Course Video</p>
                                        </div>
                                        <div class="card-body">
                                            <form  method="post" enctype="multipart/form-data">

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="first_name">
                                                                <strong>Video Title</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Video title" name="title" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Course</strong>
                                                            </label>
                                                            <select name="en" class="form-control"  required>
                                                            <option selected disabled>----- Select Course -----</option>

                                                            <?php
                                                               $query = $con->prepare("SELECT * FROM entities");
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
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Video File</strong></label>
                                                            <input type="file" class="form-control" id ="video"  name="video" accept="video/*"  onchange="preview_image(event)" required>
                                                        </div>
                                                        <div class="form-group">
                                                                <video id="output_image" width="200px" height="100px" autoplay controls>
                                                                </video>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><button class="btn btn-primary btn-sm" name="submit" type="submit">Submit</button></div>
                                            </form>
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
