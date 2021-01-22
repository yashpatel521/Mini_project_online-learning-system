<?php
	class feedback
	{
		private $con;
		
		public function __construct($con)
		{
			$this->con = $con;
		}
		
		public function Rating($c_rate,$ins_rate,$comment,$i_id,$userid,$c_id)
		{
			
			$query = $this->con->prepare("SELECT * FROM feedback WHERE learner_id=$userid AND course_id=$c_id AND teacher_id=$i_id");
			$query->execute();
			if($query->rowCount() == 0)
			{
				
				$f_query = $this->con->prepare("INSERT INTO feedback(learner_id,course_rate,ins_rate,course_id,teacher_id,comment) VALUES (:userid, :c_rate, :ins_rate, :c_id, :i_id, :comment)");
				$f_query->bindValue(":c_rate", $c_rate);
				$f_query->bindValue(":ins_rate", $ins_rate);
				$f_query->bindValue(":comment", $comment);
				$f_query->bindValue(":i_id", $i_id);
				$f_query->bindValue(":c_id", $c_id);
				$f_query->bindValue(":userid", $userid);
				
				return $f_query->execute();
			}
			else
			{
				return false;
			}
		}
	}
?>