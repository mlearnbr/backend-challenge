## 2 - Desafio de Aplicação
O objetivo deste desafio é criar uma aplicação de gestão de usuários e integrá-lo com nossa API.

## Sobre
- Back-end: PHP (Laravel 5.7)
- Front-end: Vue.js
- Banco de dados: MySQL

## Requisitos
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- Composer
- Node e npm
- Internet

## Como rodar
1. Clone e acesse a pasta do projeto
2. Instale
```
composer install
```
3. Crie uma cópia do arquivo .env.example e renomeie para .env
4. Configure o acesso ao seu banco de dados no .env
5. Adicione as variáveis da API da mLearn
```
MLEARN_HOST=https://api2.mlearn.mobi/
MLEARN_TOKEN=
MLEARN_SERVICE_ID=
MLEARN_APP_GROUP_ID=
```
6. Crie a chave do projeto
```
php artisan key:generate
```
7. Crie as tabelas
```
php artisan migrate
```
8. Rodando localmente
```
php artisan serve
```