<?php
session_start();
unset($_SESSION["instructorLoggedIn"]);
header("Location:../login");

?>