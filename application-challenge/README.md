# Desafio de aplicação mLearn

Este diretório faz parte do desafio lógico proposto pela mLearn.

Foi escolhido o framework **Laravel 7.x** e o banco de dados **MySQL 5.7** para o projeto.

Além disso, para facilitar a execução da aplicação, optei pela utilização do **Docker**.

# Instalação da aplicação

Como a aplicação está configurada para a utilização do Docker a instalação será mais simples.
1. Primeiramente certifique-se de ter o **Docker** instalado em sua máquina;

2. Certifique-se que as portas **8080, 3306, 9000** estão liberadas em sua máquina (você poderá alterar as rotas padões deste projeto no arquivo docker-compose.yml e também no arquivo de configuração .env);
3. Crie um arquivo chamado **.env** na raiz da aplicação (diretório ./application) - utilize o conteudo do arquivo **.env.example**, ele já possui as variaveis padrões para o ambiente do Docker ou execute `cp .env.example .env`

4. No diretório **application-challenge**, execute os comandos:

`docker-compose up -d --build`
`docker-compose run --rm composer install`
`docker-compose run --rm artisan key:generate`
`docker-compose run --rm artisan migrate`
`docker-compose run --rm npm install`
`docker-compose run --rm npm run prod`

5. Acesse por meio do seu navegador o endereço http://localhost:9000
