<?php
require_once("include/header.php");
if(isset($_POST["submit"])) {
    $en =  $_POST["Entities"];
    $ct =  $_POST["ct"];
    $instructor = 1;
    $short_des =  $_POST["short_des"];
    $long_des =  $_POST["long_des"];
    $time =  $_POST["duration"];
    $lan =  $_POST["language"];
    $overview =  $_POST["overview"];
    $requirment =  $_POST["requirment"];
        // echo $en ."<br>" .$ct ."<br>" .$instructor."<br>" .$short_des."<br>" .$long_des."<br>" .$time."<br>" .$lan."<br>" .$overview."<br>" .$requirment ;
        $filename= $_FILES["photo"]["name"];
        $tempname= $_FILES["photo"]["tmp_name"];

        $folder = "../entities/thumbnails/".$filename;
        $folder_q = "entities/thumbnails/".$filename;
        move_uploaded_file($tempname,$folder);

    $query = $con->prepare("INSERT INTO entities (name,categoryId,thumbnail,teacherid,short_des,long_des,duration,language,overview,requirmnet,status)
                        VALUES ('$en','$ct','$folder_q','$instructor',:short_des,
                        :long_des,'$time','$lan',:overview,:requirment,1)");
                        $query->bindParam(':requirment', $requirment);
                        $query->bindParam(':long_des', $long_des);
                        $query->bindParam(':overview', $overview);
                        $query->bindParam(':short_des', $short_des);
    $query->execute();

    if($query){
        echo "<script>alert('course upload');</script>";
        // header("Location: update-category.php");

    }
    else{
        echo "<script>alert('course not upload');</script>";
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
                    <h3 class="text-dark mb-4">Courses</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="add-entities.php">Add Course<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item ">
                                                    <a class="nav-link" href="activate-course.php">Activate Course</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="show-entities.php">Show Courses</a>
                                                </li>


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Add Course</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>
                                                                <strong>Course Name</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Course Name" name="Entities" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Category</strong>
                                                            </label>
                                                            <select name="ct" class="form-control"  required>
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
                                                    <!-- <div class="col">
                                                        <div class="form-group">
                                                            <label  for="email"><strong>Instructor</strong>
                                                            </label>
                                                            <select name="instructor" class="form-control"  required>
                                                            <option selected disabled>-----Select Instructor-----</option>

                                                            <?php
                                                            //    $query = $con->prepare("SELECT * FROM instructor");
                                                            //    $query->execute();
                                                            //    if ($query->rowCount() != 0) {
                                                            //     while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                            //         $id=$row['id'];
                                                            //             echo "<option value='$id'>".$row['firstname']." ".$row['lastname']."</option>";
                                                            //         }

                                                            //     }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Enter Short Description</strong>
                                                            </label>
                                                            <textarea name="short_des" class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Enter Long Description</strong>
                                                            </label>
                                                            <textarea name="long_des" class="form-control" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Duration</strong>
                                                            </label>
                                                            <input name="duration" class="form-control" type="time"  required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>language</strong>
                                                            </label>
                                                            <input name="language" class="form-control" type="text" placeholder="Enter Course language" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label ><strong>Enter Overview of Course</strong>
                                                            </label>
                                                            <textarea name="overview" class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Enter Requirments of Course</strong>
                                                            </label>
                                                            <textarea name="requirment" class="form-control" rows="5" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Entities Image</strong></label>
                                                            <input type="file" class="form-control" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <img id="output_image"  width="200px" height="100px" style="border-image:none;" alt="No File Selected For Priview Img" />
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
