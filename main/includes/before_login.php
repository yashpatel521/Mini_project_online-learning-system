<header class="main_menu home_menu">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12">
				<nav class="navbar navbar-expand-lg navbar-light">
					<a class="navbar-brand" href="index.php">
						<img src="assests/logo/logob1.png" style="width:50px;" alt="logo">BRIGHTER BEE</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
						
						<ul class="navbar-nav align-items-center">
							
							<li class="nav-item dropdown">
								<!-- Search form -->
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="text" name="names" class="px-3 p-2" placeholder="Search Course.." id="search">
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<div id="show_up" class="text-left show_up"></div>
								</div>
								<!-- Search form -->
							
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="main.php">Home</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Popular
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<?php
										$query = $con->prepare("SELECT * FROM feedback WHERE course_rate > 2 GROUP BY course_id LIMIT 6");
										$query->execute();
										while ($row = $query->fetch(PDO::FETCH_ASSOC))
										{
											$en_id = $row['course_id'];
											
											$c_query = $con->prepare("SELECT name FROM entities WHERE id=$en_id");
											$c_query->execute();
											$c_row = $c_query->fetch(PDO::FETCH_ASSOC);
											$name = $c_row['name'];
											?>
											<a class="dropdown-item" href="single_course.php?enID=<?php echo $en_id;?>"><?php echo $name;?></a>
											<?php
										} //end while
									?>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Category
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<?php
										$query = $con->prepare("SELECT * FROM categories");
										$query->execute();
										while ($row = $query->fetch(PDO::FETCH_ASSOC))
										{
											$id = $row['id'];
											$name = $row['name'];
											?>
											<a class="dropdown-item" href="single_category.php?id=<?php echo $id;?>"> <?php echo $name;?></a>
											
											<?php
										} //end while
									?>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" href="contactus.php">Contact</a>
							</li>
							<li class="nav-item dropdown">
								<a class="btn_1" href="../login/index.php">Login/Register</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>