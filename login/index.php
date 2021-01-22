<?php
	require_once("include/config.php");
	require_once("include/class/FormSanitizer.php");
	require_once("include/class/Constants.php");
	require_once("include/class/Account.php");
	$account = new Account($con);
	
	if(isset($_POST["login"])) {
		
		$username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
		$password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
		$success = $account->login($username, $password);
		
		if($success == 3) {
			$_SESSION["userLoggedIn"] = $username;
			// header("Location: ../main/main.php");
			if (isset($_SESSION["urlridirect"])) {
				header("Location:" . $_SESSION["urlridirect"]);
			} else {
				header("Location: ../main/main.php");
				
			}
		}
		if($success == 2) {
			$_SESSION["instructorLoggedIn"] = $username;
			header("Location: ../instructor/index.php");
			// echo $_SESSION["adminLoggedIn"];
		}
		if($success == 1) {
			$_SESSION["adminLoggedIn"] = $username;
			header("Location: ../admin/index.php");
			// echo $_SESSION["adminLoggedIn"];
		}
	}
	
	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="assets/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <span class="text-danger">
                            <?php echo $account->getError(Constants::$loginFailed); ?>
		                    <?php echo $account->getError(Constants::$notactivate); ?>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input  type="text" name="username" value="<?php getInputValue("username"); ?>"  placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input  type="password" name="password"  placeholder="Password"/>
                            </div>
                            <span class="social-label"><a href="forget_password.php" style="text-decoration:none">Forget Password</a></span>/&nbsp;&nbsp;&nbsp;
                            <span class="social-label"><a href="forget_username.php" style="text-decoration:none">Forget Username</a></span>
                            <div class="form-group form-button">
                                <input type="submit" name="login" id="login" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label"><a href="../main/" style="text-decoration:none">Brighter Bee</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>