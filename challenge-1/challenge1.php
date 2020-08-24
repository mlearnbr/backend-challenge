<?php

declare(strict_types=1);

function dif_soma_diagonal(array $matriz): int
{
  $diag_principal = [];
  $diag_secundaria = [];
  $ordem_matriz = count($matriz[0]);

  foreach ($matriz as $linha => $colecao) {
    foreach ($colecao as $coluna => $item) {
      if ($coluna - $linha === 0 && $coluna === $linha) {
        $diag_principal[] = $item;
      }
      if ($coluna + $linha === $ordem_matriz - 1) {
        $diag_secundaria[] = $item;
      }
    }
  }

  $sum_principal  = 0;
  $sum_secundaria = 0;

  for ($cont = 0; $cont < $ordem_matriz; $cont++) {
    $sum_principal += $diag_principal[$cont];
    $sum_secundaria += $diag_secundaria[$cont];
  }

  return $sum_principal - $sum_secundaria;
}

$matriz1 = [
  [1, 2, 3, 4],
  [4, 5, 6, 3],
  [9, 8, 9, 2],
  [9, 8, 9, 1]
];
$matriz2 = [
  [1, 2, 3, 4, 9],
  [4, 5, 6, 3, 8],
  [9, 8, 9, 2, 7],
  [9, 8, 9, 1, 6],
  [9, 8, 9, 1, 5]
];

$matriz3 = [
  [1, 2, 3],
  [4, 5, 6],
  [9, 8, 9]
];

echo dif_soma_diagonal($matriz1) . PHP_EOL;
echo dif_soma_diagonal($matriz2) . PHP_EOL;
echo dif_soma_diagonal($matriz3) . PHP_EOL;
