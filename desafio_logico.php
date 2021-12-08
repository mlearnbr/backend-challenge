<?php
$arr = [
    [10,15,30],
    [5,50,1],
    [1,5,3]
    ]; 
$qt = count($arr);
$dg_dir = 0;
$dg_esq = 0;

for($i = 0; $i < $qt; $i++){
    $dg_dir += $arr[$i][$i];
    $dg_esq += $arr[$i][$qt-$i-1];
}

echo $diferença = $dg_dir - $dg_esq;
