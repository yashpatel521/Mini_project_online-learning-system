<?php
    include('includes/header.php');
    
    $_SESSION["urlridirect"] = $_SERVER['REQUEST_URI'];

	if($_GET['id'])
	{
		$ct_id = $_GET['id'];
		
		$query = $con->prepare("SELECT * FROM categories WHERE id=$ct_id");
		$query->execute();
		if($query->rowCount() == 1)
		{
			$row = $query->fetch(PDO::FETCH_ASSOC);
			$ct_name = $row['name'];
			
			$query_co = $con->prepare("SELECT * FROM entities WHERE categoryId=$ct_id AND teacherid IS NOT NULL AND status=1" );
			$query_co->execute();
		}
	}
	else
	{
		header("Location: main.php");
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
    
    <section class="breadcrumb" style="margin-top:6%;
            background-image: url('assests/images/category/web2.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2><?php echo $ct_name; ?></h2>
                            <p>Over <?php echo $query_co->rowCount(); ?> Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="special_cource padding_top">
        <div class="container">
            <div class="row">
		        <?php
			        $query = $con->prepare("SELECT * FROM entities WHERE categoryId=$ct_id AND teacherid IS NOT NULL AND status=1");
			        $query->execute();
			        if ($query->rowCount()!=0)
			        {
				        while ($ct_row = $query->fetch(PDO::FETCH_ASSOC))
				        {
					        $en_id = $ct_row['id'];
					        $en_name = $ct_row['name'];
					        $en_thumb = $ct_row['thumbnail'];
					        $en_stud = $ct_row['student_en'];
					        $en_ins_id = $ct_row['teacherid'];
					
					        $ins_query = $con->prepare("SELECT * FROM instructor WHERE id=$en_ins_id");
					        $ins_query->execute();
					        $ins_row = $ins_query->fetch(PDO::FETCH_ASSOC);
					            $ins_id = $ins_row['user_id'];
					            $ins_img = $ins_row['img'];
					        
					        $ins_data = $con->prepare("SELECT * FROM users WHERE id=$ins_id");
					        $ins_data->execute();
					        $ins_data_row = $ins_data->fetch(PDO::FETCH_ASSOC);
					            $ins_data_name = $ins_data_row['firstName']." ".$ins_data_row['lastName'];
					
					        $r_query = $con->prepare("SELECT TRUNCATE(AVG(course_rate),1) AS rate, COUNT(learner_id) AS total FROM feedback WHERE course_id=$en_id");
					        $r_query->execute();
                                $r_row = $r_query->fetch(PDO::FETCH_ASSOC);
                                $course_rate = $r_row['rate'];
                                $learner_count = $r_row['total'];
					
					
				?>
                            <div class="col-sm-6 col-lg-3 p-3" >
                                <div class="single_special_cource">
                                    <img src="../<?php echo $en_thumb;?>" class="special_img" alt="" height="150px" width="100%" style="object-fit: fill">
                                    <div class="special_cource_text">
                                        <a href="single_course.php?enID=<?php echo $en_id;?>">
                                            <h3><?php echo $en_name;?></h3>
                                        </a>
                                        <p>Enrolled by <?php echo $en_stud;?> Student</p>
                                        <p>Rating : <?php echo $course_rate;?> <span class="ti-star" style="color:blue"></span> (by <?php echo $learner_count;?> learner)</p>
                                        <div class="author_info">
                                            <div class="author_img">
                                                <img src="../<?php echo $ins_img; ?>" alt="">
                                                <div class="author_info_text">
                                                    <p>Conduct by:</p>
                                                    <h5><a href="#"><?php echo $ins_data_name;?></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
				<?php
				        }  //end while
			        }  //end if
		        ?>


            </div>
        </div>
    </section>
    <br>
    <?php include('includes/footer.php')?>
        <?php  include('includes/downlinks.php')?>
    </body>
</html>