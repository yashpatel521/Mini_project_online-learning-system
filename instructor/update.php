<?php
require_once("include/header.php");
if (isset($_POST['update-course'])) {
    $id = $_POST["id"];
    $en =  $_POST["Entities"];
    $cts =  $_POST["ct"];
    $short_des =  $_POST["short_des"];
    $long_des =  $_POST["long_des"];
    $time =  $_POST["duration"];
    $lan =  $_POST["language"];
    $overview =  $_POST["overview"];
    $requirment =  $_POST["requirment"];
    $defult_img = $_POST["defult_img"];
    $defult_pre = $_POST["defult_pre"];
    $defult_video = $_POST["defult_video"];
    $filename= $_FILES["photo"]["name"];
    $tempname= $_FILES["photo"]["tmp_name"];
    
    if ($filename == ""){
        $folder_q = $defult_img;
    }
    else{
        $folder = "../entities/thumbnails/".$filename;
        $folder_q = "entities/thumbnails/".$filename;
        move_uploaded_file($tempname,$folder);
    }
    $query = $con->prepare("UPDATE entities SET name = '$en',categoryId = '$cts', thumbnail = '$folder_q'
                    , short_des = :short_des ,  duration = '$time', language = '$lan'
                    , overview = :overview , requirmnet = :requirment , long_des = :long_des
                        WHERE id = '$id' ");
                        $query->bindParam(':requirment', $requirment);
                        $query->bindParam(':long_des', $long_des);
                        $query->bindParam(':overview', $overview);
                        $query->bindParam(':short_des', $short_des);
    $eni=$query->execute();
     // for preview
     $filename= $_FILES["video_p"]["name"];
     $tempname= $_FILES["video_p"]["tmp_name"];
     
     
     if ($filename == ""){
        $folder_q = $defult_pre;
    }
    else{
        $folder= "../entities/preview/".$filename;
        $folder_q = "entities/preview/".$filename;
        move_uploaded_file($tempname,$folder);
    }
    $query = $con->prepare("SELECT * FROM entities WHERE name = '$en' ");
     $query->execute();
     $row = $query->fetch(PDO::FETCH_ASSOC);
     $en_id = $row['id'];
    $query = $con->prepare("UPDATE videos SET previewvideo = '$folder_q' WHERE entityId = '$en_id' ");
    $vid=$query->execute();
     
     // for video
     $filename= $_FILES["videos"]["name"];
     $tempname= $_FILES["videos"]["tmp_name"];
     if ($filename == ""){
        $folder_q = $defult_video;
    }
    else{
        $folder_v = "../entities/video/".$filename;
        $folder_q_v = "entities/video/".$filename;
        move_uploaded_file($tempname,$folder_v);
    }
    
   
     $query = $con->prepare("UPDATE videos SET  mainvideo = '$folder_q' WHERE entityId = '$en_id' ");
     $v_id=$query->execute();

    if($eni && $vid &&$v_id){
        echo "<script>alert('$en_id');</script>";
        header("Location: show-course.php");

    }
    else{
        echo "<script>alert('Entities not Updated');</script>";
    }
     
}

?>

