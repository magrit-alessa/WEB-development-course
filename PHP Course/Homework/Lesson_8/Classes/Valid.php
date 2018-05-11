<?php

class Valid {
    private function validate_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    }
    
    public function config_valid($userData) {
      if (($userData) == true) {

       
      if(empty($_POST["name"]) || empty($_POST["lastName"]) || empty($_POST["email"]) ){
        die ("Заполните все поля!");
          };
        if(!preg_match("/[a-zA-Z0-9\-\_]{1,50}[@]{1}[a-zA-Z0-9]{2,20}[\.]{1}[a-zA-Z0-9]{2,15}/" , $_POST["email"])){
            die("Invalid email");
            }

        $name = $this->validate_input($_POST["name"]);
        $lastname = $this->validate_input($_POST["lastName"]);
        $email = $this->validate_input($_POST["email"]);
        $ticket = $this->validate_input($_POST["ticket"]);
        
      }
    }
  }


?>

