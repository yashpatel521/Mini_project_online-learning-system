<?php
	include("includes/config.php");
//	if ($_GET['ref'])
//	{
		$ref = $_POST['ref'];
		if (is_numeric($ref))
        {
	        $verify = $con->prepare("SELECT * FROM certificate WHERE reference_id = $ref");
	        $verify->execute();
	
	        if ($verify->rowCount() == 1)
	        {
		        $exist = 1;
		        $row = $verify->fetch(PDO::FETCH_ASSOC);
		        $learner_id = $row['learner_id'];
		        $course_id = $row['course_id'];
		        $issue = $row['issue_date'];
		
		        $user = $con->prepare("SELECT * FROM users WHERE id=$learner_id");
		        $user->execute();
		        $row = $user->fetch(PDO::FETCH_ASSOC);
		        $u_name = $row["firstName"]." ".$row["lastName"];
		
		        $course = $con->prepare("SELECT * FROM entities WHERE id=$course_id");
		        $course->execute();
		        $row = $course->fetch(PDO::FETCH_ASSOC);
		        $c_name = $row['name'];
		
	        }
        }
		else{
		    echo '
		        <script>window.alert("Enter Valid Reference ID");</script>
		    ';
        }
		
		
		
		
//	}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Brighter Bee</title>
    <link rel="icon" href="assests/logo/logob1.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assests/css/css-bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="assests/css/css-animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="assests/css/css-owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="assests/css/css-themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="assests/css/css-flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="assests/css/css-magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="assests/css/css-slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="assests/css/css-style.css">
    <!-- pricing CSS -->
    <link rel="stylesheet" href="assests/css/pricing-plan.css">
    <style>
        .span
        {
            font-size: 12px;
            border: 2px solid green;
            color:green;height: 50px;
            width: 50px;
            border-radius: 50px
        }
        .span_not
        {
            font-size: 12px;
            border: 2px solid #cf3d3d;
            color:#cf3d3d;height: 50px;
            width: 50px;
            border-radius: 50px
        }
        .fetch{
            font-size: 16px;
            font-weight: 400;
            color: #2f2f2f;
            border-bottom: 1px solid #c6c6c6;
        }
        
    </style>
</head>
<body>
    
    <div class="container">
        
        <section class="blog_area single-post-area section_padding">
            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2>Verification</h2>
		            <?php
			            if(isset($exist))
			            {
					?>
                                <ul>
                                    <li>
                                        <p class="p-3 pl-5 fetch">
                                            <span class="ti-check bg-white p-1 span"></span>&nbsp;&nbsp;
                                            Issued on <?php echo $issue; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="p-3 pl-5 fetch">
                                            <span class="ti-check bg-white p-1 span"></span>&nbsp;&nbsp;
                                            Issued by Brighter Bee
                                        </p>
                                    </li>
                                    <li>
                                        <p class="p-3 pl-5 fetch">
                                            <span class="ti-check bg-white p-1 span"></span>&nbsp;&nbsp;
                                            Issued to <?php echo $u_name; ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="p-3 pl-5 fetch text-success" style="font-size: 24px;font-weight: 400">
                                            <span class="ti-check bg-white p-1 span"></span>&nbsp;&nbsp;
                                            Verified
                                        </p>
                                    </li>

                                </ul>
					<?php
			            }
			            else
                        {
                    ?>
                            <ul>
                                <li>
                                    <p class="p-3 pl-5 fetch">
                                        <span class="ti-close bg-white p-1 span_not"></span>&nbsp;&nbsp;
                                        Issued on  -
                                    </p>
                                </li>
                                <li>
                                    <p class="p-3 pl-5 fetch">
                                        <span class="ti-close bg-white p-1 span_not"></span>&nbsp;&nbsp;
                                        Issued by  -
                                    </p>
                                </li>
                                <li>
                                    <p class="p-3 pl-5 fetch">
                                        <span class="ti-close bg-white p-1 span_not"></span>&nbsp;&nbsp;
                                        Issued to  -
                                    </p>
                                </li>
                                <li>
                                    <p class="p-3 pl-5 fetch text-danger" style="font-size: 24px;font-weight: 400">
                                        <span class="ti-close bg-white p-1 span_not"></span>&nbsp;&nbsp;
                                        Not Verified
                                    </p>
                                </li>

                            </ul>
                    <?php
                        }
		            ?>
                </div>
                <div class="col-md-3">
                    <a href="main.php" type="button"><span class="ti-close" style="color: black;font-weight: bold"></span></a>
                </div>
            </div>
		    
        </section>
    </div>

    
</body>
</html>


