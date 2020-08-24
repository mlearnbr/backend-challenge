<?php

$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [9, 8, 9]
];

function isValidMatrix($matrix) {
    if (!is_array($matrix)) return false;
    $number_of_rows = count($matrix);
    foreach($matrix as $row) {
        $number_of_columns = count($row);
        if ($number_of_rows !== $number_of_columns) return false;
        foreach($row as $value) {
            if (!is_numeric($value)) return false;
        }
    }
    return true;
}

function diagonalDifference($matrix) {
    if (!isValidMatrix($matrix)) throw new Exception("Parameter 1 is not a valid numeric square matrix");
    $right_diagonal = 0;
    $left_diagonal = 0;
    for ($i = 0; $i < count($matrix); $i++) {
        $right_diagonal += $matrix[$i][$i];
        $left_diagonal += $matrix[$i][(count($matrix[$i]) - 1) - $i];
    }
    return $right_diagonal - $left_diagonal;
}

echo diagonalDifference($matrix);