<?php
require_once("include/header.php");
if(isset($_GET['entities'])){
    $enId=$_GET['entities'];
    $query = $con->prepare("DELETE FROM entities WHERE id = $enId ");
    $query->execute();
    
    if($query){
        header("Location: show-course.php");
        exit("");
    }
}
else{
    
}
?>