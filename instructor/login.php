<?php

require_once("include/config.php");
require_once("include/class/FormSanitizer.php");
require_once("include/class/Constants.php");
require_once("include/class/Account.php");

$account = new Account($con);

    if(isset($_POST["submitButton"])) {

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($username, $password);

        if($success) {
            $_SESSION["instructorLoggedIn"] = $username;
            header("Location: index.php");
        }
    }

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo_title.png"> -->
    <title>BrighterBee Instructor</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(https://vethics.com/assets/images/training4.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="https://image.flaticon.com/icons/png/512/5/5100.png"  style="width:55px;height:65px;" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Enter your email address and password to access Instructor panel.</p>
                        <form class="mt-4" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                <span style="color:red;"><?php echo $account->getError(Constants::$loginFailed); ?> </span>
                                <span style="color:red;"><?php echo $account->getError(Constants::$notactivate); ?> </span>

                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required>                                    
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" name="password" type="password" placeholder="enter your password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                <input type="submit" name="submitButton" class="btn btn-block btn-dark" value="Login" >
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="register.php" class="text-danger">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("include/class/script.php"); ?>
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>