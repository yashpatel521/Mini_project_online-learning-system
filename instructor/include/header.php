<?php

require_once("include/config.php");
require_once("include/class/FormSanitizer.php");
require_once("include/class/account.php");
require_once("include/class/Constants.php");
require_once("include/class/user.php");


if(!isset($_SESSION["instructorLoggedIn"])) {
    header("Location: login.php");
}
$instructorLoggedIn = $_SESSION["instructorLoggedIn"];
$query = $con->prepare("SELECT * FROM users WHERE username = '$instructorLoggedIn' ");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$instructorLoggedInId = $row["id"];

$instructorLoggedName = $row["firstName"]." ".$row["lastName"];
$query = $con->prepare("SELECT * FROM instructor WHERE user_id = '$instructorLoggedInId' ");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$ins_id = $row['id'];
$aboutu = $row['about'];
$degree = $row['degree'];
$uni = $row['university'];
$exp = $row['Experience'];
$img = $row['img'];




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <title>Brighter Bee - Instructor</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logob1.png">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>
<body>
</body>
<script type="text/javascript">
document.addEventListener("contextmenu",function(learner){
learner.preventDefault();
});
</script>
</html>