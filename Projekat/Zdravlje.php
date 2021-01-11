<?php

function Zdravlje(){
    $my_text_file1 = "Zdravlje.txt";
$all_lines1 = file($my_text_file1);
$broj = count($all_lines1);
$last_index1 = $broj - 1;
$br = rand(0, $last_index1);
if($br % 2 == 0)
{
    echo $all_lines1[$br];
    echo "<br>";
    echo $all_lines1[$br + 1];
}
elseif($br == 0){
    echo $all_lines1[$br];
    echo "<br>";
    echo $all_lines1[$br + 1];
}
else{
    $br--;
    echo $all_lines1[$br];
    echo "<br>";
    echo $all_lines1[$br + 1];
}   
}

echo Zdravlje();

?>