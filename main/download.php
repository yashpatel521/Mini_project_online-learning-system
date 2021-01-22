<?php
	require_once("includes/header.php");
	
	if ($_GET['uid'] && $_GET['enid'])
	{
		$uid = base64_decode($_GET['uid']);
		$enid = base64_decode($_GET['enid']);
		
		$query = $con->prepare("SELECT * FROM certificate WHERE learner_id=$uid AND course_id=$enid");
		$query->execute();
		
		if($query->rowCount() == 1)
		{
			$row = $query->fetch(PDO::FETCH_ASSOC);
				$certificate_path = $row['certificate'];
			
			$en_query = $con->prepare("SELECT * FROM entities WHERE id=$enid");
			$en_query->execute();
			$en_row = $en_query->fetch(PDO::FETCH_ASSOC);
			    $en_name = $en_row['name'];
		}
	}
	else
	{
		header("Location: profile2.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/uplinks.php') ?>
</head>
<body>
	<?php include('includes/topbar.php') ?>
	<section class="blog_area single-post-area section_padding">
		<div class="container">
			<div class="row ">
				<div class=" col-md-10">
                    <h4 class="p-2"><span class="ti-arrow-circle-right"></span>&nbsp;<span style="color: #8c8c8c">Your Certificate for the Course of : </span><?php echo $en_name; ?></h4>
					<div class="feature-img text-center">
						<img class="img-fluid" src="<?php echo $certificate_path;?>" style="width:70%;height: auto" alt="">
					</div>
				</div>
				<div class="col">
                    <a  href="<?php echo $certificate_path;?>" download><button class="button btn_1 button-contactForm">Download <span class="ti-download"></span></button></a>
				</div>
			</div>
		</div>
	</section>
	
	<?php include('includes/footer.php')?>
	<?php  include('includes/downlinks.php')?>
</body>
</html>