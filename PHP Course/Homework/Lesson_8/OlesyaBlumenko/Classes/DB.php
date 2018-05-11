<?php

class DB {
		public function mySQL($userData) {
			$name = $_POST["name"];
			$lastName = $_POST["lastName"];
			$email = $_POST["email"];
			$ticket = $_POST["ticket"];
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PW);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$createDB = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS events");
			$connDB = mysqli_select_db($conn, "events");
			$table = "CREATE TABLE IF NOT EXISTS EventsOrders (
				  Name CHAR(25) NOT NULL,
		          Last_Name CHAR(25) NOT NULL,
		          Email CHAR(50) NOT NULL,
		          Type_of_ticket CHAR(25) NOT NULL
			)";
			$createTable = mysqli_query($conn, $table);
			$checkEmail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM EventsOrders WHERE email = '$email'"), MYSQLI_NUM);
			if (!empty($checkEmail)) {
				die("email address already exists");
			}else{
				mysqli_query($conn, "INSERT INTO EventsOrders ( Name, Last_Name, Email, Type_of_ticket)
									VALUES ('$name', '$lastName', '$email', '$ticket')");
				echo $successMessage = "Thank You for your registration!";
				exit();
			}
		}
	}

?>