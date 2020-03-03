Para rodar o projeto basta apenas seguir os serguitens passos(considerando que já possuam o composer instalado): 

-executar o comando "composer install" na pasta do projeto -executar o comando "php artisan key:generate" 
-executar o comando "composer require guzzlehttp/guzzle:~6.0"
-configurar o .env com os dados do banco desejado
-executar o comando "php artisan migrate"
-executar o comando "php artisan serve"
-abrir o navegador na url indicada pelo retorno do comando.
