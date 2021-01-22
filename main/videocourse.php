<?php
    include('includes/header.php');
    include('includes/check_login.php');

	include('includes/class/video.php');
	include('includes/class/feedback.php');
	
	$subsc = $con->prepare("SELECT * FROM subscription WHERE learner_id=$userLoggedIn_id");
	$subsc->execute();
	
	    if($subsc->rowCount() == 1)
        {
	        $sub_row = $subsc->fetch(PDO::FETCH_ASSOC);
	        $start = $sub_row['sub_start'];
	        $end = $sub_row['sub_end'];
	        $today = date('Y-m-d');
	        
	        if ($start <= $today && $end >= $today)
	        {
		        $query = $con->prepare("UPDATE users set isSubscribed  = 1 WHERE id = $userLoggedIn_id");
		        $query->execute();
	        }
	        else
            {
	            $query = $con->prepare("UPDATE users set isSubscribed  = 0 WHERE id = $userLoggedIn_id");
	            $query->execute();
	
	            echo '
                <script>alert("Please Take Subscription to Watch Course");
                location.href = "main.php";
                </script>
            ';
            }
        }
	    else
        {
	        $query = $con->prepare("UPDATE users set isSubscribed  = 0 WHERE id = $userLoggedIn_id");
	        $query->execute();
            
            echo '
                <script>alert("Please Take Subscription to Watch Course");
                location.href = "main.php";
                </script>
            ';
        }
	
	if($_GET['vid'])
	{
		$vid = $_GET['vid'];
		
		$query = $con->prepare("SELECT * FROM videos WHERE id=$vid");
		$query->execute();
		$v_row = $query->fetch(PDO::FETCH_ASSOC);
		$video = $v_row['mainvideo'];
		$cid = $v_row['entityId'];
		
		$ch_query = $con->prepare("SELECT * FROM videoprogress WHERE video_id=:vid AND learner_id=$userLoggedIn_id");
		$ch_query->bindValue(":vid",$vid);
		$ch_query->execute();
		if($ch_query->rowCount() == 0)
		{
			//echo $ch_query->rowCount();
			$insert = $con->prepare("INSERT INTO videoprogress(learner_id, video_id, progress, current, finished)
 VALUES ($userLoggedIn_id, $vid,0,0,0)");
			$insert->execute();
			
			$query = $con->prepare("UPDATE entities SET student_en = student_en + 1 WHERE id = $cid");
			$query->execute();
		}
		
		
		
		$c_query = $con->prepare("SELECT * FROM entities WHERE id=$cid");
		$c_query->execute();
		$c_row = $c_query->fetch(PDO::FETCH_ASSOC);
		$c_name = $c_row['name'];
		$long_des = $c_row['long_des'];
		$overview = $c_row['overview'];
		$learn = $c_row['requirmnet'];
		$teacher = $c_row['teacherid'];
		
		$t_query = $con->prepare("SELECT * FROM instructor WHERE id=$teacher");
		$t_query->execute();
		$t_row = $t_query->fetch(PDO::FETCH_ASSOC);
		$t_user_id = $t_row['user_id'];
		$t_about = $t_row['about'];
		$t_img = $t_row['img'];
		
		$t_data = $con->prepare("SELECT * FROM users WHERE id=$t_user_id");
		$t_data->execute();
		$t_data_row = $t_data->fetch(PDO::FETCH_ASSOC);
		$t_data_name = $t_data_row['firstName']." ".$t_data_row['lastName'];
		
		
		$p_query = $con->prepare("SELECT * FROM videoprogress WHERE video_id=$vid AND learner_id=$userLoggedIn_id");
		$p_query->execute();
		$p_row = $p_query->fetch(PDO::FETCH_ASSOC);
		$v_progress = $p_row['progress'];
		$current_ti = $p_row['current'];
		$finish_check = $p_row['finished'];
		
	}
	if(isset($_POST['feedback']))
	{
		$rate = new feedback($con);
		
		$cou_id = $_POST['en_ID'];
		$c_rate = $_POST['course_rate'];
		$i_rate = $_POST['ins_rate'];
		$cmt = $_POST['comment'];
		$i_id = $_POST['insID'];
		$userid = $userLoggedIn_id;
		
		$rate->Rating($c_rate, $i_rate, $cmt, $i_id, $userid, $cou_id);
	}
	
?>
<html lang="en">
<head>
	<?php include('includes/uplinks.php') ?>
        
        <?php
        if($finish_check != 1)
            {
        ?>
            <style>
                audio::-webkit-media-controls-timeline,
                video::-webkit-media-controls-timeline {
                    display: none;
                }
                audio::media-controls-timeline,
                video::media-controls-timeline {
                    display: none;
                }
                video::-internal-media-controls-download-button {
                    display:none;
                }
                
            </style>
        <?php
            }
        ?>
</head>
<body>
<?php 
            if(!isset($_SESSION["userLoggedIn"])){
               
                include('includes/before_login.php');
            }
            else{
                
                include('includes/topbar.php');
            }
         ?>
<section class="blog_area single-post-area section_padding">
    <div class="container">
        <h3 class="p-3"><?php echo $c_name;?></h3>
        <div class="row" >
            <div class="col-md-8 col-sm-12 player">
                <video width="100%" height="auto" id=”myvideo” class="viewer" controls>
                    <source src="../<?php echo $video;?>" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="col">
                <div class="bg">
                    <p style="font-size: 18px;">Course Progress : <span class="cal"><?php echo $v_progress;?></span></p>
                    <p id="complete" style="font-size: 16px;padding: 10px;color: green"></p>
                    <h3 id="cong"></h3>
                    <?php
                        if($finish_check == 1)
                        {
                            echo'
                                <h4 class="text-success">Congratulations, <br>You have Successfully Completed this Course.<br><br>
                                <a href="profile2.php"><span class="text-primary">Get Your Certificate from Your Profile.</a></span>
                                </h4>
                            ';
                        }
                    ?>
                </div>

                <p class="set"></p>

                
                <div hidden><label>progress</label>
                    <input name="progress" value="<?php echo $v_progress;?>" id="cal" ><br>
                    <label>current</label>
                    <input name="curr_time" value="<?php echo $current_ti;?>" id="set_ti" ><br>
                    <label>past</label>
                    <input name="past_time" value="<?php echo $current_ti;?>" id="set_time" ><br>
                    <label>finish</label>
                    <input name="finshied" value="<?php echo $finish_check;?>" id="finished" ><br>
                    <input name="videoID" value="<?php echo $vid;?>" id="videoID" >
                    <input name="l_ID" value="<?php echo $userLoggedIn_id;?>" id="l_ID" >
                    <label>past</label>
                    <input name="xyz" class="xyz" value="<?php echo $current_ti;?>" id="xyz" ><br>
                </div>
            </div>
        </div>

        <br><br>
        <h3>Description</h3>
        <p class="excert" style="text-align: justify"><?php echo $long_des;?></p>
        <br><br>
        <h3>What I will Learn?</h3>
        <pre><p><?php echo $overview;?></p>
			</pre>
        <h3>Before Starting this course</h3>
        <pre><p> <?php echo $learn;?></p></pre>
        <div class="blog-author">
            <div class="media align-items-center">
                <img src="../<?php echo $t_img; ?>" alt="">
                <div class="media-body">
                    <h2>Instructor</h2>
                    <a href="#">
                        <h4><?php echo $t_data_name;?></h4>
                    </a>
                    <p style="text-align: justify"><?php echo $t_about;?></p>
                </div>
            </div>
        </div>

        <div class="comment-form">
            <h4>Feedback</h4>
            <form class="form-contact comment_form" method="post">
                <input name="insID" value="<?php echo $t_user_id; ?>" hidden>
                <input name="en_ID" value="<?php echo $cid; ?>" hidden>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Rate this course</label>
                            <div class="col-sm-6">
                                <input type="number" name="course_rate" class="form-control" placeholder="Rate from 0-5" min="0" max="5">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Rate the Instructor</label>
                            <div class="col-sm-6">
                                <input type="number" name="ins_rate" class="form-control" placeholder="Rate from 0-5" min="0" max="5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" style="font-size: medium" name="comment" cols="6" rows="6" placeholder="Write Comment (Optional)"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
				    <?php
					    $query = $con->prepare("SELECT * FROM feedback WHERE learner_id=$userLoggedIn_id AND course_id=$cid AND teacher_id=$t_user_id");
					    $query->execute();
					    if ($query->rowCount() == 0)
					    {
						    echo '
											<button type="submit" name="feedback" class="button btn_1 button-contactForm">Submit Feedback</button>
										';
					    }
					    else
					    {
						    echo '
											<button type="submit" disabled class="button btn_1 button-contactForm">Already Submitted</button>
										';
					    }
				    ?>

                </div>
            </form>
        </div>
        
    </div>
</section>
<script>
    function timerefresh(time) {
        setTimeout(() => {
            location.reload();
        }, time)
    }
    (() => {
        // timerefresh(1000);
        // setTimeout(() => {
        //     document.getElementsByClassName("blog-author");
        // },50)
        const ref = document.getElementById('#complete');
        console.log(ref);
    })();
</script>
<?php //include('templates/similar_course.php')?>
<?php include('includes/footer.php')?>
<?php  include('includes/downlinks.php')?>
<?php
	if($finish_check != 1)
	{
		echo '<script src="assests/js/vid.js"></script>';
	}
?>

<script src="assests/js/script.js"></script>
</body>
</html>