<?php
require_once("include/config.php");
$_SESSION['sucess'] = "";
$_SESSION['dan'] = "";
if(isset($_POST['submit'])){

    $email = $_POST['email'];

    $query=$con->prepare("SELECT * FROM admin WHERE email = '$email' ");

    $query->execute();

    $no=$query->rowCount();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $username=$row['username'];
    $name = $row['firstName']." ".$row['lastName'];
    $token=$row['auth'];


    if($no==1){
        // echo $username;
        $to_email = $email;
        $subject = "Password Reset for LERNER's Admin";
        $from = 'info.ck.3764@gmail.com';
        $fromName = 'Learners';

        $body = '<html>
        <head>
            <title>Welcome to Learners</title>
        </head>
        <body>
            <h1>Thanks you for joining with us!</h1>
            <h3>Hi,'. $name.'</h3><hr>
            <p>There is a password reset link for your lerners admin account dont share </p>
           <p> http://localhost/learner/admin/password_change.php?auth='.$token.'";</p>

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
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<style>
    .form-gap {
    padding-top: 70px;
}
body{
  margin-top: 120px;
  background: #418BFF;
}
</style>
<body>

 <div class="form-gap"></div>
<div class="container">
	<div class="row" >
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" >
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">

                    <form id="register-form" class="form" method="post">
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

                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                            </div>
                        </div>

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
                            <input name="submit" class="btn btn-lg btn-primary btn-block" value="Send me Link" type="submit">
                        </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</body>
</html>
