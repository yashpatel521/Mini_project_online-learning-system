<?php
	require_once("includes/header.php");
	require_once("includes/check_login.php");
	$detailsMessage = "";
	$passwordMessage = "";
	$photoMessage = "";
	//    $educationMessage = "";
	
	if (isset($_POST['update_profile']))
	{
		$account = new Account($con);
		
		$fname = FormSanitizer::sanitizeFormString($_POST['firstname']);
		$lname = FormSanitizer::sanitizeFormString($_POST['lastname']);
		$mail = FormSanitizer::sanitizeFormEmail($_POST['email']);
		
		
		$learner = new User($con, $userLoggedIn_username);
		
		if ($account->updateDetails($fname, $lname, $userLoggedIn_username, $mail)) {
			$detailsMessage = " <div class='alertSuccess' style='color: #2bad2f;'>
									Details updated successfully!
								</div>";
			     
		} else {
			$errorMessage = $account->getFirstError();
			$detailsMessage = "
								<div class='alertError' style='color: red;'>
									$errorMessage
								</div>";
		}
	}
	
	if (isset($_POST['update_password'])) {
		$acc = new Account($con);
		$old = FormSanitizer::sanitizeFormPassword($_POST['old']);
		$new = FormSanitizer::sanitizeFormPassword($_POST['new']);
		$new2 = FormSanitizer::sanitizeFormPassword($_POST['new2']);
		
		if ($acc->updatePassword($old, $new, $new2, $userLoggedIn_username)) {  // echo "hiii";
			$passwordMessage = "<div class='alertSuccess' style='color: green;'>
									Password updated successfully!
								</div>";
		} else {
			$errorMessage = $acc->getFirstError();
			
			$passwordMessage = "<div class='alertError' style='color: red;'>
									$errorMessage
								</div>";
		}
	}
	$subs_query = $con->prepare("SELECT * FROM subscription WHERE learner_id=$userLoggedIn_id");
	$subs_query->execute();
	if($subs_query->rowCount() > 0)
	{   $exist = 1;
		$sub_row = $subs_query->fetch(PDO::FETCH_ASSOC);
		$sub_start = $sub_row['sub_start'];
		$sub_end = $sub_row['sub_end'];
		$sub_plan = $sub_row['plan'];
		$sub_duration = $sub_row['duration'];
	}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="assests/css/profile2.css">
    <title>Brighter Bee</title>
    <link rel="icon" href="assests/logo/logob1.png">
</head>
<body style="overflow-x:hidden;width:100%">
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="main.php">Home</a>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <div style="border:1px solid black;border-radius:50%;text-align:center;width:50px;height:40px;background-color:#EAEAEA">
                          <p style="font-size:25px;font-weight:bold;color:#0c2e60"><?php echo $userLoggedIn_profile_symbol; ?></p>
                        </div>
                    </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $userLoggedIn_name; ?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Hello, <?php echo $userLoggedIn_username; ?></h1>
                        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with
                            your work and see your courses status.</p>
                         <a href="profile2.php" class="btn btn-info">Back</a>
                        <a href="logout.php" class="btn btn-info">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center" style="margin-bottom:-20%;margin-top:2%;margin-left:-10%;">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <div style="border:1px solid black;border-radius:50%;text-align:center;width:150px;height:150px;background-color:#EAEAEA">
                                        <p style="font-size:88px;font-weight:bold;color:#0c2e60"><?php echo $userLoggedIn_profile_symbol; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <!-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                                <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
	                                    <?php
		                                    $query_cpmlt = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$userLoggedIn_id AND finished=1");
		                                    $query_cpmlt->execute();
		                                    $row = $query_cpmlt->fetch(PDO::FETCH_ASSOC);
		                                    $complete = $query_cpmlt->rowCount();
		
		
		                                    $in_complt = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$userLoggedIn_id AND finished=0");
		                                    $in_complt->execute();
		                                    $incomplete = $in_complt->rowCount();
		
		                                    $enr = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$userLoggedIn_id");
		                                    $enr->execute();
		                                    $enrolled = $enr->rowCount();
	
	                                    ?>

                                        <div>
                                            <span class="heading"><?php echo $enrolled; ?></span>
                                            <span class="description">Enrolled course</span>
                                        </div>
                                        <div>
                                            <span class="heading"> <?php echo $complete; ?></span>
                                            <span class="description">Completed course</span>
                                        </div>
                                        <div>
                                            <span class="heading"><?php echo $incomplete; ?></span>
                                            <span class="description">Course in Progress</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
	                                <?php echo $userLoggedIn_name; ?></span>
                                </h3>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Subscription Plan: <?php isset($exist) ? print($sub_plan) : print(" <span class='text-danger'>Don't have any Plan</span> ");?>
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Duration : <?php isset($exist) ? print($sub_duration) : print(" <span class='text-danger'> - </span> ");?>
                                </div>
                                <!-- <hr class="my-4"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="mb-0">My account</h3>
                                </div>
                                <div class="col text-right">
                                    <p class="btn btn-sm btn-primary">Subscription Validity : <?php  isset($exist) ? print($sub_start." / ".$sub_end) : print("<span >Don't have Subscription</span>");?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $user = new User($con, $userLoggedIn_username);
                                
                                $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
                                $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getlastName();
                                $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
                            
                            ?>
                            <span> <?php echo $detailsMessage; ?> <span>
                            <form method="post">
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-username">Username</label>
                                                <input type="text" name="username" class="form-control form-control-alternative"
                                                   placeholder="Username" readonly value="<?php echo $userLoggedIn_username; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="email" name="email" class="form-control form-control-alternative"
                                                       value="<?php echo $email; ?>" placeholder="yashpatel@gmail.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">First name</label>
                                                <input type="text" name="firstname" class="form-control form-control-alternative"
                                               placeholder="First name" value="<?php echo $firstName; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">Last name</label>
                                                <input type="text" name="lastname" class="form-control form-control-alternative"
                                               placeholder="Last name" value="<?php echo $lastName; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group focused">
                                          <label class="form-control-label" for="input-first-name">Password</label>
                                          <input type="password" id="input-first-name" class="form-control form-control-alternative" placeholder="Password">
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="form-group focused">
                                          <label class="form-control-label" for="input-last-name">Confirm Password</label>
                                          <input type="password" id="input-last-name" class="form-control form-control-alternative" placeholder="Confirm Password">
                                        </div>
                                      </div>
                                    </div>-->
                                    <button type="submit" name="update_profile" class="btn btn-info">Update Profile</a>
                                </div>
                                <!-- Address -->
                            </form>
                            
                            <hr class="my-4">
                            
                            <span><?php echo $passwordMessage; ?></span>
                            <form method="post">
                                <h6 class="heading-small text-muted mb-4">Password Updation</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-first-name">Old Password</label>
                                            <input type="password" name="old" class="form-control form-control-alternative"
                                                   placeholder="Old Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-first-name">New Password</label>
                                            <input type="password" name="new"
                                                   class="form-control form-control-alternative"
                                                   placeholder=" New Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label"
                                                   for="input-last-name">Confirm New Password</label>
                                            <input type="password" name="new2"
                                                   class="form-control form-control-alternative"
                                                   placeholder="Confirm New Password">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="update_password" class="btn btn-info">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</body>
</html>