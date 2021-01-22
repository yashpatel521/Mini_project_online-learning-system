<?php
	require_once("includes/header.php");
	include ("includes/class/saveLater.php");
	
	if (isset($_POST['en_now']))
    {
        $co_id = $_POST['co_id'];
        $vi_id = $_POST['vi_id'];
        
        $query = $con->prepare("DELETE FROM save_later WHERE learner_id=$userLoggedIn_id AND course_id=$co_id");
        $query->execute();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/uplinks.php') ?>
    <link rel="stylesheet" href="assests/css/userprofile.css">
</head>
<body style="background: #f7f8ff;">
<?php 
            if(!isset($_SESSION["userLoggedIn"])){
                include('includes/topbar.php');
            }
            else{
                
                include('includes/before_login.php');
            }
         ?>
<section class="special_cource padding_top" >
    <div class="container"  >
        <h2 class="text-right font-weight-normal">Hello, <?php echo $userLoggedIn_username; ?></h2>

        <div class="container ">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="assests/images/learner/yash.jpg" alt="Img"/>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="profile-head py-5" style="text-transform: uppercase;">
                            <h3 class="font-weight-bold" ><?php echo $userLoggedIn_name; ?></h3>
                            <br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Saved Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress" role="tab" aria-controls="progress" aria-selected="false">Course Progress</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="useredite.php?id=18" class="text-white bg-success p-2 float-right" style="border-radius: 5px;"><i class="ti-pencil"></i>&nbsp;&nbsp;Edit Profile</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
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
                            <p>Overview</p>
                            <a href="#">Enrolled Courses: <?php echo $enrolled; ?></a><br/>
                            <a href="#">Course in Progress: <?php echo $incomplete; ?></a><br/>
                            <a href="#">Complete Course: <?php echo $complete; ?></a>
                            <p>Subscription</p>
                            <a href="#">Status: 1 Month</a><br/>
                            <a href="#">Start Date:10-10-2020</a><br/>
                            <a href="#">End Date:10-11-2020</a><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab " id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <label>User Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $userLoggedIn_username; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>First Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $userLoggedIn_fn; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $userLoggedIn_ln; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $userLoggedIn_email; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class=" border border-primary">
                                    <table class="table table-hover text-center">
                                        <thead>
                                        <tr>
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
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><a href="single_course.php?enID=<?php echo $course_id; ?>"><?php echo $name; ?></a></td>
                                                        <td>
                                                            <form method="post">
                                                                <input name="co_id" value="<?php echo $course_id; ?>" hidden>
                                                                <input name="vi_id" value="<?php echo $video_id; ?>" hidden>
                                                                <button type="submit" name="en_now" class="btn btn-outline-success btn-sm"><a href="videocourse.php?vid=<?php echo $video_id; ?>"><span class="ti-control-play"></span></a></button>
<!--                                                                <a href="videocourse.php?vid=--><?php //echo $video_id; ?><!--"><button type="submit" name="en_now" class="btn btn-outline-success btn-sm"><span class="ti-control-play"></span></button></a>-->
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
                                                    <tr><td class="text-center" colspan="4" style="color: grey">No Saved Course Found</td></tr>
                                                ';
                                            }
										?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                                <div class=" border border-primary">
                                    <table class="table table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Course Name</th>
                                            <th>Status</th>
                                            <th>Certificate</th>
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
                                                        <td>
                                                            <div class="progress border border-dark">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress;?>%"><?php echo $progress;?>%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <form method="post">
                                                            <?php
                                                                if ($status == 1)
                                                                {
                                                                    echo"
                                                                        <a type='button' href='certificate.php?Id=$userLoggedIn_id&vId=$v_id' class='btn btn-outline-success btn-sm'><span class='ti-download'></span></a>
                                                                    ";
                                                                }
                                                                else
                                                                {
	                                                                echo'
                                                                        <button type="button" class="btn btn-outline-info btn-sm"><span class="ti-line-dashed"></span></button>
                                                                    ';
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
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include('includes/footer.php')?>
<?php  include('includes/downlinks.php')?>
</body>
</html>