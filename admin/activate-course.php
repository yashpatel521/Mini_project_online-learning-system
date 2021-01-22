<?php
require_once("include/header.php");

if(isset($_POST['send'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sender_id = $adminLoggedInId;
    $receiver_id = $_POST['insid'];
  
    $query = $con->prepare("INSERT INTO message (title,sender,receiver,isAdmin,Description)
                                                VALUES ('$title','$sender_id','$receiver_id',1,'$description')");
    $query->execute();
   
}

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
                    <h3 class="text-dark mb-4">Courses</h3>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" href="show-entities.php">Show Courses</a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="activate-course.php">Pending Course<span class="sr-only">(current)</span></a>
                                                </li>
                                                


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Courses Details</p>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="card-body">

                                                </div>
                                                <div class="table-responsive table mt-2" >
                                                    <table class="table  table-hover  my-0" >
                                                        <thead >
                                                            <tr class="table-active">
                                                              <th>Sr&nbsp;No.</th>
                                                                <th style="width:20%;">Course Name</th>
                                                                <th style="width:20%;">Thumbnail</th>
                                                                <th style="width:10%;">Category</th>
                                                                <th >Instructor</th>
                                                                <th >See</th>
                                                                <th>Send Msg</th>
                                                                <th>Activate</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $query = $con->prepare("SELECT * FROM entities WHERE status = 0");
                                                                $query->execute();
                                                                $c=0;
                                                                if ($query->rowCount() != 0) {
                                                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                                        $id = $row["id"];
                                                                        $img = $row["thumbnail"];
                                                                        $ct = $row["categoryId"];
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
                                                                        $c++;
                                                                    echo "<tr style='height:20px;'>
                                                                        <td>$c</td>
                                                                        <td>".$row["name"].
                                                                        "</td><td>"."<span style='display:none;'>$u_id</span><img src='../$img'  style='  border-radius: 10px;  height: 100px; width: 200px;'>".
                                                                        "</td><td>".$ct_name.
                                                                        "</td><td>".$ins_name.

                                                                        "</td><td><a href='review-course.php?course=$row[id]' style='margin-bottom:5px;' class='btn btn-primary'>
                                                                        <i class='fas fa-eye'></i>
                                                                        </a></td>".
                                                                        "<td class='text-center'><button type='button'  style='margin-bottom:5px;' class='btn btn-facebook editbtn' data-toggle='modal' data-target='#editmodal'>
                                                                        <i class='fas fa-envelope'></i>
                                                                        </button></td>".
                                                                        "<td><a href='update.php?course-status=$row[id]' style='margin-bottom:5px;' class='btn btn-success'>
                                                                        Activate
                                                                        </a></td>".
                                                                        "<td><a href='delete.php?entities=$row[id]' style='margin-bottom:5px;' class='btn btn-danger'>
                                                                        <i class='fas fa-trash'></i>
                                                                        </a></td>"."</tr>";
                                                                    }
                                                                    echo "</table>";
                                                                    }
                                                                    else {
                                                                        echo "<tr><td colspan='9' class='text-center'>No Course For Activate </td></tr>";
                                                                    }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="editmodal">Send Message </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form  method="post">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" id="title" name="title"  required>
                                                            </div>
                                                            <input type="hidden"   id="insid" name="insid">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="description" class="form-control" rows="5" ></textarea>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="send" class="btn btn-primary">Send Message</button>
                                                        </div>
                                                        </div>                                                        </form>

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
      $('#insid').val(data[2]);
      $('#title').val(data[1]);
      

      


  });
});

</script>
    <script type="text/javascript">
    $(document).ready(function(){
    $('table').DataTable({
        ordering:false
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
