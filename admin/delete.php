<?php
require_once("include/header.php");

if(isset($_GET['admin'])){
    $adminId=$_GET['admin'];
    
    $query = $con->prepare("DELETE FROM users WHERE id = $adminId AND role = 1");
    $query->execute();
    
    if($query){
        header("Location: update-admin.php");
        exit("");

    }
}

else if(isset($_GET['user'])){
    $userId=$_GET['user'];
    $query = $con->prepare("DELETE FROM users WHERE id = $userId AND role = 3");
    $query->execute();
    
    // echo $userId;
    if($query){
        
        header("Location: update-user.php");
        exit("");

    }
}
else if(isset($_GET['category'])){
    $ctId=$_GET['category'];
    $query = $con->prepare("DELETE FROM categories WHERE id = $ctId ");
    $query->execute();
    
    if($query){
        header("Location: update-category.php");
        exit("");

    }
}

else if(isset($_GET['entities'])){
    $enId=$_GET['entities'];
    $query = $con->prepare("DELETE FROM entities WHERE id = $enId ");
    $query->execute();
    
    if($query){
        header("Location: show-entities.php");
        exit("");

    }
}

else if(isset($_GET['instructor'])){
    $ins_Id=$_GET['instructor'];
    $query = $con->prepare("DELETE FROM users WHERE id = $ins_Id AND role = 2");
    $query->execute();
    
    if($query){
        echo "<script>";
        echo "window.history.back();";
        echo "</script>";
        exit("");

    }
}
elseif (isset($_GET['contact']))
{
	$c_id = $_GET['contact'];
	$query_en = $con->prepare("DELETE FROM contact_us WHERE id=$c_id");
	$query_en->execute();
	
	if($query_en)
	{
		header("Location: contact.php");
//			exit("");
	}
}
else if(isset($_GET['video'])){
    $videoId=$_GET['video'];
    $query = $con->prepare("DELETE FROM videos WHERE id = $videoId ");
    $query->execute();
    
    if($query){
        header("Location: update-video.php");
        exit("");

    }
}
else{

}
?>