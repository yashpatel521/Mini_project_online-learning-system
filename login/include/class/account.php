<?php
class Account {

    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function updateDetails($fn, $ln, $un, $em , $tel){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);

        $this->validateNewEmails($em , $un);
        
        if(empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE instructor SET firstName=:fn, lastName=:ln, email=:em ,phone=:tel
                                            WHERE username=:un");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);
            $query->bindValue(":tel", $tel);
          

            return $query->execute();
        }

        return false;

    }
    public function updateimg($un,$img){
       
        
        if(empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE instructor SET img=:img
                                            WHERE username=:un");
            $query->bindValue(":img", $img);
            $query->bindValue(":un", $un);
          

            return $query->execute();
        }

        return false;

    }

    public function register($fn, $ln, $un, $em, $pw, $pw2) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em);
        $this->validatePasswords($pw, $pw2);

        if(empty($this->errorArray)) {
            return $this->insertDetails($fn, $ln, $un, $em, $pw);
        }

        return false;
    }
   

    public function login($un, $pw) {
        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 1) {
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                if($row['role'] == 1){
                    return 1;
                }
                elseif ($row['role'] == 2) {
                    $user_id = $row['id'];
                    $i_query = $this->con->prepare("SELECT * FROM instructor WHERE user_id = :user_id ");
                    $i_query->bindValue(":user_id", $user_id);
                    $i_query->execute();
                    $i_row = $i_query->fetch(PDO::FETCH_ASSOC);
                    if($i_row['status'] == 1){
                        return 2;
                    }
                    array_push($this->errorArray, Constants::$notactivate);
                    return false;
                }
                elseif ($row['role'] == 3){
                    return 3;
                }
            }
           
            
        }
        else{
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
        
    } 
     public function find($fn, $ln , $email) {

        $query = $this->con->prepare("SELECT * FROM users WHERE firstName=:fn AND lastName=:ln AND email=:email");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":email", $email);
        $query->execute();

        if($query->rowCount() >= 1) {
         return true;
            }
           
            
        
        else{
            array_push($this->errorArray, Constants::$notfind);
            return false;
        }
        
    }

    private function insertDetails($fn, $ln, $un, $em, $pw) {
        
        $pw = hash("sha512", $pw);
        $auth = bin2hex(openssl_random_pseudo_bytes(64));
       
        
        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password, auth)
                                        VALUES (:fn, :ln, :un, :em, :pw ,:auth)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);
      
        $query->bindValue(":auth", $auth);

        return $query->execute();
        
    }

    private function validateFirstName($fn) {
        if(strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }
    

    private function validateLastName($ln) {
        if(strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($un) {
        if(strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un);

        $query->execute();
        
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }
   

    private function validateEmails($em) {
       

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);

        $query->execute();
        
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }
    
    

    private function validateNewEmails($em , $un) {
       

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username != :un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);


        $query->execute();
        
        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }
    private function validatePasswords($pw, $pw2) {
        if($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if(strlen($pw) < 5 || strlen($pw) > 25) {
            array_push($this->errorArray, Constants::$passwordLength);
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
    public function getFirstError() {
        if(!empty($this->errorArray)) {
            return $this->errorArray[0];
        }
    }

    public function updatePassword($oldPw, $pw, $pw2, $un) {
        $this->validateOldPassword($oldPw, $un);
        $this->validatePasswords($pw, $pw2);

        if(empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE instructor SET password=:pw WHERE username=:un");
            $pw = hash("sha512", $pw);
            $query->bindValue(":pw", $pw);
            $query->bindValue(":un", $un);

            return $query->execute();
        }

        return false;
    }

    public function validateOldPassword($oldPw, $un) {
        $pw = hash("sha512", $oldPw);

        $query = $this->con->prepare("SELECT * FROM instructor WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 0) {
            array_push($this->errorArray, Constants::$passwordIncorrect);
        }
    }

}
?>