<?php 

$matrix = [
    [1,2,3],
    [4,5,6],
    [7,8,9]
];

$error = false;
$total_rows = count($matrix);

foreach ( $matrix as $key => $row ) {
    if ( count($row) != $total_rows ) {
        $error = true;
        break;
    }
}

if ( $error ) {
    echo 'Desculpe! Aparentemente está não é uma Matriz Quadrada';
    exit;
}