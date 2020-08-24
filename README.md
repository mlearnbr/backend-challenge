# Antes, o que você irá precisar?

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
- Composer >= 1.10.10
- Banco de dados MySQL ou PostgreSQL

## Use o comando:

```
git clone https://github.com/kalecio/mlearn-backend-challenge.git
```

para clonar o repositório e em seguida o comando

```
git checkout kalecio-pereira
```

para acessar a branch com os desafios

---

# Como rodar a aplicação?

## Desafio #1

1. Acesse a pasta challenge-1 e utilize o comando `php challenge1.php`, caso deseje utilizar outras matrizes altere o valor das matrizes do código ou crie uma nova matriz quadrada e chame na função;

## Desafio #2

1. Acesse a pasta challenge-2 e utilize o comando `composer install` para instalar as dependências necessárias
2. Altere o arquivo .env.example nas seguintes linhas:

```
DB_CONNECTION=banco a ser utilizado
DB_HOST=127.0.0.1
DB_PORT=porta do banco de dados
DB_DATABASE=nome da base de dados
DB_USERNAME=usuario do banco de dados
DB_PASSWORD=senha do banco de dados

MLEARN_AUTHORIZATION=token de autorização da api mlearn
MLEARN_SERVICE_ID=service-id da api mlearn
MLEARN_APP_USERS_GROUP_ID=group-id da api mlearn
```

> Obs: Certifique se de utilizar uma base vazia para não perder dados ao utilizar a migration

3. Renomeie o arquivo .env.example para .env
4. Execute o comando `php artisan migrate` para executar as migrations em seu banco de dados e criar as tabelas corretamente
5. Execute o comando `php artisan serve` para subir o servidor
6. Acesse http://127.0.0.1:8000/ para visualizar o projeto em execução
