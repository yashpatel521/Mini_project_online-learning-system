<?php
require_once("include/header.php");
$account = new Account($con);
if(isset($_POST["submit"])) {
      $fname =  FormSanitizer::sanitizeFormString($_POST["firstname"]);
      $lname =  FormSanitizer::sanitizeFormString($_POST["lastname"]);
      $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
      $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
      $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
      $password2 = FormSanitizer::sanitizeFormPassword($_POST["cpassword"]);
      $success = $account->register($fname,$lname,$username, $email, $password, $password2);
      if($success) {
            echo "<script>
            window.alert('Admin Add successfully');
             </script>";
      }
  }
?>
<!DOCTYPE html>
<html>

<body id="page-top">
    <div id="wrapper">
        <?php require_once("include/sidebar.php");?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once("include/topbar.php");?>

                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Admin</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 py-1">
                                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <div class="" id="navbarNav">
                                                <ul class="navbar-nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="update-admin.php">Show Admins</a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="add-admin.php">Add Admin<span class="sr-only">(current)</span></a>
                                                </li>
                                               


                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card shadow mb-3">

                                        <div class="card-header bg-primary py-3">
                                            <p class="text-white m-0 font-weight-bold">Add Admin</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="first_name">
                                                                <strong>FirstName</strong>
                                                                <span class="text-danger"> <?php echo $account->getError(Constants::$firstNameCharacters); ?></span>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="First Name" name="firstname" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="last_name">
                                                                <strong>LastName</strong>
                                                                <span class="text-danger"> <?php echo $account->getError(Constants::$lastNameCharacters); ?></span>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Last Name" name="lastname" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="username"><strong>Username</strong>
                                                            <span class="text-danger"> <?php echo $account->getError(Constants::$usernameCharacters); ?></span>
                                                            <span class="text-danger"> <?php echo $account->getError(Constants::$usernameTaken); ?></span>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="username" name="username" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="email"><strong>EmailAddress</strong>
                                                            <span class="text-danger"> <?php echo $account->getError(Constants::$emailInvalid); ?></span>
                                                            <span class="text-danger"> <?php echo $account->getError(Constants::$emailTaken); ?></span>
                                                            </label>
                                                            <input  class="form-control" type="email" placeholder="user@example.com" name="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="first_name"><strong>Password</strong>
                                                            <span class="text-danger">  <?php echo $account->getError(Constants::$passwordLength); ?></span>
                                                            </label>
                                                        <input class="form-control" type="password" placeholder="password" name="password" required></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="last_name"><strong>Confirm Password</strong></span>
                                                            <span class="text-danger">   <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                                                            </label>
                                                            <input class="form-control" type="password" placeholder="confirm password" name="cpassword" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><button class="btn btn-primary btn-sm" name="submit" type="submit">Submit</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
