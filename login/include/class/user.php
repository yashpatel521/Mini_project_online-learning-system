<?php
class User{
    private $con, $sqlData;
    public function __construct($con , $username){
        $this->con =$con;
        $query = $con->prepare("SELECT * FROM admin WHERE username=:username");
        $query->bindValue(":username",$username);
        $query->execute();
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getFirstName(){
        return $this->sqlData["firstName"];
    }
    
    public function getLastName(){
        return $this->sqlData["lastName"];
    }
    
    public function getEmail(){
        return $this->sqlData["email"];
    }
    public function getphone(){
        return $this->sqlData["phone"];
    }
    public function getimg(){
        return $this->sqlData["img"];
    }
    
}
?>