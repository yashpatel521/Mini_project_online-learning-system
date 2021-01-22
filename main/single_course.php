<?php
    include('includes/header.php');

	
	include ('includes/class/saveLater.php');
	
//	echo $userLoggedIn_id;
	if($_GET['enID'])
	{
		$enID = $_GET['enID'];
		$query = $con->prepare("SELECT * FROM entities WHERE id=$enID");
		$query->execute();
		if($query->rowCount() == 1)
		{
			$c_row = $query->fetch(PDO::FETCH_ASSOC);
			$c_name = $c_row['name'];
			$sort_des = $c_row['short_des'];
			$long_des = $c_row['long_des'];
			$stud_en = $c_row['student_en'];
			$lang = $c_row['language'];
			$thumbnail = $c_row['thumbnail'];
			$overview = $c_row['overview'];
			$t_id = $c_row['teacherid'];
			$ct_id = $c_row['categoryId'];
			$req = $c_row['requirmnet'];
			
			
			$t_query = $con->prepare("SELECT * FROM instructor WHERE id=$t_id");
			$t_query->execute();
			$t_row = $t_query->fetch(PDO::FETCH_ASSOC);
                $t_user_id = $t_row['user_id'];
                $t_about = $t_row['about'];
                $t_img = $t_row['img'];
            
            $t_data = $con->prepare("SELECT * FROM users WHERE id=$t_user_id");
            $t_data->execute();
            $t_data_row = $t_data->fetch(PDO::FETCH_ASSOC);
                $t_data_name = $t_data_row['firstName']." ".$t_data_row['lastName'];
            
			
			$ct = $con->prepare("SELECT * FROM categories WHERE id=$ct_id");
			$ct->execute();
			$ct_name = $ct->fetch(PDO::FETCH_ASSOC);
			
			
			$r_query = $con->prepare("SELECT TRUNCATE(AVG(course_rate),1) AS rate FROM feedback WHERE course_id=$enID");
			$r_query->execute();
			$r_row = $r_query->fetch(PDO::FETCH_ASSOC);
			    $course_rate = $r_row['rate'];
			
			$v_query = $con->prepare("SELECT * FROM videos WHERE entityId=$enID");
			$v_query->execute();
			$v_row = $v_query->fetch(PDO::FETCH_ASSOC);
			    $v_id = $v_row['id'];
			
		}
	}
	
	
	if (isset($_POST['save_later']))
	{
        require_once('includes/check_login.php');
		$save = new saveLater($con);
		$userid = $userLoggedIn_id;
		$course_id = $_POST['en_id'];

//        echo $course_id;
		
		$save->saveLater($userid,$course_id);
	}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('includes/uplinks.php') ?>
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
    
    <!-- heading -->
    <section class="breadcrumb" style="margin-top:6%;
            background-image: url('assests/images/category/web2.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
<!--        <div class="container">-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2><?php echo $c_name; ?></h2>
                            <p><?php echo $ct_name['name']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end heading -->
    <!-- info -->
    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="../<?php echo $thumbnail;?>" style="width:750px;height:375px" alt="">
                        </div>
                        <div class="blog_details">
                            <h2><?php echo $sort_des; ?></h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><span class="ti-bookmark-alt" style="color:blue"></span>Course Type: Subscribed</li>
                                <li><span class="ti-user" style="color:blue"></span>Student Enroll : <?php echo $stud_en; ?></li>
                                <li><span class="ti-announcement" style="color:blue"></span>Language: <?php echo $lang; ?></li>
                                <li><span class="ti-star" style="color:blue"></span>Rating: <?php echo $course_rate == ''? "-":$course_rate ; ?></li>
                            </ul>
                            <h3>This course includes:</h3>
                            <ul class="mb-4">
                                <li><span style="padding-right:5px;color:blue" class="ti-time" ></span>2.5 hours on-demand video</li>
                                <li><span style="padding-right:5px;color:blue" class="ti-reload"></span>Full lifetime access</li>
                                <li><span style="padding-right:5px;color:blue" class="ti-layout-media-center-alt"></span>Access on mobile and Windows</li>
                                <li><span style="padding-right:5px;color:blue" class="ti-medall"></span>Certificate of completion</li>
                            </ul>
                            <h3>Description</h3>
                            <p class="excert" style="text-align: justify"><?php echo $long_des; ?></p>
                            <h3>What I will Learn?</h3>
                            <pre><p><?php echo $overview; ?></p></pre>
                            <h3>Before Starting this course</h3>
                            <pre><p> <?php echo $req; ?></p></pre>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <form>
                                    <input name="vid" value="<?php echo $enID; ?>" hidden>
                                    <!-- Video Modal -->
                                    <?php
                                        if(isset($_SESSION["userLoggedIn"]))
                                        {
                                        	//  require_once('includes/check_login.php');
                                       
                                            $enroll = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$userLoggedIn_id AND video_id=$v_id");
                                            $enroll->execute();
                                            
                                            if($enroll->rowCount() == 1)
                                            {
									?>
                                                <a href="videocourse.php?vid=<?php echo $v_id ?>">
                                                    <button class="primary-bg text-white w-10 btn_1" name="enroll" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <span class="ti-control-play"></span> Continue
                                                    </button>
                                                </a>
									<?php
									        } //end if
									        else
									        {
                 
									?>
                                                <a href="videocourse.php?vid=<?php echo $v_id ?>">
    
                                                    <button class="primary-bg text-white w-10 btn_1" name="enroll" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <span class="ti-control-play"></span> Enroll Now
                                                    </button>
                                                </a>
									<?php
									        } //end else
								        }
                                        else
                                        {
                                    ?>
                                            <a href="videocourse.php?vid=<?php echo $v_id ?>">
                                                <button class="primary-bg text-white w-10 btn_1" name="enroll" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <span class="ti-control-play"></span> Enroll Now
                                                </button>
                                            </a>
                                    <?php
                                        }
                                    ?>
                                </form>
                            </div>
                            <div class="col-4">
                                <form method="post">
                                    <input name="en_id" value="<?php echo $enID;?>" hidden >
                                    <?php
                                    if(isset($_SESSION["userLoggedIn"])){
                                        $query = $con->prepare("SELECT * FROM save_later WHERE learner_id=$userLoggedIn_id AND course_id=$enID");
									    $query->execute();
									    if ($query->rowCount() == 0)
									    {
										    echo'
											<button class="primary-bg text-white w-10 btn_1" name="save_later" type="submit"><span class="ti-plus"></span> Save For Later</button>
											';
									    }
									    else
									    {
										    echo'
											<button class="primary-bg text-white w-10 btn_1" disabled type="submit"><span class="ti-check"></span> Added Already</button>
											';
										   
									    }
                                    }
                                    else{
                                        echo'
											<button class="primary-bg text-white w-10 btn_1" name="save_later" type="submit"><span class="ti-plus"></span> Save For Later</button>
											';
                                    }
                                    ?>
								    <?php
									    
								    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="../<?php echo $t_img; ?>" alt="">
                            <div class="media-body">
                                <h2>Instructor</h2>
                                <a href="#">
                                    <h4 class="mt-2"><?php echo $t_data_name; ?></h4>
                                </a>
                                <p style="text-align: justify"><?php echo $t_about; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                <?php
                                    $category = $con->prepare("SELECT * FROM categories LIMIT 3");
                                    $category->execute();
                                    if($category->rowCount() != 0)
                                    {
                                        while ($row = $category->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo '
                                                <li>
                                                    <a href="single_category.php?id='.$row['id'].'" class="d-flex">
                                                        <p>'.$row['name'].'</p>
                                                    </a>
                                                </li>
                                               ';
                                        }
                                    }
                                ?>
                            </ul>
                        </aside>
                        
                        <aside class="single_sidebar_widget tag_cloud_widget"><h4 class="widget_title">Top Author</h4>
                            <ul class="list">
                                <?php
                                    $author = $con->prepare("SELECT * FROM users WHERE role=2");
                                    $author->execute();
                                    if($author->rowCount() != 0)
                                    {
                                        while ($aut_row = $author->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $name = $aut_row['firstName']." ".$aut_row['lastName'];
                                            
                                            echo'
                                                <li>
                                                    <a href="#">'.$name.'</a>
                                                </li>
                                            ';
                                        }
                                    }
                                    else
                                    {
                                        echo'
                                            <p>Not Found</p>
                                        ';
                                    }
                                ?>
                                
                            </ul>
                        </aside>
                       <!-- <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Stay Updated With Us!</h4>
                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder="Enter email" required>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">Subscribe</button>
                            </form>
                        </aside>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('templates/similar_course.php')?>
    <!-- end info  -->
    <?php  include('includes/footer.php')?>
    <?php  include('includes/downlinks.php')?>
    </body>
</html>