<?php
    require_once("includes/header.php");
    include('includes/check_login.php');
	include ("includes/class/saveLater.php");
	
	if (isset($_POST['en_now']))
	{
		$co_id = $_POST['co_id'];
		$vi_id = $_POST['vi_id'];
		
		$query = $con->prepare("DELETE FROM save_later WHERE learner_id=$userLoggedIn_id AND course_id=$co_id");
		$query->execute();
		
		$ch_query = $con->prepare("SELECT * FROM videoprogress WHERE video_id=:vi_id AND learner_id=$userLoggedIn_id");
		$ch_query->bindValue(":vi_id",$vi_id);
		$ch_query->execute();
		if($ch_query->rowCount() == 0)
		{
			//echo $ch_query->rowCount();
			$insert = $con->prepare("INSERT INTO videoprogress(learner_id, video_id, progress, current, finished)
            VALUES ($userLoggedIn_id, $vid,0,0,0)");
			$insert->execute();
		}
		
		header("Location: videocourse.php?vid=$vi_id");
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
		
		$today = date('Y-m-d');
		
		if ($sub_start <= $today && $sub_end >= $today)
		{
			$sub_status = "<span class='text-success'>Active</span>";
		}
		else
        {
	        $sub_status = "<span class='text-danger'>Expired</span>";
        }
    }
    else {
        $sub_status = "<span class='text-danger'>Not Subscribed</span>";
    }
//	else
//    {
//        $exist = 0;
//        $sub_plan = "Don't have any Plan";
//        $sub_start = "";
//        $sub_end = "";
//    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <?php include('includes/uplinks.php') ?>
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
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="main.php" >Home</a>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and see your courses status.</p>
                        <a href="profileedit2.php" class="btn btn-info">Edit profile</a>
                        <a href="logout.php" class="btn btn-info">Logout</a>
                        <a onclick="window.history.back()" class="btn btn-info">Back</a>
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
                                    <div style="border:1px solid ;border-radius:50%;text-align:center;width:150px;padding:5px;height:150px;background-color:#EAEAEA">
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
                            <hr class="my-4">
                            <div class="text-center">
                                <h3 style="font-size: 20px">
	                                <?php echo $userLoggedIn_name; ?><span class="font-weight-light"></span>
                                </h3>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Subscription Plan: <?php isset($exist) ? print($sub_plan) : print(" <span class='text-danger'>Don't have any Plan</span> ");?>
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Duration : <?php isset($exist) ? print($sub_duration) : print(" <span class='text-danger'> - </span> ");?>
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Status : <?php echo $sub_status; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-profile shadow mt-4">
                        <h6 class="heading-small text-muted mb-4 p-3">Saved Courses information</h6>
                        <table style="width:100%;text-align:center;" class="mb-4">
                            <thead>
                                <tr style="font-size: 14px">
                                    <th>Sr No.</th>
                                    <th>Course Name</th>
                                    <th>Enroll Now</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
	                            $query = $con->prepare("SELECT * FROM save_later WHERE learner_id=$userLoggedIn_id");
	                            $query->execute();
	                            if($query->rowCount() != 0 )
	                            {   $cnt = 0;
		                            while($row = $query->fetch(PDO::FETCH_ASSOC))
		                            {   $cnt++;
			                            $course_id = $row['course_id'];
			
			                            $c_query = $con->prepare("SELECT * FROM entities WHERE id=$course_id");
			                            $c_query->execute();
			                            $c_row = $c_query->fetch(PDO::FETCH_ASSOC);
			                            $name = $c_row['name'];
			
			                            $vi_query = $con->prepare("SELECT * FROM videos WHERE entityId=$course_id");
			                            $vi_query->execute();
			                            $vi_row = $vi_query->fetch(PDO::FETCH_ASSOC);
			                            $video_id = $vi_row['id'];
			                ?>
                                        <tr style="font-size: 12px">
                                            <td><?php echo $cnt; ?></td>
                                            <td><a href="single_course.php?enID=<?php echo $course_id; ?>"><?php echo $name; ?></a></td>
                                            <td>
                                                <form method="post">
                                                    <input name="co_id" value="<?php echo $course_id; ?>" hidden>
                                                    <input name="vi_id" value="<?php echo $video_id; ?>" hidden>
<!--                                                    <button type="submit" name="en_now" class="btn btn-outline-success btn-sm"><a href="videocourse.php?vid=--><?php //echo $video_id; ?><!--"><span class="ti-control-play"></span></a></button>-->
                                                    <button type="submit" name="en_now" class="btn btn-outline-success btn-sm"><span class="ti-control-play"></span></button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="delete.php?del=<?php echo $course_id; ?>&uid=<?php echo $userLoggedIn_id;?>" type="button" class="btn btn-outline-danger btn-sm"><span class="ti-trash"></span></a>
                                            </td>
                                        </tr>
					                    <?php
				                    } //end while
			                    }  //end if
	                            else
	                            {
		                            echo '
                                        <tr><td class="text-center p-4" colspan="4" style="color: grey">No Saved Course Found</td></tr>
                                    ';
	                            }
		                    ?>
                            </tbody>
                        </table>
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
                                    <p style="font-size: 14px;padding: 5px" class="btn btn-primary font-weight-300">
                                        Subscription Validity : <?php  isset($exist) ? print($sub_start." / ".$sub_end) : print("<span >Don't have Subscription</span>");?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-username">Username</label>
                                                <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="<?php echo $userLoggedIn_username; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="<?php echo $userLoggedIn_email; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">First name</label>
                                                <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="<?php echo $userLoggedIn_fn; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">Last name</label>
                                                <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo $userLoggedIn_ln; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Courses information</h6>
                                <div class="col-lg-12">
                                    <table style="width:100%;text-align:center;">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Course Name</th>
                                                <th>Status</th>
                                                <th>Ceritificate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
	                                        $query = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$userLoggedIn_id");
	                                        $query->execute();
	                                        if($query->rowCount() != 0 )
	                                        {   $cnt = 0;
	                                            while($row = $query->fetch(PDO::FETCH_ASSOC))
                                                {   $cnt++;
                                                    $v_id = $row['video_id'];
                                                    $status = $row['finished'];
                                                    //							                        $progress = $row['progress'];
                                                    if($row['progress'] >= 98){
                                                        $progress=100;
                                                    }
                                                    else{
                                                        $progress = $row['progress'];
                                                    }
            
                                                    $v_query = $con->prepare("SELECT * FROM videos WHERE id=$v_id");
                                                    $v_query->execute();
                                                    $v_row = $v_query->fetch(PDO::FETCH_ASSOC);
                                                    $course_id = $v_row['entityId'];
        
                                                    $c_query = $con->prepare("SELECT * FROM entities WHERE id=$course_id");
                                                    $c_query->execute();
                                                    $c_row = $c_query->fetch(PDO::FETCH_ASSOC);
                                                    $name = $c_row['name'];
            
                                                    $cer_query = $con->prepare("SELECT * FROM certificate WHERE learner_id=$userLoggedIn_id AND course_id=$course_id");
                                                    $cer_query->execute();
                                                    $cer_row = $cer_query->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><a href="single_course.php?enID=<?php echo $course_id; ?>"><?php echo $name; ?></a></td>
                                                        <td class="pt-2">
                                                            <div class="progress border border-dark" style="height: 20px">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress;?>%"><?php echo $progress;?>%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <form method="post">
                                                                <?php
                                                                    if ($status == 1)
                                                                    {
                                                                        $Id = base64_encode($userLoggedIn_id);
                                                                        $vId = base64_encode($v_id);
                                                                        echo"
                                                                                <a type='button' target='_blank' href='certificate.php?Id=$Id&vId=$vId' class='btn btn-outline-success btn-sm'><span class='ti-download'></span></a>
                                                                            ";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo"
                                                                                <a type='button' href='delete.php?endel=$v_id&lerid=$userLoggedIn_id' class='btn btn-outline-danger btn-sm'><span class='ti-trash'></span></a>
                                                                            ";
                                                                        //<button type="button" class="btn btn-outline-info btn-sm"><span class="ti-line-dashed"></span></button>
                                                                    }
                                                                ?>
                                                            </form>
                                                        </td>
                                                    </tr>
		                                <?php
	                                            } //end while
	                                        }  //end if
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
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