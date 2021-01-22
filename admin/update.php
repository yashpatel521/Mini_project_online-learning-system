<?php
require_once("include/header.php");

if(isset($_GET['instructor'])){
    $id_s=$_GET['instructor'];
    $id=str_replace(" ", "", $id_s);
    
    $query = $con->prepare("UPDATE instructor SET status = 0  WHERE user_id = '$id' ");
    $query->execute();
    
    if($query){
        echo "<script>window.alert('Instructor DeActivted successfully');
        window.history.back();</script>";
      

    }
    else{
        echo "<script>alert('instructor not Updated');</script>";
    }
}


else if(isset($_GET['status'])){
    $id = $_GET['status'];
    $email = $_GET['email'];
    $name = $_GET["name"];
  
    $query = $con->prepare("UPDATE instructor SET status = 1  WHERE id = '$id' ");
    $query->execute();
    
    if($query){
        $to_email = $email;
        $subject = "Instructor Account Activation";
        $from = 'parthb401@gmail.com';
        $fromName = 'Brighter Bee';

        $body = '<html>
        <head>
            <title>Welcome to Brighter Bee</title>
        </head>
        <body>
            <h1>Thank you for joining with us!</h1>
            <h3>Hi,'.$_GET["name"].'</h3><hr>
            <p>Your Instructor Account is Successfully Activated</p>
            <p>Now you can login with your username and password</p>
            <p>For login: http://localhost/bb/login</p>
            
           

        </body>
        </html>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";
        if (mail($to_email, $subject, $body, $headers)) {

            

        }

        echo "<script>
        window.alert('Instructor Activted successfully');
        window.history.back();
         </script>";
       
        exit("");
    }
    else{
        echo "<script>alert('instructor not Activated');</script>";
    }
}
else if(isset($_GET['course-status'])){
    $id = $_GET['course-status'];
  
    $query = $con->prepare("UPDATE entities SET status = 1  WHERE id = '$id' ");
    $query->execute();
    
    if($query){
        echo "<script>
        window.alert('Course Activted successfully');
        window.history.back();
         </script>";
       
        exit("");
    }
    else{
        echo "<script>alert('Course not Activated');</script>";
    }
}
else if(isset($_POST['update-ins'])){
    
    $un=$_POST['username'];
    $id_s=$_POST['insid'];
    $user_id=str_replace(" ", "", $id_s);
    $fn=$_POST['fname'];
    $ln=$_POST['lname'];
    $email=$_POST['email'];
    $status = $_POST['status'];

    $query = $con->prepare("UPDATE users SET firstName = '$fn' , lastName = '$ln' , email = '$email' , username = '$un' WHERE id = '$user_id'  ");
    $query->execute();
    
    $query = $con->prepare("UPDATE instructor SET status = '$status' WHERE user_id = '$user_id'  ");
    $query->execute();
    if($query){
        
        header("Location: show-instructor.php");
        exit("");
    }
    else{
        echo "<script>alert('instructor not Activated');</script>";
    }
}

else if (isset($_POST['update-plan']))
{
    $id = $_POST['pid'];
    $plan = $_POST['plan'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    echo $id;
    $query = $con->prepare("UPDATE plans SET plan = '$plan',period = '$duration', price = '$price'  WHERE id = '$id' ");
    $query->execute();
    
    if($query){
        echo "<script>window.alert('Data Updated');</script>";
        header("Location: payment_details.php");

    }
    else{
        echo "<script>alert('Plan not Updated');</script>";
    }
}

else if(isset($_POST['update-ct'])){
    $ct=$_POST['title'];
    $id_s=$_POST['ctid'];
   
    $id=str_replace(" ", "", $id_s);
   
    $filename= $_FILES["photo"]["name"];
    $tempname= $_FILES["photo"]["tmp_name"];
      
    $folder = "../entities/thumbnails/".$filename;
    $folder_q = "entities/thumbnails/".$filename;
      //delete is pending
      move_uploaded_file($tempname,$folder); 
      $query = $con->prepare("SELECT img FROM categories  WHERE id = '$id' ");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $img= $row['img'];
    if($folder_q == "entities/thumbnails/"){
        $folder_q = $img;
    }
    $query = $con->prepare("UPDATE categories SET name = '$ct',img = '$folder_q'   WHERE id = '$id' ");
    $query->execute();
    
    if($query){
        echo "<script>alert('Data Updated');</script>";
        header("Location: update-category.php");

    }
    else{
        echo "<script>alert('category not Updated');</script>";
    }
    
}
else if (isset($_POST['update-en'])) {
    $id = $_POST["id"];
    
    $status = $_POST["status"];

$query = $con->prepare("UPDATE entities SET  status = '$status'
    WHERE id = '$id' ");                  


    
    $query->execute();
    
    if($query){
        echo "<script>alert('Data Updated');</script>";
        header("Location: show-entities.php");

    }
    else{
        echo "<script>alert('Entities not Updated');</script>";
    }
     
}                 
else{

}
                                                
?>
