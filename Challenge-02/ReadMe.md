# Desafio 02 - Integração

O desafio 02 foi realizado utilizando a Stack Laravel+MySQL+Vue.js
Para a parte de integração foi utilizado um Job do laravel, porém de maneira sincrona(dispathNow) desta forma não se faz necessário a utilização de um gerenciador de queue.
Foi utilizado também uma imagem [Docker](https://hub.docker.com/r/herickc/php-fpm-nginx/) criada por mim, contendo todas as configurações base para rodar o laravel em cima do NGinx com PHP7-fpm.

## Como Testar o Desafio

### Antes de Executar

Para rodar o desafio, é necessário antes a instalação e configuração de algumas ferramentas. O passo a passo é descrito a seguir:

-   Copiar o arquivo [**<em>.env.example</em>**](.env.example) para **<em>.env</em>**
-   Editar o arquivo **<em>.env</em>** para refletir as configurações de seu Servidor MySQL
-   Criar os devidos databases no Servidor MySQL(O database para os testes deve se chamar **challenge_test**)
-   Na pasta Challenge-02, executar o comando **composer install**
-   Na pasta Challenge-02, executar o comando **php artisan migrate**

### Para Executar

Para executar recomenda-se a utilização do Docker + Docker-compose. Para executar utilizando este método, vá até a pasta Challenge-02 e execute o comando **docker-compose up** aguarde a conclusão de setup, e abra [localhost:8080](http://localhost:8080)

Outro método sem utilizar o docker, é através do **php artisan serve** porém é necessário ter instalado na máquina todos os requisitos do [laravel](https://laravel.com/docs/7.x#server-requirements)
