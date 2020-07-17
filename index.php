<?php

require_once 'autoload.php';

use Classes\MatrizQuadrada;

$matriz = [
  array(1, 2, 3),
  array(4, 5, 6),
  array(9, 8, 9) 	
];

$matriz = new MatrizQuadrada($matriz);
echo "Diferença:" . $matriz->getDiferenca();
