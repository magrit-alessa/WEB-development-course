<?php
class Txt {
		public function text_save($userData) {
			$name = $_POST["name"];
			$lastname = $_POST["lastName"];
			$email = $_POST["email"];
			$ticket = $_POST["ticket"];
			$date = date("d_m_Y");
			$file = fopen("registration_$date.txt", "a+");
			if (strpos(file_get_contents("registration_$date.txt"), $email)){
				die("email address already exists");
			} else {
				fwrite($file, "Name:" .$name."; Last Name: ".$lastname."; email:".$email."; Type of ticket:".$ticket.";\n");
				echo $successMessage = "Thank You for your registration!";
				die();
			}
			fclose($baseFile);
		}
	}

?>