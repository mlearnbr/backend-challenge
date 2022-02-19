#Primeiro desafio
#####Neste desafio foi implementado uma logica para percorrer uma matriz com o intuito de subtrair suas diagonais.

#####Além disto uma verificação para saber se ela é uma matriz quadrada

```php

//Defina os valores da matriz quadrada na variavel a baixo

$matriz_quadrada = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];
$valuelfr = 0;
$valuerfl = 0;
for ($i = 0; $i < count($matriz_quadrada); $i++) {
    
    $ultimo_valor = (count($matriz_quadrada[$i]) - $i - 1);
    
    if(count($matriz_quadrada) != count($matriz_quadrada[$i])){
        echo "Esta matriz não é quadrada, defina um outro valor!'";
        return;
    }
    
    $valuelfr = $valuelfr + $matriz_quadrada[$i][$i];
    $valuerfl = $valuerfl + $matriz_quadrada[$i][$ultimo_valor];
    
}  
echo $valuelfr - $valuerfl;

```




