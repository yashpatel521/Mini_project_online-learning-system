<?php
require_once("include/header.php");
$account = new Account($con);
if(isset($_POST["submit"])) {
    $ctname =  $_POST["category"];
    if(!is_numeric($ctname)){
        $query = $con->prepare("SELECT * FROM categories WHERE name = '$ctname'");
       $filename= $_FILES["photo"]["name"];
       $tempname= $_FILES["photo"]["tmp_name"];

       $folder = "../entities/thumbnails/category/".$filename;
       $folder_q = "entities/thumbnails/category/".$filename;
       move_uploaded_file($tempname,$folder);

        $query->execute();
            if($query->rowCount() != 0){
                echo "<script>
                window.alert('Category Name is Alredy Exits');
                window.location.assign('add-categories.php');
                </script>";
            }
            else{
                $insert = $con->prepare("INSERT INTO categories (name , img) VALUES ('$ctname' , '$folder_q' )");
                $insert->execute();
                if($insert) {
                    echo "<script>
                    window.alert('Category Add successfully');
                    </script>";
                }
                else{
                    echo "<script>
                    window.alert('Somthing is wrong');
                    window.location.assign('add-categories.php');
                    </script>";}
            }
        }
    else{
        echo "<script>
                window.alert('Category Name is not Valid');
                window.location.assign('add-categories.php');
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
 document.getElementById("output_image").style.display = "";

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
                    <h3 class="text-dark mb-4">Category</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="add-categories.php">Add Category<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="update-category.php">Show Category</a>
                                                </li>


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Add Category</p>
                                        </div>
                                        <div class="card-body">
                                            <form  method="post" enctype="multipart/form-data">

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="first_name">
                                                                <strong>Category Name</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Category Name" name="category" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label><strong>Category Image</strong></label>
                                                            <input type="file" class="form-control" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <img id="output_image"  width="500px" height="200px" style="display:none;"  />
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
