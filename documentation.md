#Desafio 1
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

#Desafio 2

####Para conseguir rodar meu projeto faça os seguintes passos:

#####Crie um banco de dados MYSQL
#####Entre na pasta raiz do projeto
#####Verifique se está na branch correta - daniel-oliveira( ou execute: git checkout daniel-oliveira)
#####Crie um novo arquivo ".env" e configure igualmente o arquivo .env.example com suas configurações de banco
#####Após isso alguns comandos sendo eles:
######composer install
######npm install
######php artisan migrate
######php artisan serve


