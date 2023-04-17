<?php
function sum_of_numbers_more($a, $b){
    return str_split((string)$a);
    $str1=array_sum(explode("",(string)$a));
    $str2=array_sum(explode("",(string)$b));
    return $str1>$str2?$a:$b;
}

print_r(sum_of_numbers_more(555,76)) ;
