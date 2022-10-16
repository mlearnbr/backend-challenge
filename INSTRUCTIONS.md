## Instruções de instalação
- Após clonar o repositório, executar o comando `composer install` no terminal 
para instalar as dependências do Laravel.

- Configurar o arquivo `.env` com os parâmetros de sua conexão ao banco.
As 4 últimas entradas do arquivo `.env.example` correspondem aos parâmetros de
acesso à API e são necessárias para o projeto funcionar.

- Executar o comando `php artisan key:generate` para gerar a chave da aplicação

- Executar o comando `php artisan migrate` para popular a base de dados

- Executar o comando `php artisan serve` para iniciar um servidor local da aplicação.
Por padrão, a aplicação fica disponível no endereço `localhost:8000`.

## Desafio Lógico
O desafio foi resolvido em JavaScript, e se encontra no script `/public/js/desafio-logico.js`.
O script está incluso na página index da aplicação, de modo que é possível executar a função
`diferencaDiagonal` diretamente no console do navegador. Como entrada, são aceitas matrizes
de inteiros e vetores de strings onde cada caractere representa uma coluna de número inteiro.