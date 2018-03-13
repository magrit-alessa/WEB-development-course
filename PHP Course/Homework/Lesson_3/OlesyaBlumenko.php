<?php

function palindrom($text){

$count = 0;

for($i=0 ; $i<strlen($text); $i++){
 $newStr = substr_count($text, $text[$i]);
 if($newStr == 1){
   $count++;
 };
}
if($count>1){
  return false;
}else{
  return true;
}
}
    



?>