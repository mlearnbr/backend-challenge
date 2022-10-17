## Sobre api
- O teste lógico está documentado com a tag `Challeng logical`
- A parte de integração com a API qualifica está com a tag `User`

## Instruções de instalação
- Copiar as váriaveis de ambiente `cp .env.example .env`
- Rodar `composer install` no terminal para instalar as dependências do Laravel.
- Para rodar o projeto usar o [laravel sail](https://laravel.com/docs/9.x/sail) `./vendor/bin/sail up`
- Caso APP_KEY no .env não esteja cadastrada rodar `./vendor/bin/sail artisan key:generate`
- Rodar as migration `./vendor/bin/sail artisan migrate`
- Gerar a documentação da api e fazer testes com [swagger](https://swagger.io/) `./vendor/bin/sail artisan l5-swagger:generate`

## Acessos
- PhpMyAdmin: http://localhost:8002/ | Username: `sail` Password: `password`
- Documentação swagger: http://0.0.0.0/api/documentation#/
