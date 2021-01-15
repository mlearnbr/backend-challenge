<?php

include 'Matrix.class.php';

$matrix = [[1,2,3],
           [4,5,6],
           [9,8,9]];

$class = new Matrix;

echo $class->operation($matrix);
