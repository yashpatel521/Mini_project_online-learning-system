<?php
require_once("include/header.php");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
                    <h3 class="text-dark mb-4">Category</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item ">
                                                    <a class="nav-link" href="add-categories.php">Add Category</a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="update-category.php">Show Category<span class="sr-only">(current)</span></a>
                                                </li>


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Categories Details</p>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="card-body">
                                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table  table-hover  my-0" id="dataTable">
                                                        <thead >
                                                            <tr class="table-active">
                                                                <th>Sr&nbsp;No.</th>
                                                                <th>Category Title</th>
                                                                <th>Thumbnail</th>
                                                                <th>Update</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT * FROM categories");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $id = $row["id"];
                                                                        $img = $row["img"];
                                                                        $c++;
                                                                    echo "<tr><td>$c
                                                                        </td><td>".$row["name"].
                                                                        "</td><td>"."<span style='display:none;'>$id</span><img src=../$img style='  border-radius: 10px;  height: 100px; width: 200px;'>".
                                                                        "</td><td>".
                                                                        "<span style='display:none;'>$id</span><button  class='btn btn-success editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                                <i class='fas fa-edit'></i>
                                                                        </button></td><td>".
                                                                        "<a href='delete.php?category=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No  data Found in Db </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update Category Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="update.php" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label>Category Name</label>
                                                                        <input type="text" class="form-control"   id="title" name="title"  placeholder="Enter Categories name"  required>
                                                                    </div>
                                                                    <input type="hidden"   id="ctid" name="ctid">

                                                                    <div class="form-group">
                                                                        <label>Update Thumbnails</label>
                                                                        <input type="file" class="form-control" id ="photo"  name="photo" accept="image/*"  onchange="preview_image(event)" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <img id="output_image" width="200px" height="100px" />

                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="update-ct" class="btn btn-primary">Update</button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>


    <script >
$(document).ready(function(){
  $('.editbtn').on('click',function(){
      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
            return $(this).text();
      }).get();
      console.log(data);

      $('#title').val(data[1]);
      $('#ctid').val(data[2]);
      $('#ctid').val(data[3]);
      
  });
});

</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>

</body>

</html>
