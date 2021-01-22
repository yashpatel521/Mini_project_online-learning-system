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
    $degree = FormSanitizer::sanitizeString($_POST["degree"]);
    $exp = FormSanitizer::sanitizeString($_POST["exp"]);
    $about = FormSanitizer::sanitizeString($_POST["about"]);
   



    if($account->updateDetails($firstName , $lastName  ,$instructorLoggedIn , $email)){
        $detailsMessage = " <div class='alertSuccess' style='color: green;'>
                                Details updated successfully!
                            </div>";
                            header("Location: profile.php");
                        }
    if($account->updateinsDetails($degree , $about , $exp ,$instructorLoggedInId)){
        $detailsMessage = " <div class='alertSuccess' style='color: green;'>
                                Details updated successfully!
                            </div>";
                            header("Location: profile.php");
                        }

    else {
        $errorMessage = $account->getFirstError();

        $detailsMessage =   "<div class='alertError' style='color: red;'>
                                $errorMessage
                            </div>";
    }


}


if(isset($_POST["change"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["old"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["pw"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["cpw"]);

    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $instructorLoggedIn)) {
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
if(isset($_POST["photochange"])) {
    $account = new Account($con);

    $filename= $_FILES["photo"]["name"];
    $tempname= $_FILES["photo"]["tmp_name"];
    $folder = "../entities/ins/".$instructorLoggedInId."_".$filename;
    $folder_q = "entities/ins/".$instructorLoggedInId."_".$filename;
    move_uploaded_file($tempname,$folder);

    if($account->updateimg($folder_q , $instructorLoggedInId)){
        $photoMessage = " <div class='alertSuccess' style='color: green;'>
                                Details updated successfully!
                            </div>";
                            header("Location: profile.php");
                        }

    else {
        $errorMessage = $account->getFirstError();

        $photoMessage =   "<div class='alertError' style='color: red;'>
                                $errorMessage
                            </div>";
    }
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php require_once("include/topbar.php"); ?>
        <?php require_once("include/sidebar.php"); ?>
     
        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Profile</h2>
                    <?php
                        $user = new User($con, $instructorLoggedIn);
                        $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] :$user->getFirstName();
                        $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] :$user->getlastName();
                        $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
                        $name = $firstName . " " . $lastName;

                    ?>
                    <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item "><a href="index.php" class="text-primary">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">User-Profile</li>
                                </ol>
                            </nav>
                        </div>
                      
                        <div class="d-flex align-items-center">
                            <br>
                        </div>

                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                        <?php require_once("include/time.php");?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Details</h4>
                                    <span> <?php echo $detailsMessage; ?> <span>

                                    <form  method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Firstname:</label>
                                                        <input name="firstName" class="form-control" type="text" 
                                                        data-toggle="tooltip" data-placement="bottom" title="Firstname" value="<?php echo $firstName;?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Lastname:</label>
                                                        <input name="lastName" class="form-control" type="text" 
                                                        data-toggle="tooltip" data-placement="bottom" title="lastname" value="<?php echo $lastName;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Username:</label>
                                                        <input name="username" class="form-control" type="text" 
                                                        data-toggle="tooltip" data-placement="bottom" title="Username (can't change)" value="<?php echo $instructorLoggedIn;?>" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Email:</label>
                                                        <input name="email" class="form-control" type="text"
                                                         data-toggle="tooltip" data-placement="bottom" title="Email" value="<?php echo $email;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Qualification:</label>
                                                        <input name="degree" class="form-control" type="text" 
                                                        data-toggle="tooltip" data-placement="top" title="Qualification" value="<?php echo $degree;?>"  required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-primary">Experience:</label>
                                                        <input name="exp" class="form-control" type="text"
                                                         data-toggle="tooltip" data-placement="bottom" title="Experience" value="<?php echo $exp;?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">About You:</label>
                                                        <textarea class="form-control" name="about" rows="4"
                                                         data-toggle="tooltip" data-placement="bottom" title="About you"  required><?php echo $aboutu;?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="text">
                                                <button type="submit" class="btn btn-info" name="saveDetailsButton">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-8 text-center mb-4">
                                                <img src="../<?php echo $img; ?>" alt="image" class="rounded-circle" width="200">
                                            <h3 class="mt-3 text-capitalize"><?php echo $name; ?></h3>
                                        </div>
                                        <div class="col-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

                            <div class="card">
                                <div class="card-body">
                                <span> <?php echo $photoMessage; ?> <span>

                                    <form  method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group">

                                                <label class="text-primary">Change Photo:</label>
                                               
                                                <input name="photo" class="form-control" placeholder="sa" title="sdsdf" type="file" accept="image/*" required>
                                            </div>  
                                                                                
                                        </div>
                                        <div class="form-actions">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info" name="photochange">Submit</button>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Change Password</h4><span><?php echo $passwordMessage; ?></span>
                                    <form  method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Old Password</label>
                                                        <input name="old" class="form-control" type="password" data-toggle="tooltip" data-placement="bottom" title="Enter correct old password" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">New Password</label>
                                                        <input name="pw" class="form-control" type="password" data-toggle="tooltip" data-placement="bottom" title="new password with atleast one number,one lowercase letter ,one uppercase letter" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-primary">Confirm Password</label>
                                                        <input name="cpw" class="form-control" type="password" data-toggle="tooltip" data-placement="bottom" title="confirm password same as a new password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div >
                                                <button type="submit" class="btn btn-info" name="change">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>                        
                </div>
            </div>
        </div>
    </div>  
    <?php require_once("include/class/script.php"); ?>
</body>
</html>