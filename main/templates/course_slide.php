<?php
    require_once ('includes/config.php');
?>

<section class="pt-5 pb-5">
  <div class="container">
  <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <h2>Popular Courses</h2>
                    </div>
                </div>
            </div>
    <div class="row">
        <div class="col-6">
            <h3 class="mb-3">Courses by Top Rated</h3>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                <span class="ti-angle-left"></span>
            </a>
            <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                <span class="ti-angle-right"></span>
            </a>
        </div>
        <div class="col-12">
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row ">
                            <?php
                                $query = $con->prepare("SELECT course_id,TRUNCATE(AVG(course_rate),1) AS rate,TRUNCATE(AVG(ins_rate),1) AS ins_rate,COUNT(learner_id) AS total FROM feedback WHERE course_rate > 2 GROUP BY course_id LIMIT 3");
                                $query->execute();
                                if($query->rowCount() > 0)
                                {
                                    while($row = $query->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $en_id = $row['course_id'];
	                                    $rate = $row['rate'];
	                                    $count = $row['total'];
	                                    $ins_rate = $row['ins_rate'];
	                                    
                                        $cousre = $con->prepare("SELECT * FROM entities WHERE id=$en_id");
                                        $cousre->execute();
                                        $c_row = $cousre->fetch(PDO::FETCH_ASSOC);
                                            $name = $c_row['name'];
                                            $enroll = $c_row['student_en'];
                                            $thumb = $c_row['thumbnail'];
                                            $en_ins_id = $c_row['teacherid'];
	
	                                    $ins_query = $con->prepare("SELECT * FROM instructor WHERE id=$en_ins_id");
	                                    $ins_query->execute();
	                                    $ins_row = $ins_query->fetch(PDO::FETCH_ASSOC);
	                                    $ins_id = $ins_row['user_id'];
	
	                                    $ins_data = $con->prepare("SELECT * FROM users WHERE id=$ins_id");
	                                    $ins_data->execute();
	                                    $ins_data_row = $ins_data->fetch(PDO::FETCH_ASSOC);
	                                    $ins_data_name = $ins_data_row['firstName']." ".$ins_data_row['lastName'];
                                            
                            ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img src="../<?php echo $thumb;?>" class="special_img" alt="" height="200px" width="100%" style="object-fit: fill">
                                                <div class="card-body">
                                                    <a href="single_course.php?enID=<?php echo $en_id; ?>"><h4 class="card-title"><?php echo $name;?></h4></a>
                                                    <p class="card-text">Enroll By: <?php echo $enroll;?> Learner</p>
                                                    <p class="card-text">Rating <span class="ti-star" style="color:blue"></span>  <?php echo $rate;?> (by <?php echo $count;?> Learner)</p>
                                                    <hr>
                                                    <p>Conduct By: <b><a href="#"><?php echo $ins_data_name;?></a></b> (Rating: <span class="ti-star" style="color:blue"></span> <?php echo $ins_rate;?>)</p>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
	                        <?php
		                        $query = $con->prepare("SELECT course_id,TRUNCATE(AVG(course_rate),1) AS rate,TRUNCATE(AVG(ins_rate),1) AS ins_rate,COUNT(learner_id) AS total FROM feedback WHERE course_rate >2 GROUP BY course_id  LIMIT 3,3");
		                        $query->execute();
		                        if($query->rowCount() > 0)
		                        {
			                        while($row = $query->fetch(PDO::FETCH_ASSOC))
			                        {
				                        $en_id = $row['course_id'];
				                        $rate = $row['rate'];
				                        $count = $row['total'];
				                        $ins_rate = $row['ins_rate'];
				
				                        $cousre = $con->prepare("SELECT * FROM entities WHERE id=$en_id");
				                        $cousre->execute();
				                        $c_row = $cousre->fetch(PDO::FETCH_ASSOC);
				                        $name = $c_row['name'];
				                        $enroll = $c_row['student_en'];
				                        $thumb = $c_row['thumbnail'];
				                        $en_ins_id = $c_row['teacherid'];
				
				                        $ins_query = $con->prepare("SELECT * FROM instructor WHERE id=$en_ins_id");
				                        $ins_query->execute();
				                        $ins_row = $ins_query->fetch(PDO::FETCH_ASSOC);
				                        $ins_id = $ins_row['user_id'];
				
				                        $ins_data = $con->prepare("SELECT * FROM users WHERE id=$ins_id");
				                        $ins_data->execute();
				                        $ins_data_row = $ins_data->fetch(PDO::FETCH_ASSOC);
				                        $ins_data_name = $ins_data_row['firstName']." ".$ins_data_row['lastName'];
				
				                        ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img src="../<?php echo $thumb;?>" class="special_img" alt="" height="200px" width="100%" style="object-fit: fill">
                                                <div class="card-body">
                                                    <a href="single_course.php?enID=<?php echo $en_id; ?>"><h4 class="card-title"><?php echo $name;?></h4></a>
                                                    <p class="card-text">Enroll By: <?php echo $enroll;?> Learner</p>
                                                    <p class="card-text">Rating <span class="ti-star" style="color:blue"></span>  <?php echo $rate;?> (by <?php echo $count;?> Learner)</p>
                                                    <hr>
                                                    <p>Conduct By: <b><a href="#"><?php echo $ins_data_name;?></a></b> (Rating: <span class="ti-star" style="color:blue"></span> <?php echo $ins_rate;?>)</p>
                                                </div>
                                            </div>
                                        </div>
				                        <?php
			                        }
		                        }
	                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>