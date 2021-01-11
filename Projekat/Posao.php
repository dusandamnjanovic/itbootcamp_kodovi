<?php


function Posao(){
$my_text_file4 = "Posao.txt";
$all_lines4 = file($my_text_file4);
$broj = count($all_lines4);
$last_index4 = $broj - 1;
$br = rand(0, $last_index4);
if($br % 2 == 0)
{
    echo $all_lines4[$br];
    echo "<br>";
    echo $all_lines4[$br + 1];
}
elseif($br == 0){
    echo $all_lines4[$br];
    echo "<br>";
    echo $all_lines4[$br + 1];
}
else{
    $br--;
    echo $all_lines4[$br];
    echo "<br>";
    echo $all_lines4[$br + 1];
}    
}

echo Posao();


?>