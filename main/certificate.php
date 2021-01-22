<?php
    require_once ("includes/header.php");
    
    if ($_GET['Id'] && $_GET['vId'])
    {
        $id = base64_decode($_GET['Id']);
        $vid_id = base64_decode($_GET['vId']);
        $query = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$id AND video_id=$vid_id AND finished=1");
        $query->execute();
        
        if ($query->rowCount() == 1)
        {
            while ($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $l_id = $row['learner_id'];
                $video_id = $row['video_id'];
        
                $v_query = $con->prepare("SELECT * FROM videos WHERE id=$video_id");
                $v_query->execute();
                $v_row = $v_query->fetch(PDO::FETCH_ASSOC);
                    $en_id = $v_row['entityId'];
                
                $e_query = $con->prepare("SELECT * FROM entities WHERE id=$en_id");
                $e_query->execute();
                $e_row = $e_query->fetch(PDO::FETCH_ASSOC);
                    $e_name = $e_row['name'];
        
                $l_query = $con->prepare("SELECT * FROM users WHERE id=$id");
                $l_query->execute();
                $l_row = $l_query->fetch(PDO::FETCH_ASSOC);
                    $l_name = $l_row['firstName']." ".$l_row['lastName'];
                    $LID = $l_row['id'];
        
                header('content-type:image/jpeg');
                $font= realpath('certificate/arial.ttf');
                $image=imagecreatefromjpeg("certificate/learner_format.jpg");
                $color=imagecolorallocate($image, 51, 51, 102); //font color
                $date=date('d F, Y');//Current Date
                imagettftext($image, 12, 0, 120, 613, $color,$font, $date); //issue date
                $name=$l_name;
                imagettftext($image, 28, 0, 50, 320, $color,$font, $name); //learner name
                imagettftext($image, 20, 0, 50, 390, $color,$font, $e_name); //course name
                $ref_join = $LID."".$en_id;
                $ref = bin2hex($ref_join);
                imagettftext($image, 12, 0, 610, 610, $color,$font, $ref); //refrence id
                imagejpeg($image,"certificate/certificate/2020$id.$en_id.$name.jpg");//Storing certificate here
                imagedestroy($image);
            }
        }
        
        $check = $con->prepare("SELECT * FROM certificate WHERE learner_id=$id AND course_id=$en_id");
        $check->execute();
        if ($check->rowCount() == 0)
        {
            $insert = $con->prepare("INSERT INTO certificate(learner_id,course_id,certificate,reference_id) VALUES ($id, $en_id, 'certificate/certificate/2020$id.$en_id.$name.jpg',$ref)");
            $insert->execute();
        }
    }
    
//    $query = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$id AND course_id=$c_id");
//    $query->execute();

    $enid=base64_encode($en_id);
    header("Location: download.php?uid=".$_GET['Id']."&enid=$enid");
?>
