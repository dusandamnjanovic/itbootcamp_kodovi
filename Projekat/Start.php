<?php

function start(){

    $br = rand(1,4);

if($br == 1){
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
elseif($br == 2){
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
elseif($br == 3){
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
else{
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

}
echo start();
?>