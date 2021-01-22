<?php
	require_once("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('includes/uplinks.php') ?>
    </head>
    <body>

        <?php 
            if(!isset($_SESSION["userLoggedIn"])){
                
                include('includes/before_login.php');
            }
            else{
                
                include('includes/topbar.php');
            }
         ?>
        <?php include('templates/intro.php') ?>
        <?php include('templates/category.php') ?>
      <?php include('templates/priceing.php') ?>
        <?php  include('templates/course_slide.php')?>
        <?php include('templates/aboutus.php') ?>
        <?php include('templates/instructorinfo.php') ?>
        <?php include('templates/testomonail.php') ?>
        <?php include('includes/footer.php')?>
        <?php  include('includes/downlinks.php')?>
    </body>
</html>