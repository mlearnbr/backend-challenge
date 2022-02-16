<?php


function matrizQuadranda($ordem){

    $matriz = array();
    $soma_diagonal_principal = 0;
    $soma_diagonal_secundaria = 0;

    echo 'Mostra a Matriz Quadrada de ordem: ' . $ordem . PHP_EOL;

    for($i=0;$i<$ordem;$i++){
        for($j=0;$j<$ordem;$j++){
            echo $matriz[$i][$j] = rand(1,20) . " ";
        }
        print("\n");
    }

    print("\n");
    
    for($i=0;$i<$ordem;$i++){
        for($j=0;$j<$ordem;$j++){
            if($i == $j){
                $soma_diagonal_principal += $matriz[$i][$j];
            }
            if(($i+$j) == ($ordem-1)){
                $soma_diagonal_secundaria += $matriz[$i][$j];
            }
        }
    }

    echo 'Soma da diagonal principal: ' . $soma_diagonal_principal . PHP_EOL;

    echo 'Soma da diagonal segundaria: ' . $soma_diagonal_secundaria . PHP_EOL;

    echo 'Diferença entre as diagonais: ' . ($soma_diagonal_principal - $soma_diagonal_secundaria);
}

echo matrizQuadranda(4);