### Requisitos

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Node.js >= 14.0
- Npm >= 6.0
- Mysql >= 5.7

### Configurando ambiente

1. Crie um banco de dados em seu mysql
2. Navegue até a raiz do projeto e renomeie o arquivo **.env-example** para **.env**
3. Substitua os dados de conexão ao banco de dados e a api MLEARN no arquivo **.env ** recém renomeado

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

MLEARN_HOST=URL_DO_AMBIENTE
MLEARN_AUTHORIZATION=SUA_CHAVE_DE_AUTORIZACAO
MLEARN_SERVICE_ID=SEU_SERVICE_ID
MLEARN_USERS_GROUP_ID=SEU_GROUP_ID
```
4.Navegue para a raiz do projeto e execute os comandos abaixo:

```bash
composer install
npm install
npm run dev
php artisan key:generate
php artisan migrate
```

### Acessando o projeto

Na raiz do projeto execute o comando:

```bash
php artisan serve
```

Acesse o endereço:
[http://localhost:8000/](http://localhost:8000/ "http://localhost:8000/")