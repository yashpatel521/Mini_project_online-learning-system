<section class="learning_part" style="margin-top:-6%">
        <div class="container">
            <div class="row align-items-sm-center align-items-lg-stretch">
                <div class="col-md-7 col-lg-7">
                    <div class="learning_img">
                        <img src="assests/images/content/6308-removebg-preview.png" alt="img">
                    </div>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="learning_member_text">
                        <h5>About us</h5>
                        <h2>Start Insvesting in you</h2>
                        <p>Education is one of the most powerful things in life. It allows us to find the meaning behind everything and helps improve lives in a massive way.</p>
                        <ul>
                            <li><span class="ti-pencil-alt" style="color:blue"></span>An investment in knowledge pays the best interest</li>
                            <li><span class="ti-ruler-pencil" style="color:blue"></span>Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- learning part end--><!-- member_counter counter start -->

    <?php
        $ins = $con->prepare("SELECT * FROM users WHERE role=2");
        $ins->execute();
        $ins_count = $ins->rowCount();
        
        $learner = $con->prepare("SELECT * FROM users WHERE role=3");
        $learner->execute();
        $ler_count = $learner->rowCount();
        
        $cate = $con->prepare("SELECT * FROM categories");
        $cate->execute();
        $cate_count = $cate->rowCount();
        
        $en = $con->prepare("SELECT * FROM entities WHERE status=1");
        $en->execute();
        $en_count = $en->rowCount();
    ?>
    <section class="member_counter" style="margin-top:-10%">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter"><?php echo $ins_count; ?></span>
                        <h4>Instructor</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter"><?php echo $ler_count; ?></span>
                        <h4>Learners</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter"><?php echo $cate_count; ?></span>
                        <h4>Categories</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter"><?php echo $en_count; ?></span>
                        <h4>Courses</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>