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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.21/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

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
                        <div class="col-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item ">
                                                    <a class="nav-link" href="add-Video.php">Add Course Video</a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="update-Video.php">Show Course Video<span class="sr-only">(current)</span></a>
                                                </li>


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Videos Details</p>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="card-body">

                                                </div>
                                                <div class="table-responsive table mt-2" >
                                                    <table class="table  table-hover  my-0" >
                                                        <thead >
                                                            <tr class="table-active">
                                                                <th>Sr&nbsp;No.</th>
                                                                <th style="width:20%;">Title</th>
                                                                <th style="width:20%;">Upload Date</th>
                                                                <th style="width:10%;">Course</th>
                                                                <th style="width:10%;">Views</th>
                                                                <th style="width:10%;">Video</th>
                                                                <th style="width:10%;">Update</th>
                                                                <th style="width:10%;">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT * FROM videos ");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $en = $row["entityId"];
                                                                        $en_query = $con->prepare("SELECT name FROM entities WHERE id = '$en' ");
                                                                        $en_query->execute();
                                                                        $enrow = $en_query->fetch(PDO::FETCH_ASSOC);
                                                                        $video = $row["filePath"];
                                                                        $c++;
                                                                    echo "<tr>
                                                                        <td>$c</td>
                                                                        <td>".$row["title"].
                                                                        "</td><td>".$row["uploadDate"].
                                                                        "</td><td>".$enrow["name"].
                                                                        "</td><td>".$row["views"].
                                                                        "</td><td><span style='display:none;'>$video</span> <video controls style='height: 100px;width: 200px;'><source src='../$video'>"
.
                                                                        "</video></td><td><span style='display:none;'>$row[id]</span><button  class='btn btn-success editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                        <i class='fas fa-edit'></i>
                                                                </button></td><td>".
                                                                        "<a href='delete.php?video=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a></td></tr>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='7' class='text-center'>No  video Found in Db </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update User Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="update.php" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label>Title</label>
                                                                        <input type="text" class="form-control"   id="title" name="title"  placeholder="Enter title"  required>
                                                                    </div>
                                                                        <input type="hidden"   id="videoid" name="videoid">

                                                                    <div class="form-group">
                                                                        <label>Entity</label>
                                                                        <select name="en" id="en" class="form-control"  required>


                                                            <?php
                                                               $query = $con->prepare("SELECT * FROM entities");
                                                               $query->execute();
                                                               if ($query->rowCount() != 0) {
                                                                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                    $id=$row['id'];
                                                                    $name = $row['name'];
                                                                        echo "<option value='$name'>".$row['name']."</option>";
                                                                    }

                                                                }
                                                            ?>
                                                            </select>                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Video File</label>
                                                                        <input type="file" class="form-control" id="video" name="video" >
                                                                    </div>




                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="update-video" class="btn btn-primary">Update</button>
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


    <script type="text/javascript">
    $(document).ready(function(){
    $('table').DataTable({
        ordering:false
    });
    });
</script>

<script >
$(document).ready(function(){
  $('.editbtn').on('click',function(){
      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
            return $(this).text();
      }).get();

      $('#title').val(data[1]);
      $('#en').val(data[3]);

    $('#videoid').val(data[6]);



  });
});

</script>
     <!-- <script src="assets/js/jquery.min.js"></script> -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>

</body>

</html>
