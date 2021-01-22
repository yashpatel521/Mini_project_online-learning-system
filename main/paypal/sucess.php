<?php

if(isset($_GET["id"]) && isset($_GET["status"]) && isset($_GET["date"])){
    $id = $_GET["id"];
    $status = $_GET["status"];
    $date = $_GET["date"];
    echo $id;
    echo "<br>";
    echo $status;
    echo "<br>";
	$_SESSION["userLoggedIn"] = $id;
    echo $date;
    ?>
	
	<strong></strong><p id="">amount</p>
	
	
<?php
}
else{
    echo "sucess with no pass";
}
?>