<?php 

$matrix = [
    [1,2,3],
    [4,5,6],
    [7,8,9]
];

$error = false;
$total_rows = count($matrix);

$primary = 0;
$second = 0;

foreach ( $matrix as $key => $row ) {
    if ( count($row) != $total_rows ) {
        $error = true;
        break;
    }

    $primary += $row[$key];
    $second += (array_slice($row, -(1+$key))[0]); 
}

if ( $error ) {
    echo 'Desculpe! Aparentemente está não é uma Matriz Quadrada';
    exit;
}

$diff = $primary - $second;

echo "A diferença entre as diagonais é: {$diff} \n";