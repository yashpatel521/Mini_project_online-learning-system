<?php
require_once("include/header.php");

$query = $con->prepare("UPDATE message SET status = 1  WHERE receiver = '$instructorLoggedInId' ");
$query->execute();
if(isset($_POST['send'])){
    $account = new Account($con);
    $msg = FormSanitizer::sanitizeString($_POST["msg"]);
    $title = FormSanitizer::sanitizeString($_POST["title"]);
    $sender_id = $_POST['senderid'] ;
    
    
    $p_query = $con->prepare("INSERT INTO message (title,Description,sender,receiver)
                            VALUES ('$title','$msg','$instructorLoggedInId',$sender_id)");
    $p_query->execute();
    if($p_query){
        header("Location: notification.php");
        // echo "<script>alert($sender_id);</script>";

    }

} 

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<body>
   
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <?php require_once("include/topbar.php"); ?>
        <?php require_once("include/sidebar.php"); ?>
        <div class="page-wrapper">
            
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Message</h2>
                    <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item "><a href="entities/thumbnails/" class="text-primary">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Message</li>
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
            
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row no-gutters">
                                <?php
                                     $query = $con->prepare("SELECT * FROM message WHERE receiver = '$instructorLoggedInId'  ORDER BY date DESC ");
                                     $query->execute();
                                     $notification = $query->rowCount();
                                     if($notification > 0){
                                        $row = $query->fetch(PDO::FETCH_ASSOC);
                                        $sender_id = $row['sender'];
                                        $sender = $row['isAdmin'];
                                        if($sender == 1){
                                            $sender = "Brighter Bee Admin";
                                        }
                                        
                                       echo "<div class='col-lg-3 col-xl-2 border-right'>
                                        <div class='card-body border-bottom'>
                                            <h3 class='mt-0'>From :</h3>
                                        </div>
                                        <div class='scrollable position-relative' style='height: calc(60vh - 120px);'>
                                            <ul class='mailbox list-style-none'>
                                                <li>
                                                    <div class='message-center'>
                                                        <a href='javascript:void(0)'
                                                            class='message-item d-flex align-items-center border-bottom px-3 py-2'>
                                                            <div class='user-img'><img src='https://cdn2.vectorstock.com/i/1000x1000/20/76/man-avatar-profile-vector-21372076.jpg' 
                                                            alt='user' class='img-fluid rounded-circle' width='40px' height='60px'> <span
                                                                    class='profile-status online float-right'></span>
                                                            </div>
                                                            <div class='w-75 d-inline-block v-middle pl-2'>
                                                                <h6 class='message-title mb-0 mt-1'>$sender</h6>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='col-10'>
                                        <div class='chat-box scrollable position-relative'
                                            style='height: calc(60vh - 60px);'>
                                      
                                            <ul class='chat-list list-style-none px-3 pt-2'>";?>
                                            <?php 
                                            // ORDER BY id DESC 
                                                $query = $con->prepare("SELECT * FROM message WHERE receiver = '$instructorLoggedInId' OR sender = '$instructorLoggedInId' ");
                                                $query->execute();
                                                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                                    $title = $row['title'];
                                                    $desc = $row['Description'];
                                                    $time = $row['date'];
                                                    if($row['sender'] != $instructorLoggedInId){
                                                    echo "<li class='chat-item list-style-none mt-3'>
                                                            <div class='chat-img d-inline-block'><img
                                                                    src='https://cdn2.vectorstock.com/i/1000x1000/20/76/man-avatar-profile-vector-21372076.jpg' alt='$sender'
                                                                    class='rounded-circle' width='45'>
                                                            </div>
                                                            <div class='chat-content d-inline-block pl-3'>
                                                                <h6 class='font-weight-medium'>$sender</h6>
                                                                <div class='msg p-2 d-inline-block mb-1 col-8' style='border-radius: 0px 30px 30px 0px;'>
                                                                    <h5 class='text-dark'> $title : </h5>
                                                                    <p>$desc</p>
                                                                </div>
                                                            </div>
                                                            <div class='chat-time d-block font-10 mt-1 mr-0 mb-3'>$time</div>
                                                        </li>";}
                                                    else{
                                                        echo " <li class='chat-item odd list-style-none mt-3'>
                                                        
                                                        <div class='chat-content text-right d-inline-block pl-3'>
                                                        <div class='msg p-2 d-inline-block mb-1 col-8' style='border-radius: 30px 0px 0px 30px;'>
                                                        <h5 class='text-dark'> $title : </h5>
                                                        <p>$desc</p>
                                                    </div>
                                                            <br>
                                                        </div>
                                                        <div class='chat-time text-right d-block font-10 mt-1 mr-0 mb-3'>$time</div>
                                                    </li>";
                                                    }
                                                }
                                            ?>
                                            <?php
                                                 echo "</ul></div></div> ";
                                    }
                                    else{
                                        echo "<div class='col-12 '>
                                        <div class='card-body border-bottom'>
                                        <h3 class='mt-0'>No Message Found</h3>
                                            </div> <div>";
                                    }
                                ?>
                                            <div class="col mb-3 mr-3">
                                                <a class="btn-circle btn-lg btn-cyan float-right text-white"
                                                    href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <i class="fas fa-paper-plane"></i>
                                                </a>
                                            </div>
                                            <br>
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
                                                                <input type="hidden" name="senderid" value="<?php echo $sender_id;?>">
                                                                <label class="text-dark">Enter title : </label>
                                                                <input type="text" class="form-control" name="title" required>
<br>
                                                                <label class="text-dark">Enter Message : </label>
                                                                <textarea class="form-control" name="msg" rows="4" required></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="send">Send Message</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <?php require_once("include/class/script.php"); ?>
</body>

</html>