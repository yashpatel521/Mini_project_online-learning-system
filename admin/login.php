<!DOCTYPE html>

<?php

require_once("include/config.php");
require_once("include/class/FormSanitizer.php");
require_once("include/class/Constants.php");
require_once("include/class/Account.php");
$account = new Account($con);

if(isset($_POST["login"])) {

    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    // $us = sidebar::usernames($_POST["username"]);

    $success = $account->login($username, $password);

    if($success) {
        $_SESSION["adminLoggedIn"] = $username;
        header("Location: index.php");
        // echo $_SESSION["adminLoggedIn"];
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <style media="screen">

    </style>
</head>
<body class="bg-gradient-primary" style="margin-top: 120px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(https://images.pexels.com/photos/4049633/pexels-photo-4049633.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Admin Login</h4>
                                    </div>
                                    <form class="user" method="post">
                                    <span class="text-danger">
        <?php echo $account->getError(Constants::$loginFailed); ?>
        </span>
                                        <div class="form-group"><input class="form-control form-control-user" type="text"  placeholder="Enter Username..." name="username"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password"  placeholder="Password" name="password"></div>

                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit" name="login">Login</button>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="recover_password.php">Forgot Password?</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
