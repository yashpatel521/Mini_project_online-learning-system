<?php
	require_once ('includes/config.php');
?>
    <section class="blog_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <h2>CATEGORIES</h2>
                    </div>
                </div>
            </div>
            <div class="row">
	            <?php
		            $query = $con->prepare("SELECT * FROM categories");
		            $query->execute();
		            if($query->rowCount() != 0)
		            {
			            while ($row = $query->fetch(PDO::FETCH_ASSOC))
			            {
				            $name = $row['name'];
				            $id = $row['id'];
				            $img = $row['img'];
				
				
				            $sum_query = $con->prepare("SELECT COUNT(name) AS sum FROM entities WHERE categoryId=$id AND teacherid IS NOT NULL");
				            $sum_query->execute();
				            $sum_row = $sum_query->fetch(PDO::FETCH_ASSOC);
//                            $thumbnail = $sum_row['thumbnail'];
				
				            ?>
                            <div class="col-sm-6 col-lg-3 col-xl-3 p-3">
                                <div class="single-home-blog">
                                    <div class="card text-center">
                                        <img src="../<?php echo $img;?>" class="card-img-top" style="width:100%;height:200px;object-fit:fill;" alt="img">
                                        <div class="card-body">
                                            <a href="single_category.php?id=<?php echo $id;?>">
                                                <h5 class="card-title"><?php echo $name;?></h5>
                                            </a>
                                            <p>Over <?php echo $sum_row['sum'];?> Courses</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
				            <?php
			            } //end while
		            } //end if
	            ?>
            </div>
        </div>
    </section>