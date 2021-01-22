<?php
	require_once("includes/header.php");
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
		
		
		$learner = new User($con,$userLoggedIn_username);
		
		if ($account->updateDetails($fname,$lname,$userLoggedIn_username,$mail))
		{
			$detailsMessage = " <div class='alertSuccess' style='color: #2bad2f;'>
								    Details updated successfully!
							    </div>";
		}
		else
		{
			$errorMessage = $account->getFirstError();
			$detailsMessage = "
                                <div class='alertError' style='color: red;'>
								    $errorMessage
							    </div>";
		}
	}
	
	if (isset($_POST['update_password']))
	{
		$acc = new Account($con);
		$old = FormSanitizer::sanitizeFormPassword($_POST['old']);
		$new = FormSanitizer::sanitizeFormPassword($_POST['new']);
		$new2 = FormSanitizer::sanitizeFormPassword($_POST['new2']);
		
		if($acc->updatePassword($old,$new,$new2,$userLoggedIn_username))
		{  // echo "hiii";
			$passwordMessage = "<div class='alertSuccess' style='color: green;'>
									Password updated successfully!
								</div>";
		}
		else
		{
			$errorMessage = $acc->getFirstError();
			
			$passwordMessage = "<div class='alertError' style='color: red;'>
								    $errorMessage
							    </div>";
		}
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/uplinks.php') ?>
    <link rel="stylesheet" href="assests/css/userprofile.css">
    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
</head>

<body>
<?php 
            if(!isset($_SESSION["userLoggedIn"])){
                include('includes/topbar.php');
            }
            else{
                
                include('includes/before_login.php');
            }
         ?><section class="special_cource padding_top">
    <div class="container">
        <h2 class="text-right"><i class="ti-hand-open"></i>&nbsp;&nbsp;Hello, Yash</h2>
        <div class="container p-5 ">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="assests/images/learner/yash.jpg" alt="Img"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h3 class="font-weight-bold">Yash Patel</h3>
                        <h6>Web Developer and Designer</h6><br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work  my-1">
                        <h4 class="font-weight-bold">Overview</h4>
                        <div class="pl-3">
                            <h6 class="font-weight-normal">Enrolled Courses: 6</h6>
                            <h6 class="font-weight-normal">Inprogress: 4</h6>
                            <h6 class="font-weight-normal">Completed: 2</h6>
                        </div>
                        <br>
                        <h4 class="font-weight-bold">Subscription</h4>
                        <div class="pl-3">
                            <h6 class="font-weight-normal">Status: 1 Month</h6>
                            <h6 class="font-weight-normal">Start Date: 10-10-2020</h6>
                            <h6 class="font-weight-normal">End Date: 10-11-2020</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
								
								<?php
									$user = new User($con, $userLoggedIn_username);
									$firstName = isset($_POST["firstName"]) ? $_POST["firstName"] :$user->getFirstName();
									$lastName = isset($_POST["lastName"]) ? $_POST["lastName"] :$user->getlastName();
									$email = isset($_POST["email"]) ? $_POST["email"] :$user->getEmail();
//									$tel = isset($_POST["phone"]) ? $_POST["phone"] :$user->getphone();
									//		                $img = isset($_POST["img"]) ? $_POST["img"] :$user->getimg();
//									$uni = isset($_POST['uni']) ? $_POST['uni'] : $user->getUni();
								
								?>

                                <div class="col">
                                            <span > <?php echo $detailsMessage; ?> <span>
                                            <form method="post">
                                                <fieldset style="border: 4px solid #d1f2ff;padding: 30px;border-radius: 10px">
                                                    <legend class="px-4 bg" style="width: auto;border-radius: 50px;"><h4 class="text-white pt-2">Personal Info</h4></legend>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label >User Name</label>
                                                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $userLoggedIn_username; ?>" name="username" value="Yash521">
                                                        </div>
                                                        <div class="col">
                                                            <label >First Name</label>
                                                            <input class="form-control form-control-sm" value="<?php echo $userLoggedIn_fn; ?>" name="firstname" type="text" placeholder="Yash Patel">
                                                        </div>
                                                        <div class="col">
                                                            <label >Last Name</label>
                                                            <input class="form-control form-control-sm" value="<?php echo $userLoggedIn_ln; ?>" name="lastname" type="text" placeholder="Yash Patel">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label >Email Address</label>
                                                            <input class="form-control form-control-sm" value="<?php echo $userLoggedIn_email; ?>" type="email" placeholder="user@example.com" name="email">
                                                        </div>
                                                        
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <br>
                                                            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                </div>

                            </div>

                            <br><br>
                            <div class="row">
                                <div class="col">
                                    <span><?php echo $passwordMessage; ?></span>
                                    <form method="post">
                                        <fieldset style="border: 4px solid #d1f2ff;padding: 30px;border-radius: 10px">
                                            <legend class="px-4 bg" style="width: auto;border-radius: 50px;"><h4 class="text-white pt-2">Password Info</h4></legend>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <label >Old Password</label>
                                                        <input class="form-control form-control-sm p-3" name="old" type="password" placeholder="Current Password">
                                                    </div>
                                                    <div class="row">
                                                        <label class="mt-3">New Password</label>
                                                        <input class="form-control form-control-sm p-3" name="new" type="password" placeholder="New Password">
                                                    </div>
                                                    <div class="row">
                                                        <label class="mt-3">Confirm Password</label>
                                                        <input class="form-control form-control-sm p-3" name="new2" type="password" placeholder="Confirm Password">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <br>
                                                            <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            </legend>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="col">
                                    <form>
                                        <fieldset style="border: 4px solid #d1f2ff;padding: 30px;border-radius: 10px">
                                            <legend class="px-4 bg" style="width: auto;border-radius: 50px;"><h4 class="text-white pt-2">Profile Info</h4></legend>
                                            <div class="row">
                                                <input type="file" name="img[]" class="file" accept="image/*">
                                                <div class="input-group my-3">
                                                    <input type="text" class="form-control" disabled placeholder="Choose Profile" id="file">
                                                    <div class="input-group-append">
                                                        <button type="button" class="browse btn btn-primary">Browse...</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <img src="" id="preview" style="width:150px;height:150px" class="img-thumbnail">
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer.php')?>
<?php  include('includes/downlinks.php')?>
<script>
    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>
</body>
</html>