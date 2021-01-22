<?php
	require_once ('../includes/config.php');
	
	if ($_POST['VID']!='' && $_POST['LID']!='')
	{
//		if($_POST['STATUS'] == 0)
//		{
			//update isset($_POST['VID']) && isset($_POST['LID'])
			$vid = $_POST['VID'];
			$lid = $_POST['LID'];
			$progress=$_POST['PROGRESS'];
			$curr = $_POST['CURR_TIME'];
			$finish = $_POST['FINISHED'];
		
		$check = $con->prepare("SELECT * FROM videoprogress WHERE learner_id=$lid AND video_id=$vid");
		$check->execute();
		$row = $check->fetch(PDO::FETCH_ASSOC);
			$finish_status = $row['finished'];
			$progress_status = $row['progress'];
			$current_status = $row['current'];
			
			if($curr >= $current_status)
			{
				if ($finish_status == 1 || $progress >=99)
				{
					$progress = 100;
					$finish = 1;
					$query = $con->prepare("UPDATE videoprogress SET progress=:progress, current=:curr ,finished=:finish WHERE video_id=:vid AND learner_id=:lid");
					$query->bindValue(":vid",$vid);
					$query->bindValue(":lid",$lid);
					$query->bindValue(":progress",$progress);
					$query->bindValue(":curr",$curr);
					$query->bindValue(":finish",$finish);
					
					$query->execute();
				}
				else
				{
					$finish = 0;
					$query = $con->prepare("UPDATE videoprogress SET progress=:progress, current=:curr ,finished=:finish WHERE video_id=:vid AND learner_id=:lid");
					$query->bindValue(":vid",$vid);
					$query->bindValue(":lid",$lid);
					$query->bindValue(":progress",$progress);
					$query->bindValue(":curr",$curr);
					$query->bindValue(":finish",$finish);
					
					$query->execute();
				}
			}
			
			
//			if ($progress > 97)
//			{
//				$finish = 1;
//			}
//			else
//			{
//				$finish = 0;
//			}
			
//			$query = $con->prepare("UPDATE videoprogress SET progress=:progress, current=:curr ,finished=:finish WHERE video_id=:vid AND learner_id=:lid");
//			$query->bindValue(":vid",$vid);
//			$query->bindValue(":lid",$lid);
//			$query->bindValue(":progress",$progress);
//			$query->bindValue(":curr",$curr);
//			$query->bindValue(":finish",$finish);
//
//			$query->execute();
			
	}
?>