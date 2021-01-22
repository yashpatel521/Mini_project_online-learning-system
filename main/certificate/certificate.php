<?php
    
    if ($_GET['Id'] && $_GET['cId'])
    {
        $id = $_GET['Id'];
        $c_id = $_GET['cId'];
        $crt_query = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$id AND course_id=$c_id");
        $crt_query->execute();
    }
    
    $query = $con->prepare("SELECT * FROM videoprogress WHERE finished=1");
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC))
    {
        $l_id = $row['learner_id'];
        
        $l_query = $con->prepare("SELECT * FROM users WHERE id=$l_id");
        $l_query->execute();
        $l_row = $l_query->fetch(PDO::FETCH_ASSOC);
            $l_name = $l_row['firstName']." ".$l_row['lastName'];
        
        header('content-type:image/jpeg');
        $font= realpath('AspireDemibold-YaaO.ttf');
        $image=imagecreatefromjpeg("learner_format.jpg");
        $color=imagecolorallocate($image, 51, 51, 102);
        $date=date('d F, Y');//Current Date
        imagettftext($image, 18, 0, 120, 520, $color,$font, $date); //issue date
        $name=$l_name;
        imagettftext($image, 40, 0, 50, 320, $color,$font, $name); //learner name
        imagejpeg($image,"certificate/$name.jpg");//Storing certificate here
        imagedestroy($image);
    }
    
//    header("Location: main.php");
?>
