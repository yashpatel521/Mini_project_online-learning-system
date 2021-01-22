<?php
	require_once("includes/config.php");
	// require_once("class/account.php");
	// require_once("class/user.php");
	// require_once("class/FormSanitizer.php");
	// require_once("class/Constants.php");
	
	if(!isset($_SESSION["userLoggedIn"])) {
		$_SESSION["urlridirect"] = $_SERVER['REQUEST_URI'];
		header("Location: ../login");
	}
	
	$userLoggedIn = $_SESSION["userLoggedIn"];
	$query = $con->prepare("SELECT * FROM users WHERE username = '$userLoggedIn' ");
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
		$userLoggedIn_id = $row["id"];
		$userLoggedIn_name = $row["firstName"]." ".$row["lastName"];
		$userLoggedIn_username = $row['username'];
		$userLoggedIn_email = $row['email'];
		$userLoggedIn_fn = $row["firstName"];
		$userLoggedIn_ln = $row["lastName"];
		$symbol_fn = substr($userLoggedIn_fn,0,1);
		$symbol_ln = substr($userLoggedIn_ln,0,1);
		$arr = array($symbol_fn,$symbol_ln);
		$userLoggedIn_profile_symbol = join("",$arr);
//		echo $userLoggedIn_name;

?>
