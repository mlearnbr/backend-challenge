## 2 - Desafio de Aplicação
Esta aplicação foi desenvolvida utilizando Laravel, Mysql e Jquery. Para o front utilizei bootstrap 4 com alguns plugins extras pra melhorar a usabilidade. 
Para a construção das chamadas da API no back-end, optei por não utilizar Jobs e Queues pois entendi que era necessário o usuário obter a confirmação de sucesso, nas operações de criação, atualização, exclusão, upgrade e downgrade dos usuários. Dessa forma, criei uma [classe](app/Rest/Mlearn/MlearnApi.php) onde se concentra
todos os métodos para comunicação junto à API da mLearn.
### Instruções
- Crie um banco de dados no mysql;
- Acesse a pasta desafio2;
- Copie o arquivo .env.example para .env;
- Dentro do arquivo .env, além de configurar o acesso ao seu database, forneça as credenciais para acesso à API da mLearn:
```
MLEARN_URL_STAGING=
MLEARN_TOKEN=
MLEARN_SERVICE_ID=
MLEARN_APP_USER_GROUP_ID=
```
- Dentro da pasta desafio2, execute o comando **`composer install`**
- Dentro da pasta desafio2, execute o comando **`php artisan migrate`**
- Por fim, basta executar o comando php artisan serve e acessar o http://localhost:8000/.
### Opcionais
Tive alguns problemas no laravel, em outra maquina, por conta do arquivo .env. Caso tenham algo parecido, tentem executar os seguintes comandos:
```
php artisan config:cache
php artisan config:clear
```
