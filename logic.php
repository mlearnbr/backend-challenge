<?php

echo "Digite a matriz no seguinte formato: 1,2,3/4,5,6/9,8,9\n";
$matrixStr = readline("Matrix: ");

$matrixAux = explode("/", $matrixStr);

$matrix = [];
foreach ($matrixAux as $matrixLine) {
    $matrix[] = explode(",", $matrixLine);
}

$leftDiagonal = 0;
$rightDiagonal = 0;
foreach ($matrix as $lineKey => $line) {
    $lineLength = count($line);
    foreach ($line as $columnKey => $column) {
        if($lineKey == $columnKey) {
            $leftDiagonal += $column;
        }
        if(($lineLength - $lineKey - 1) == $columnKey) {
            $rightDiagonal += $column;
        }
    }
}

echo("A diagonal da esquerda para direita: ${leftDiagonal}\n");
echo("A diagonal da direita para esquerda: ${rightDiagonal}\n");
$difference = $leftDiagonal - $rightDiagonal;
echo("A diferença entre elas é: ${difference}\n");