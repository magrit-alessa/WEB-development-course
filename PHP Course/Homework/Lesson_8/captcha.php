<?php
 
session_start();

create_img();

function create_img(){

	$md5_hash = md5(rand(0,999));
	$captcha = substr($md5_hash, 15,5);

	$_SESSION['captcha'] = $captcha;

	$width = 200;
	$height = 50;

	$image = ImageCreate($width, $height);

	$white = ImageColorAllocate($image, 255, 255, 255);
	$black = ImageColorAllocate($image, 0, 0, 0);

	imagefill($image, 0, 0, $black);

	$font = "Lato-Black.ttf";

	imagettftext($image, 25, 10, 45, 45, $white, $font, $captcha);

	header("Content-type: image/jpeg");
	imagejpeg($image);
	imagedestroy($image);

	
}


?>