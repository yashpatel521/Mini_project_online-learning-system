<?php

require_once("include/config.php");
require_once("include/class/FormSanitizer.php");
require_once("include/class/account.php");
require_once("include/class/Constants.php");
require_once("include/class/user.php");

if(!isset($_SESSION["adminLoggedIn"])) {
    header("Location: ../login/");
}
$adminLoggedIn = $_SESSION["adminLoggedIn"];
$query = $con->prepare("SELECT * FROM users WHERE username = '$adminLoggedIn' ");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$adminLoggedInId = $row["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">-->
    <title>Brighter Bee - Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/logob1.png">
    
    
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>
<body>

</body>
<script type="text/javascript">
document.addEventListener("contextmenu",function(learner){
learner.preventDefault();
window.alert("right Click Disabled");
});
</script>
</html>
