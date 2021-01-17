<?php

/**
 * Calcula a diferença da soma dos elementos das diagonais de uma matriz quadrada.
 */
function diagonalsSumsDiff(array $matrix): int
{
    $n = count($matrix);
    $diff = 0;
    for ($i = 0; $i < $n; $i++) {
        assert(count($matrix[$i]) === $n, new \InvalidArgumentException('"matrix" is not square.'));
        $diff += $matrix[$i][$i] - $matrix[$i][$n - 1 - $i];
    }
    return $diff;
}

// Exemplo de execução:

$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [9, 8, 9],
];

var_dump(diagonalsSumsDiff($matrix));
