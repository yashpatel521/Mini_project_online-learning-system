<?php
require_once("include/header.php");


$detailsMessage = "";
$passwordMessage = "";
$photoMessage = "";

if(isset($_POST["saveDetailsButton"])){
    $account = new Account($con);
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
   

    $user = new User($con, $adminLoggedIn);



    if($account->updateDetails($firstName , $lastName  ,$adminLoggedIn , $email)){
        $detailsMessage = " <div class='alertSuccess' style='color: green;'>
                                Details updated successfully!
                            </div>";
                        }

    else {
        $errorMessage = $account->getFirstError();

        $detailsMessage =   "<div class='alertError' style='color: red;'>
                                $errorMessage
                            </div>";
    }


}

if(isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $adminLoggedIn)) {
        $passwordMessage = "<div class='alertSuccess' style='color: green;'>
                                Password updated successfully!
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();

        $passwordMessage = "<div class='alertError' style='color: red;'>
                                $errorMessage
                            </div>";
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
                <h3 class="text-dark mb-4">Profile</h3>
                <div class="row mb-3">
                <?php
                        $user = new User($con, $adminLoggedIn);
                        $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] :$user->getFirstName();
                        $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] :$user->getlastName();
                        $email = isset($_POST["email"]) ? $_POST["email"] :$user->getEmail();

                    ?>
                    <div class="col-lg-8">

                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header bg-primary py-3">
                                        <p class="text-white m-0 font-weight-bold">Admin Details</p>
                                    </div>
                                    <div class="card-body">
                                    <span> <?php echo $detailsMessage; ?> <span>
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" readonly type="text" placeholder="username" name="username" value="<?php echo $adminLoggedIn;?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" placeholder="user@example.com" name="email"  value = "<?php echo $email; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" placeholder="First name" name="firstName" value = "<?php echo $firstName; ?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" placeholder="Last Name" name="lastName" value = "<?php echo $lastName; ?>"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="saveDetailsButton">Save Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header bg-primary py-3">
                                        <p class="text-white m-0 font-weight-bold">Password Settings</p>
                                    </div>
                                    <div class="card-body"><span><?php echo $passwordMessage; ?></span>
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label><strong>Old Password</strong></label><input class="form-control" type="password" placeholder="Enter Old Password" name="oldPassword"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label><strong>New Password</strong></label><input class="form-control" type="password" placeholder="Enter New Password" name="newPassword"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label><strong>Confirm Password</strong></label><input class="form-control" type="password" placeholder="Enter Confirm Password" name="newPassword2"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="savePasswordButton">Update&nbsp;Password</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRIXIrqiW3R5OstWAjkuFvNwvjYHRaTmwEQWg&usqp=CAU" width="160" height="160"><br>
                              <p class="text-uppercase font-weight-bold">  <?php echo $firstName." ".$lastName;?></p>
                            </div>
                        </div>
                       
                    </div>
                </div>

            </div>
        </div>

    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
