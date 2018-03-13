<?php

function countSequence ($arr){
 $n = 0;
  for($i = 0; $i < count($arr)-1; $i++ ){
  
    if($arr[$i] >= $arr[$i+1]){
      $n+= ($arr[$i] - $arr[$i+1])+1;
      $arr[$i+1]+= $arr[$i] - $arr[$i+1]+1;
  };
  
};

return $n;
};

?>