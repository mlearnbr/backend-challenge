<?php
// Função que retorna a diferença entre as diagonais de uma matriz quadrada.
function difDiagonaisMatriz($matriz){
  //pagando o tamango da matriz
  $len = count($matriz);
  //iniciando os valores das diagonais em 0
  $diagonal1 =  $diagonal2 = 0;
  
  //percorrendo a matriz
  for($i = 0; $i < $len; $i ++){
    for($j = 0; $j < $len; $j ++){
      // Se as posições forem iguais faz parte da diagonal
      if($i == $j)
        $diagonal1 += $matriz[$i][$j];
      // Se a soma das posições for igual ao tamanho da matriz faz parte da segunda diagonal
      if($i + $j == $len-1)
        $diagonal2 += $matriz[$i][$j];
    }
  }
  return($diagonal1 - $diagonal2);
}