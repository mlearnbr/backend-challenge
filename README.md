# Sistema de cadastro de Usuários na API Qualifica

## Executar com Tusk

### Dependências

É preciso ter [docker](https://docs.docker.com/install/), [docker compose](https://docs.docker.com/compose/install/) e
o [tusk](https://github.com/rliebz/tusk) instalados em sua máquina, para instalar o tusk execute:

    $ sudo su 
    # curl -sL https://git.io/tusk | bash -s -- -b /usr/local/bin latest
    # exit

### Executar Sistema

Com isso, na pasta **Application** do projeto, copie o arquivo **.env.example** para **.env** e altere somente as
seguintes
linhas com os dados que você possui:

* QUALIFICA_AUTHORIZATION
* QUALIFICA_SERVICE_ID
* QUALIFICA_APP_USERS_GROUP_ID

Em seguida execute o seguinte comando:

    $ tusk setup

Se tudo ocorrer bem você pode acessar seu sistema em [http://localhost:8080](http://localhost:8080) e o banco de
dados em [http://localhost:8081](http://localhost:8081)

Para mais informações sobre tusk rode:

    $ tusk -h

## Executar sem Tusk

### Dependências

É preciso ter Composer, MySQL ou MariaDB, PHP 8.0+ e Nodejs(Npm)

### Executar Sistema

Com isso, na pasta **Application** do projeto, copie o arquivo **.env.example** para **.env** e altere as seguintes
linhas com os dados que você possui:

* APP_URL
* DB_HOST
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD
* QUALIFICA_AUTHORIZATION
* QUALIFICA_SERVICE_ID
* QUALIFICA_APP_USERS_GROUP_ID

Em seguida execute o seguinte comando:

    $ composer install
    $ npm install
    $ npm run dev
    $ php artisan key:generate
    $ php artisan migrate:fresh

Se tudo ocorrer bem, você pode acessar o sistema na url configurada no **APP_URL** do arquivo **.env**

## Executar Teste de Lógica

### Dependências

É preciso ter PHP 8.0+

### Executar

Com isso, na pasta principal do projeto, execute o seguinte comando:

    $ php logic.php