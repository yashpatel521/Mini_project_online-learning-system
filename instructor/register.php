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
    $degree = FormSanitizer::sanitizeString($_POST["degree"]);
    $uni = FormSanitizer::sanitizeString($_POST["institute"]);
    $about = FormSanitizer::sanitizeString($_POST["about"]);
    $exp = $_POST["exp"];
    $filename= $_FILES["pdf"]["name"];
    $tempname= $_FILES["pdf"]["tmp_name"];

    $folder = "../entities/resume/".$filename;
    $folder_q = "entities/resume/".$filename;
    move_uploaded_file($tempname,$folder);
    // echo $about;
    $success = $account->register($firstName, $lastName, $username, $email, $password , $password2);
    echo $success;
    if($success) {
        $query = $con->prepare("SELECT * FROM users WHERE username = '$username' ");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['id'];
        $query = $con->prepare("INSERT INTO instructor (user_id, degree, Experience, university, about,resume)
                                        VALUES (:user_id, :degree,:exp ,:uni, :about,:folder_q)");
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":degree", $degree);
        $query->bindValue(":exp", $exp);
        $query->bindValue(":uni", $uni);
        $query->bindValue(":about", $about);
        $query->bindValue(":folder_q", $folder_q);
        if($query->execute()){
            $success = $account->showmsg();
        }
        else{
            echo "<script>windows.alert('Enter valid Details')</script>";
        }
        
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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logob1.png">
    <title>Brighteer Bee</title>
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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row text-center">
                <!-- <div class="col-lg-5 col-md-5 modal-bg-img" style="background-image: url(https://vethics.com/assets/images/training4.jpg);">
                </div> -->
                <div class="col-lg-12 col-md-12 bg-white">
                    <div class="p-3">
                    <img src="https://image.flaticon.com/icons/png/512/5/5100.png"  style="width:55px;height:65px;" alt="wrapkit">
                        <h2 class="mt-1 text-center">Sign Up for Instructor</h2>
                        <span style="color:green;"><?php echo $account->getError(Constants::$submitforreview); ?></span>
                        <form class="mt-2" method="post" role="form" enctype="multipart/form-data">
                            <div class="row">
                            <!-- class="form-control" -->
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <span style="color:red;"><?php echo $account->getError(Constants::$firstNameCharacters); ?></span>
                                        <input type="text" class="form-control" name="firstName" placeholder="First name" value="<?php getInputValue("firstName"); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span style="color:red;"><?php echo $account->getError(Constants::$lastNameCharacters); ?></span>
                                        <input type="text" name="lastName" class="form-control" placeholder="Last name" value="<?php getInputValue("lastName"); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span style="color:red;"><?php echo $account->getError(Constants::$usernameCharacters); ?></span>
                                        <span style="color:red;"><?php echo $account->getError(Constants::$usernameTaken); ?></span>
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php getInputValue("username"); ?>"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span style="color:red;"><?php echo $account->getError(Constants::$emailInvalid); ?></span>
                                        <span style="color:red;"><?php echo $account->getError(Constants::$emailTaken); ?></span>
                                        <input type="email" name="email" class="form-control" placeholder="email" value="<?php getInputValue("email"); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        
                                        <input type="text" name="degree" class="form-control" placeholder="Qualification" value="<?php getInputValue("degree"); ?>"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <select name="exp"   class="form-control" value="<?php getInputValue("exp"); ?>"  required>
                                    <option selected value="0">Less than 1 year</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Year</option>
                                    <option value="3">3 Year</option>
                                    <option value="4">4 Year</option>
                                    <option value="5+">More than 5 Year</option>
                                    </select>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        
                                        <input type="text" name="institute" class="form-control" placeholder="University Name" value="<?php getInputValue("institute"); ?>"  required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span style="color:red;"><?php echo $account->getError(Constants::$passwordsDontMatch); ?></span>
                                        <span style="color:red;"><?php echo $account->getError(Constants::$passwordLength); ?></span>
                                        <span style="color:red;"><?php echo $account->getError(Constants::$passwordnotnumber); ?></span>
                                        <span style="color:red;"><?php echo $account->getError(Constants::$passwordnotlower); ?></span>
                                        <span style="color:red;"><?php echo $account->getError(Constants::$passwordnotuper); ?></span>

                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <input type="password" class="form-control" name="password2" placeholder="Confirm password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <label class="text-left">About You</label>
                                        <textarea name="about" class="form-control" rows="3"  required><?php getInputValue("about"); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <label class="text-left">Upload Cv/resume(only .pdf file)</label>
                                        <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                <input type="submit" name="submit" class="btn btn-block btn-dark" value="Sign Up" >
                                    <!-- <button type="submit" type="submit" name="submit" value="SUBMIT"  class="btn btn-block btn-dark">Sign Up</button> -->
                                </div>
                                <div class="col-lg-12 text-center mt-2">
                                    Already have an account? <a href="../login/" class="text-danger">Sign In</a>
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