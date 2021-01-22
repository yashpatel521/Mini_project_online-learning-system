<?php
	require_once("include/config.php");
	require_once("include/class/FormSanitizer.php");
	require_once("include/class/Constants.php");
	require_once("include/class/Account.php");
	$account = new Account($con);
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
    <title>Forget Username</title>

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
                    <div class="signup-image">
                        <figure><img src="assets/images/3.jpg" alt="sing up image"></figure>
                        <a href="index.php" class="signup-image-link">I am already member</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Forget Username</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" value="<?php getInputValue("email"); ?>" placeholder="Enter Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text"  name="first" value="<?php getInputValue("first"); ?>"  placeholder="First Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="last" value="<?php getInputValue("last"); ?>"  placeholder="Last Name"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="find" class="form-submit" value="Find Username"/>
                            </div>
                        </form>
	                    <?php
		                    if(isset($_POST['find']))
		                    {
			                    $fname = FormSanitizer::sanitizeFormString($_POST["first"]);
			                    $lname = FormSanitizer::sanitizeFormString($_POST["last"]);
			                    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
			                    $success = $account->find($fname, $lname, $email);
			                    if($success)
			                    {
				                    $query = $con->prepare("SELECT * FROM users WHERE email = '$email' ");
				                    $query->execute();
				
				
				                    while($row = $query->fetch(PDO::FETCH_ASSOC))
				                    {
					                    echo "
                                            <p>Email ID : ". $row['email'] ." </p>
                                            <p>User name : ". $row['username'] ." </p>
                                         ";
				                    } //end while
			                    } //end if
			                    else
			                    {
				                    echo "No data Found!";
				                    //  echo $account->getError(Constants::$notfind);
			                    } //end else
		                    }
	                    ?>
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