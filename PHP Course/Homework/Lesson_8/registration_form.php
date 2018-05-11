<?php

require_once('config.php');
	spl_autoload_register(function ($class) {
		include '/Classes/'.$class . '.php';
	});
	$userData = $_POST;

	session_start();
	

if (isset($_SESSION['captcha'])) {

	if ($_POST['captcha'] !== $_SESSION['captcha']) {		

		die("Verification code entered incorrectly");
	}
	unset($_SESSION['captcha']);
	
}
	$validate = new Valid();
	$validate->config_valid($userData); 

	
	class Config{
		public function config_method($method){
			$userData = $_POST;
			switch($method) {
				case 'text':
				$txt = new Txt();
				$txt->text_save($userData);
				break;

				case 'db':
				$db = new DB();
				$db->mySQL($userData);
				break;
				case 'xml':
				$xml = new XML();
				$xml->xml_file($userData);
				break;
			}
		}
	}
	
	$regVisitor = new Config();
	$regVisitor->config_method('xml'); 
	
?>