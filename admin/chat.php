<?php
require_once("include/header.php");
if(isset($_POST['send'])){
    $account = new Account($con);
    $msg = FormSanitizer::sanitizeString($_POST["msg"]);
    $title = FormSanitizer::sanitizeString($_POST["title"]);
    $sender_id = $_POST['senderid'] ;
    $st = 0;
    
    $p_query = $con->prepare("INSERT INTO message (title,Description,sender,receiver,isAdmin,status)
                            VALUES ('$title','$msg','$adminLoggedInId',$sender_id,1,$st)");
    $p_query->execute();
    if($p_query){
        // header("Location: notification.php");
        echo "<script>alert('message send ');</script>";

    }
}
?>
<!DOCTYPE html>
<html>
<body>
<div id="wrapper">
    <?php require_once("include/sidebar.php");?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                    <?php require_once("include/topbar.php");?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-2">Chat</h3>
                    <div class="card shadow ">
                        <div class="card-header bg-primary py-3">
                            <p class="text-white m-0 font-weight-bold">Message</p>
                        </div>
                        <div class="card-body bg-white">
                            <div class="row rounded-lg  ">
                                <div class="col-lg-4 col-sm-12" style="border-right:solid  1px;">
                                    <div class="px-4 py-2">
                                        <p class="h5 mb-0 ">From: </p>
                                    </div>
                                    <div class="messages-box">
                                        <div class="list-group rounded-0">
                                            <?php
                                                 $query = $con->prepare("SELECT  *  FROM message WHERE isAdmin != 1 GROUP BY sender ");
                                                 $query->execute();
                                                 while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                                    $time = $row['date'];
                                                     $id= $row['sender'];
                                                     $isAdmin = $row['isAdmin'];
                                                     $title = $row['title'];
                                                     $find_query = $con->prepare("SELECT users.firstName as fn , users.lastName as ln
                                                      FROM users 
                                                     JOIN message ON users.id = message.sender Where users.id = '$id' ");
                                                     $find_query->execute();
                                                     $f_row = $find_query->fetch(PDO::FETCH_ASSOC);
                                                     $name = $f_row['fn']." ".$f_row['ln'];
                                                     $img_query = $con->prepare("SELECT img from instructor where user_id = '$id' ");
                                                     $img_query->execute();
                                                     $img_row = $img_query->fetch(PDO::FETCH_ASSOC);
                                                    $imges = $img_row['img'];
                                                    $en = base64_encode($imges);  
                                                     if($isAdmin != 1){
                                                        echo "<a href='chat.php?sender=$id&value=$en' class='list-group-item list-group-item-action list-group-item-light rounded-0'>
                                                        <div class='media'><img src='../$imges' alt='user' width='50' class='rounded-circle'>
                                                            <div class='media-body ml-4'>
                                                                <div class='d-flex align-items-center justify-content-between mb-1'>
                                                                    <h6 class='mb-0 text-dark' >$name</h6><small class='small font-weight-bold'>$time</small>
                                                                </div>
                                                                <p class='font-italic text-muted mb-0 text-small'>$title</p>
                                                            </div>
                                                        </div>
                                                    </a>";
                                                    
                                                     }
                                                 }
                                            ?>
                                            <!-- <a class="list-group-item list-group-item-action active text-white rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">25 Dec</small>
                                                        </div>
                                                        <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>
                                            -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-6" style="overflow-y: scroll;height:500px; overflow-x: hidden;" >
                                    <div class="px-4 py-5 chat-box bg-white" >
                                    <?php 
                                    if(isset($_GET['sender'])){
                                        $imges = base64_decode($_GET['value']);
                                        $id = $_GET['sender'];
                                        $query = $con->prepare("UPDATE message SET status = 1 WHERE sender = '$id' OR receiver = '$id' and isAdmin = 0 ");
                                        $query->execute();
                                        $query = $con->prepare("SELECT  *  FROM message WHERE sender = '$id' OR receiver = '$id' ORDER BY date ");
                                                 $query->execute();
                                        while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                            $title =$row['title'];
                                            $msg = $row['Description'];
                                            $time = $row['date'];
                                            
                                            $isAdmin = $row['isAdmin'];
                                            if($isAdmin == 0){
                                                    echo "<div class='media w-50 mb-3'><img src='../$imges' alt='user' width='50' class='rounded-circle'>
                                                    <div class='media-body ml-3'>
                                                        <div class='bg-light rounded py-2 px-1 mb-2' style='width:500px;'>
                                                        <h5 class='font-weight-bold mb-0 text-dark'>$title</h5>
                                                        <p class='text-small mb-0 text-muted'>$msg</p>
                                                        </div>
                                                        <p class='small text-muted'>$time</p>
                                                    </div>
                                                </div>";
                                            }
                                            else {
                                                echo "<div class='media w-50 ml-auto mb-3 mx-3'>
                                                <div class='media-body'>
                                                    <div class='bg-primary rounded py-2 px-3 mb-2' style='width:450px;'>
                                                    <h5 class='font-weight-bold mb-0 text-white'>$title</h5>
                                                    <p class='text-small mb-0 text-white'>$msg</p>
                                                    </div>
                                                    <p class='small text-muted'>$time</p>
                                                </div>
                                            </div> ";
                                            }
                                        }
                                    }
                                    else{
                                        echo "<div class=''></div><img src='https://thejewelcreation.com/blog/wp-content/uploads/2018/04/why_choose_uk_insurance_direct_0.gif' alt='user' width='30%;' style='margin-left:300px;margin-top:100px;'></div>";
                                    }
                                ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row rounded-lg  ">
                            <div class="col-lg-11 col-sm-12">
                            </div>
                            <div class="col-lg-1 col-sm-12">
                                    <div class="input-group-append">
                                    <?php if(isset($_GET['sender'])){
                                        echo " <button id='button-addon2' type='submit' class='btn btn-link' data-toggle='modal' data-target='#exampleModalCenter'> 
                                        <i class='fa fa-2x fa-paper-plane'></i></button>";
                                    }?>
                                       
                                    </div>
                            </div>
                            
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="post">
      <div class="modal-body">
            <input type="hidden" name="senderid" value="<?php echo $_GET['sender'];?>">
            <label class="text-dark">Enter title : </label>
            <input type="text" class="form-control" name="title" required>
            <br>
            <label class="text-dark">Enter Message : </label>
            <textarea class="form-control" name="msg" rows="4" required></textarea>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="send">Send</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>