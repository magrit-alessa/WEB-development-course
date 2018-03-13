<?php

$string = "a(bcdefghijkl(mno)p)q";

function reverseInBrackets($string){

preg_match_all("/\(([^()]*)\)/", $string, $matches );

      while( $matches[0] == true ){
  
     foreach($matches[1] as &$val){
       $reverse[]= strrev($val);
   }
   
     $tmpStr = str_replace($matches[0], $reverse , $string);
    
     return reverseInBrackets($tmpStr);
    
      }
      
    
    
   
    return $string;
}


  reverseInBrackets($string);


?>