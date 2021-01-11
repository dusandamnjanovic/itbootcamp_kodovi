<?php

function Motivacija(){
    $my_text_file3 = "Motivacija.txt";
$all_lines3 = file($my_text_file3);
$broj = count($all_lines3);
$last_index3 = $broj - 1;
$br = rand(0, $last_index3);
if($br % 2 == 0)
{
    echo $all_lines3[$br];
    echo "<br>";
    echo $all_lines3[$br + 1];
}
elseif($br == 0){
    echo $all_lines3[$br];
    echo "<br>";
    echo $all_lines3[$br + 1];
}
else{
    $br--;
    echo $all_lines3[$br];
    echo "<br>";
    echo $all_lines3[$br + 1];
}    

}
 echo Motivacija();


?>