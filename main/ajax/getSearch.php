<?php
	require_once ('../includes/config.php');
	
	    $text = $_GET['txt'];
		
		// let's filter the data that comes in
		$text = htmlspecialchars($text);
		// prepare the mysql query to select the users
		$get_name = $con->prepare("SELECT * FROM entities WHERE name LIKE concat('%', :name, '%')");
		// execute the query
		$get_name -> execute(array('name' => $text));
		// show the users on the page
		if($get_name->rowCount() > 0)
		{
			while($names = $get_name->fetch(PDO::FETCH_ASSOC)){
				// show each user as a link
				echo '<a class="dropdown-item" href="single_course.php?enID='.$names['id'].'">'.$names['name'].'</a>';
			}
		}
		else
			{
			echo '<p class="dropdown-item p-5"> No Course Found</p>';
		}
		
?>
