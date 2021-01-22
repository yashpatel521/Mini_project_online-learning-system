<?php include('includes/config.php') ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('includes/uplinks.php') ?>
		
		<link rel="stylesheet" href="assests/js/jquery-3.3.1.slim.min.js">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		
		<style>
			input{
				border-radius: 50px;
				border: 2px solid cyan;
			}
		</style>
	</head>
	<body>
	<?php include('includes/before_login.php'); ?>
	<script>
		$(document).ready(function(e){
			$("#search").keyup(function(){
				$("#show_up").show();
				var text = $(this).val();
				if (text != '')
				{
					$.ajax({
						type: 'GET',
						url: 'ajax/getsearch.php',
						data: 'txt=' + text,
						success: function(data){
							$("#show_up").html(data);
						}
					});
				}
				else
				{
					$("#show_up").html('');
				}
			})
		});
	</script>
	
	<div id="result"></div>
   
		<?php include('templates/intro.php') ?>
		<?php include('templates/category.php') ?>
		<?php include('templates/priceing.php') ?>
		<?php include('templates/course_slide.php')?>
		<?php include('templates/aboutus.php') ?>
		<?php include('templates/instructorinfo.php') ?>
		<?php include('templates/testomonail.php') ?>
		<?php include('includes/footer.php')?>
		<?php include('includes/downlinks.php')?>
	</body>
</html>