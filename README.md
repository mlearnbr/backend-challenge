# mLearn challenge

### Desafio 1

Para o primeiro desafio proposto, escrevi o código abaixo, que retorna a diferença entre a soma das diagonais ou `false`, caso a matriz não seja quadrada.


```php
$matriz = [
    [12,14,16],
    [42,13,1],
    [5,3,12],
];

function diferencaEntreSomaDiagonais($matriz) {
    $linhas = count($matriz);
    foreach($matriz as $m) {
        if (count($m) !== $linhas) {
            return false;
        }
    }
    $x = 0;
    $y = 0;
    for ($i = 0, $j = $linhas - 1; $i < $linhas; $i++, $j--) {
        $x += $matriz[$i][$i];
        $y += $matriz[$i][$j];
    }
    return $x - $y;
}

print diferencaEntreSomaDiagonais($matriz);
```

### Desafio 2

Para executar o projeto, basta seguir os passos abaixo:

* Crie um banco de dados utilizando o MySQL
* Clone o projeto utilizando o comando: `git clone https://github.com/samfelgar/backend-challenge.git` 
* Navegue para a pasta criada e execute `git ckeckout samuel-garcia`
* Altere o arquivo .env.example, inserindo as informações de conexão do banco de dados
* Altere o nome do arquivo **.env.example** para **.env** 
* Execute `composer install` (você deve ter o composer instalado globalmente)
* Execute `php artisan migrate`
* Finalmente, execute `php artisan serve` e navegue para a URL informada

**Samuel Felipe**
