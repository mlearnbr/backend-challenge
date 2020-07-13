# Desafio back-end da mLearn

# Dependências
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
- MySQL ou PostgreSQL

## Instalação
- Clonando o projeto
```
git clone https://github.com/perrout/backend-challenge.git
```
- Configurações - Laravel - Altere as configurações relacionadas ao banco de dados no arquivo .env copiado do exemplo.
```
cp .env.example .env
composer install
```
- Configurações - Banco dados
php artisan migrate
php artisan db:seed
```
- Iniciando o servidor
```
php artisan serve
```
- Url de acesso
```
http://loacalhost:8000