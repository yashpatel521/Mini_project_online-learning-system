<?php
	require_once("includes/header.php");
	
	if(isset($_GET['del']) && isset($_GET['uid']))
	{
		$del_course_id = $_GET['del'];
		$del_ler_id = $_GET['uid'];
		$query = $con->prepare("DELETE FROM save_later WHERE learner_id=$del_ler_id AND course_id=$del_course_id");
		$query->execute();
		
		if($query)
		{
			header("Location: profile2.php");
//			exit("");
		}
	}
	elseif (isset($_GET['endel']) && isset($_GET['lerid']))
	{
		$del_vid_id = $_GET['endel'];
		$ler_id = $_GET['lerid'];
		$query_en = $con->prepare("DELETE FROM videoprogress WHERE learner_id=$ler_id AND video_id=$del_vid_id");
		$query_en->execute();
		
		if($query_en)
		{
			header("Location: profile2.php");
//			exit("");
		}
	}
	
?>