
<section class="special_cource">
        <div class="container">
            <h1 class="text-center">Similar courses</h1>
            <div class="row">
	            <?php
		            $query = $con->prepare("SELECT * FROM entities WHERE categoryId=$ct_id");
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
                            
                            if ($en_id != $enID)
                            {
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
                            }  //end if
                        }  //end while
                    }  //end if
	            ?>
            </div>
        </div>
    </section>