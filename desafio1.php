<?php

$matrix = [[1, 2, 3], [4, 5, 6], [9, 8, 9]];
$matrixSize = count($matrix);

$leftSideSum = 0;
$rightSideSum = 0;

$i = 0;
$j = $matrixSize - 1;

while ($i < $matrixSize && $j >= 0) {
    $leftSideSum += $matrix[$i][$i];
    $rightSideSum += $matrix[$i][$j];

    $i++;
    $j--;
}

$answer = $leftSideSum - $rightSideSum;

var_dump($answer);
