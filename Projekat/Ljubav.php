<?php

function Ljubav(){
    $my_text_file2 = "Ljubav.txt";
$all_lines2 = file($my_text_file2);
$broj = count($all_lines2);
$last_index2 = $broj - 1;
$br = rand(0, $last_index2);
if($br % 2 == 0)
{
    echo $all_lines2[$br];
    echo "<br>";
    echo $all_lines2[$br + 1];
}
elseif($br == 0){
    echo $all_lines2[$br];
    echo "<br>";
    echo $all_lines2[$br + 1];
}
else{
    $br--;
    echo $all_lines2[$br];
    echo "<br>";
    echo $all_lines2[$br + 1];
} 
}
echo Ljubav();

?>