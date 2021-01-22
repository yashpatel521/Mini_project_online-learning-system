<?php
	
	require_once("include/config.php");
	require_once("include/class/FormSanitizer.php");
	require_once("include/class/Constants.php");
	require_once("include/class/Account.php");
	$account = new Account($con);
	
	if(isset($_POST["submit"])) {
		
		$firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
		$lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
		$username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
		$email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
		$password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
		$password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
		
		$success = $account->register($firstName, $lastName, $username, $email, $password, $password2);
		
		if($success) {
			$_SESSION["userLoggedIn"] = $username;
			header("Location: ../main/main.php");
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
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            
                            <div class="form-group">
                                <span style="color: red;"><?php echo $account->getError(Constants::$loginFailed); ?></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="firstName" value="<?php getInputValue("firstName"); ?>"  placeholder="First Name"/>
                            </div>
                            <div class="form-group">
                                <span style="color:red;"><?php echo $account->getError(Constants::$lastNameCharacters); ?></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text"  name="lastName" value="<?php getInputValue("lastName"); ?>" placeholder="Last Name"/>
                            </div>
                            <div class="form-group">
                                <span style="color:red;"><?php echo $account->getError(Constants::$usernameCharacters); ?></span>
                                <span style="color:red;"><?php echo $account->getError(Constants::$usernameTaken); ?></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" value="<?php getInputValue("username"); ?>" placeholder="User Name"/>
                            </div>
                            <div class="form-group">
                                <span style="color:red;"><?php echo $account->getError(Constants::$emailInvalid); ?></span>
                                <span style="color:red;"><?php echo $account->getError(Constants::$emailTaken); ?></span>
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email"name="email" value="<?php getInputValue("email"); ?>" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <span style="color:red;"><?php echo $account->getError(Constants::$passwordsDontMatch); ?></span>
                                <span style="color:red;"><?php echo $account->getError(Constants::$passwordLength); ?></span>
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password"  name="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password2" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="index.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
                <div style="margin-left:12%;padding-bottom:30px;margin-top:-50px">
                    <span class="social-label"><a href="../main/" style="text-decoration:none">Brighter Bee</a></span>
                    
                </div>
            </div>
            
        </section>
    </div>

    <!-- JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>