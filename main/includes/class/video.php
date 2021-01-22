<?php
	
	class video
	{
		private $con;
		
		public function __construct($con)
		{
			$this->con = $con;
		}
		
		public function getVideo($lid,$vID,$progress,$curr,$finish,$date)
		{
			$check = $this->con->prepare("SELECT * FROM videoprogress WHERE learner_id=$lid AND video_id=$vID");
			$check->execute();
			if ($check->rowCount() == 0)
			{
				$query = $this->con->prepare("INSERT INTO videoprogress (learner_id, video_id, progress, current, finished, dateModified) VALUES (:lid ,:vID, :progress, :curr, :finish, :date)");
				$query->bindValue(":lid" ,$lid);
				$query->bindValue(":vID" ,$vID);
				$query->bindValue(":progress" ,$progress);
				$query->bindValue(":curr" ,$curr);
				$query->bindValue(":finish" ,$finish);
				$query->bindValue(":date" ,$date);
				
				$query->execute();
				
//				header("Location: videocourse.php");
			}
			elseif ($check->rowCount() == 1)
			{
				$update = $this->con->prepare("UPDATE videoprogress SET progress=:progress, current=:curr, finished=:finish, dateModified=:date WHERE video_id=$vID AND learner_id=$lid");
				$update->bindValue(":progress" ,$progress);
				$update->bindValue(":curr" ,$curr);
				$update->bindValue(":finish" ,$finish);
				$update->bindValue(":date" ,$date);
				
				$update->execute();
//				header("Location: videocourse.php");
			}
			else
			{
				return false;
			}
		}
	}
?>