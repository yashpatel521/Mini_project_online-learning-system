<?php
	require_once("include/config.php");
	$_SESSION['sucess'] = "";
	$_SESSION['dan'] = "";
	if(isset($_POST['submit'])){
		
		$email = $_POST['email'];
		
		$query=$con->prepare("SELECT * FROM users WHERE email = '$email' ");
		
		$query->execute();
		
		$no=$query->rowCount();
		
		
		
		if($no==1){
			// echo $username;
			$row = $query->fetch(PDO::FETCH_ASSOC);
			$username=$row['username'];
			$name = $row['firstName']." ".$row['lastName'];
			$token=$row['auth'];
			$to_email = $email;
			$subject = "Password Reset for Brighter Bee Users";
			$from = 'parthb401@gmail.com';
			$fromName = 'Brighter Bee';
			
			$body = '<html>
        <head>
            <title>Welcome to Brighter Bee</title>
        </head>
        <body>
            <h1>Thanks you for joining with us!</h1>
            <h3>Hi,'. $name.'</h3><hr>
            <p>There is a password reset link for your Brighter Bee account don\'t share </p>
           <p> http://localhost/brighter/login/change-password.php?auth='.$token.'";</p>

        </body>
        </html>';
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";
			if (mail($to_email, $subject, $body, $headers)) {
				
				$_SESSION['sucess'] = "Reset Password Email successfully sent to $to_email ";
				
			}
			else {
				$_SESSION['dan'] = "Connection not establish , check your internet connection ";
			}
			
		}
		else{
			$_SESSION['dan'] = "User not found enter valid email id";
		}
		
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>

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
                        <h2 class="form-title">Forget Password</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <span style="text-align:center;color:green;">
                                <?php
                                    if(isset($_SESSION['sucess'])){
                                        echo $_SESSION['sucess'];
                                    }
                                    else{
                                        $_SESSION['sucess'] = "";
                                    }
                                ?>
                            </span>
                            <h5 style="text-align:center;color:red;">
		                        <?php
			                        if(isset($_SESSION['dan'])){
				                        echo $_SESSION['dan'];
			                        }
			                        else{
				                        $_SESSION['dan'] = "";
			                        }
		                        ?>
                            </h5>
                            
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Enter Your Email"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" class="form-submit" value="Send Link"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/images/2.jpg" alt="sing up image"></figure>
                        <a href="index.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
                <div style="margin-left:12%;padding-bottom:30px;margin-top:-100px">
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