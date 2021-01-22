<?php
	class saveLater
	{
		private $con;
		public function __construct($con) {
			$this->con = $con;
		}
		
		public function saveLater($ler_id,$enId)
		{
			
			$query = $this->con->prepare("SELECT * FROM save_later WHERE learner_id=$ler_id AND course_id=$enId");
			
			$query->execute();
			
			if($query->rowCount() == 0)
			{
				$result = $this->con->prepare("INSERT INTO save_later(learner_id,course_id) VALUES ($ler_id,$enId)");
				return $result->execute();
			}
			else
			{
				return false;
			}
		}
	}
?>