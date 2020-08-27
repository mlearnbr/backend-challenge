<?php
$matriz = [
    [1,2,3],
    [4,5,6],
    [9,8,9]
];

$somaPrincipal = 0;
$somaSecundaria = 0;

for ($i=0; $i < sizeof($matriz); $i++) {
    for ($j=0; $j < sizeof($matriz); $j++) {
        // Somando elementos da diagonal principal
        // quando i for igual a j
        if ($i == $j) {
            $somaPrincipal += $matriz[$i][$j];
        }
        // Somando elementos da diagonal secundária
        // quando a soma de i e j for igual a ordem da matriz menos 1
        if ($i + $j == sizeof($matriz[0]) - 1) {
            $somaSecundaria += $matriz[$i][$j];
        };
    }    
};

$resultado = $somaPrincipal - $somaSecundaria;
echo 'resposta: '.$resultado;