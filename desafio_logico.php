<?php
/*
1 2 3 1
4 5 6 2
9 8 9 4
3 4 7 4
*/


function somatoria_diagonal_secundaria(array $matriz){
    $total = 0;
    for ($i=0,$j=(count($matriz) - 1); $i < count($matriz); $i++,$j--) { 
        $total += $matriz[$i][$j];
    }
    return $total;
}
function somatoria_diagonal_principal(array $matriz){
    $total = 0;
    for ($i=0; $i < count($matriz); $i++) { 
        $total += $matriz[$i][$i];
    }
    return $total;
}

function diferenca_entre_diagonais(array $matriz){

    for ($i=0; $i < count($matriz) ; $i++) { 
        if(!is_array($matriz[$i])){
            throw new Exception("Nescessário uma matriz", 1);
        }
        if(count($matriz) != count($matriz[$i])){
            throw new Exception("Nescessário uma matriz quadrada", 1);
        }
    }
   
    $total_somatoria_principal = somatoria_diagonal_principal($matriz);
    $total_somatoria_secundaria = somatoria_diagonal_secundaria($matriz);

    return $total_somatoria_principal - $total_somatoria_secundaria;
}

$matriz = [[1,2,3],[4,5,6],[9,8,9]];
$diferenca_entre_diagonais = diferenca_entre_diagonais($matriz);

echo $diferenca_entre_diagonais;