<?php

/*
    mLearn Educação Móvel - Desafio I
    backend-challenge mLearn
    Retornar diferença das diagonais principal e secundária de uma matriz.

    Matrix a Linha=l, Coluna=c
    Ordem = número 

                a1,1 a1,2 a1,3 a1,4
        al,c    a2,1 a2,2 a2,3 a2,4
                a3,1 a3,2 a3,3 a3,4
                a4,1 a4,2 a4,3 a4,4

Análise do escopo - Processos usados para computar a diferença das diagonais direita e esquerda:

1. Buscar a ordem da Matriz Quadrada, Exemplo: ordem=3, para saber a qtde de posições;
2. Pela número da ordem calcular todas as posições da Matriz no Array. Posições =  ordem^2 (ordem elevada ao quadrado);
3. Zerar todas as posições da matriz;
4. Preencher as posições da matriz com dados aleatórios;
5. Efetuar loop para calcular o somatório da diagonal principal, pela regra de posição linha,coluna fazendo linha=coluna;
6. Efetuar loop para calcular o somatório da diagonal secundaria, pela regra da linha + coluna == ordem;
7. Efetuar a diferença entra os elementos da diagonal direita e diagonal esquerda.

* O enunciado disse para não usar muitas funções, então fiz sem usar nenhuma função como desafio.

Candidato------------------
Rodrigo Longuinhos de Assis
rodrigoassisnz@hotmail.com
(31)99279-2946

*/

if (isset($_GET["ordem"]) && count($_GET) > 0 ) {
    
    $ordem = $_GET["ordem"]; //ordem da matriz quadrada

    // Variáveis Globais
    $somaDP = 0; //soma dos elementos da diagonal direita 
    $somaDS = 0; //soma dos elementos da diagonal esquerda

    // Matriz recebe elementos sorteados a partir de sua ordem
    for ($l = 1; $l < $ordem+1; $l++) {
        for ($c = 1; $c < $ordem+1; $c++) {
        $mat[$l][$c] = rand(0, 9);
        }
    }
    
    //Ler a diagonal direita e armazenar no vetor
    for ($l = 1; $l < $ordem+1; $l++) {
        for ($c = 1; $c < $ordem+1; $c++) {
        if ($l == $c) { // regra para buscar diagonal direita
            $vetDP[$l] = $mat[$l][$c];
            $mat[$l][$c] = "$vetDP[$l]";
            $somaDP += $mat[$l][$c];
        }
        }
    }
    
    //Ler a diagonal esquerda e armazenar no vetor
    for ($l = 1; $l < $ordem+1; $l++) {
        for ($c = 1; $c < $ordem+1; $c++) {
        if ($l + $c == $ordem+1) { // regra para buscar diagonal esquerda
            $vetDS[$l] = $mat[$l][$c];
            $mat[$l][$c] = "$vetDS[$l]";
            $somaDS += $mat[$l][$c];
        }
        }
    }

    echo "<b>mLearn - Desafio Lógico</b><br><br>";
    
    //Exibir na tela a matriz
    for ($l = 1; $l < $ordem+1; $l++) {
        for ($c = 1; $c < $ordem+1; $c++) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $mat[$l][$c];
        }
        echo "<br />";
    }
    echo "<br/>";
    
    //Exibir diagonal direita
    echo "Diagonal Direita: ";
    for ($i = 1; $i < $ordem+1; $i++) {
        echo "&nbsp;&nbsp" . $vetDP[$i];
    }
    echo "<br/><br/>";
    
    //Exibir diagonal esquerda
    echo "Diagonal Esquerda: ";
    for ($i = 1; $i < $ordem+1; $i++) {
        echo "&nbsp;&nbsp;" . $vetDS[$i];
    }
    //Exibir soma das diagonais
    echo "<br/><br/>Soma da Diagonal Direita: ".$somaDP; 
    echo "<br/><br/>Soma da Diagonal Direita: ".$somaDS; 

    $difdiagonais = $somaDP-$somaDS; //diferença das diagonoais

    echo "<br/><br/><b>Diferença entre as diagonais: ".$difdiagonais."</b>";

}  else
{
    echo 'Informe na querystring "ordem" da url o valor da ordem da matrix quadrada.<br>';
    echo '<br><i>Exemplo: ../matriz.php?ordem=3</i><br>';
    echo '<br><a href="matriz.php?ordem=3">clique aqui para um exemplo de ordem 3</a>';
}
   
?>
