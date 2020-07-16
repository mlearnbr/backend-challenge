# Desafio back-end da mLearn

## Desafio 1

Este desafio se encontra no arquivo desafio1.php basta executa-lo como: 
```bash
$ php desafio1.php
```
Caso queira alterar a matriz das somas basta modificar a variável: ```$matrix```

## Desafio 2

Esse desafio foi feito em Laravel 7.x e em PHP 7.3, para ele funcionar sem problemas é necessário
um banco de dados relacional e um servidor capaz de executar scripts PHP, para fazer conexão com o banco de dados renomeie
o arquivo .env.example para .env e modifique as seguintes variáveis

```dotenv
DB_CONNECTION=mysql #Tipo de conexão do banco de dados escolhido
DB_HOST=127.0.0.1 #IP do banco
DB_PORT=3306 #Porta do banco
DB_DATABASE=m_learn #Nome do banco
DB_USERNAME=root #Usuario do banco
DB_PASSWORD= #Senha do banco caso possua
```

Necessário que tenha preencha as credenciais da API da mLearn que também esta no arquivo .env

```dotenv
MLEARN_BASE_URI= #Base URI da API
MLEARN_SERVICE_ID= #Id de serviço
MLEARN_USER_GROUP_ID= #Grupo de usuarios
MLEARN_AUTH_TOKEN= #Token de autenticação
``` 

Depois de preencher as configurações, execute o comando: 
```bash
$ php artisan migrate
```
Para criar as tabelas no banco.

___

Para executar a aplicação você pode utilizar os comandos na pasta root do projeto:
```bash
$ php artisan serve
```
ou incluso nesse repositório esta um arquivo Docker Compose para criar um servidor de desenvolvimento com
o comando 
```bash
$ docker-compose up -d
```
